<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use App\Mail\StockAlert;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    public function create(Request $request)
    {
        // Retrieve the search query if it exists
        $search = $request->input('search');

        // Query products, resetting to all if search is empty
        $products = Product::where('user_id', auth()->id())
        ->with(['category', 'unit'])
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->paginate(8) // Number of items per page
        ->withQueryString(); // Retain the search query for pagination

        $customers = Customer::where('user_id', auth()->id())->get(['id', 'name']);
        $carts = Cart::content();

        return view('orders.create', [
            'products' => $products,
            'customers' => $customers,
            'carts' => $carts,
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'payment_type' => $request->payment_type,
            'pay' => $request->pay,
            'order_date' => Carbon::now()->format('Y-m-d'),
            'order_status' => OrderStatus::PENDING->value,
            'total_products' => Cart::count(),
            'sub_total' => Cart::subtotal(),
            'vat' => Cart::tax(),
            'total' => Cart::total(),
            'invoice_no' => IdGenerator::generate([
                'table' => 'orders',
                'field' => 'invoice_no',
                'length' => 10,
                'prefix' => 'INV-'
            ]),
            'due' => (Cart::total() - $request->pay),
            'user_id' => auth()->id(),
            'uuid' => Str::uuid(),
        ]);

        // Create Order Details
        $contents = Cart::content();
        $oDetails = [];

        foreach ($contents as $content) {
            $oDetails['order_id'] = $order['id'];
            $oDetails['product_id'] = $content->id;
            $oDetails['quantity'] = $content->qty;
            $oDetails['unitcost'] = $content->price;
            $oDetails['total'] = $content->subtotal;
            $oDetails['created_at'] = Carbon::now();

            OrderDetails::insert($oDetails);
        }

        // Delete Cart Sopping History
        Cart::destroy();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order has been created!');
    }

    public function show($uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        $order->loadMissing(['customer', 'details'])->get();
        return view('orders.show', [
            'order' => $order
        ]);
    }

    public function update($uuid, Request $request)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        // TODO refactoring

        // Reduce the stock
        $products = OrderDetails::where('order_id', $order->id)->get();

        $stockAlertProducts = [];

        foreach ($products as $product) {
            $productEntity = Product::where('id', $product->product_id)->first();
            $newQty = $productEntity->quantity - $product->quantity;
            if ($newQty < $productEntity->quantity_alert) {
                $stockAlertProducts[] = $productEntity;
            }
            $productEntity->update(['quantity' => $newQty]);
        }

        if (count($stockAlertProducts) > 0) {
            $listAdmin = [];
            foreach (User::all('email') as $admin) {
                $listAdmin[] = $admin->email;
            }
            Mail::to($listAdmin)->send(new StockAlert($stockAlertProducts));
        }
        $order->update([
            'order_status' => OrderStatus::COMPLETE,
            'due' => '0',
            'pay' => $order->total
        ]);

        return redirect()
            ->route('orders.complete')
            ->with('success', 'Order has been completed!');
    }

    public function destroy($uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        $order->delete();
    }

    public function downloadInvoice($uuid)
    {
        $order = Order::with(['customer', 'details'])->where('uuid', $uuid)->firstOrFail();
        // TODO: Need refactor
        //dd($order);

        //$order = Order::with('customer')->where('id', $order_id)->first();
        // $order = Order::
        //     ->where('id', $order)
        //     ->first();

        return view('orders.print-invoice', [
            'order' => $order,
        ]);
    }

    public function cancel(Order $order)
    {
        $order->update([
            'order_status' => 2
        ]);
        $orders = Order::where('user_id', auth()->id())->count();

        return redirect()
            ->route('orders.index', [
                'orders' => $orders
            ])
            ->with('success', 'Order has been canceled!');
    }

    public function salesReport()
    {
        $orders = Order::with(['customer'])
            // ->where('status', 1)
            ->where('order_date', today()->format('Y-m-d'))
            ->get();

        return view('orders.report-order', [
            'orders' => $orders
        ]);
    }

    public function getSalesReport()
    {
        return view('orders.report-order');
    }

    public function exportSalesReport(Request $request)
    {
        $rules = [
            'start_date' => 'required|string|date_format:Y-m-d',
            'end_date' => 'required|string|date_format:Y-m-d',
        ];

        $validatedData = $request->validate($rules);

        $sDate = $validatedData['start_date'];
        $eDate = $validatedData['end_date'];

        $orders = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->whereBetween('orders.updated_at', [$sDate, $eDate])
            ->where('orders.order_status', '1')
            ->select(
                'orders.updated_at',
                'customers.name as customer_name',
                'products.name',
                'order_details.quantity',
                'order_details.unitcost',
                'order_details.total',
                'users.name as created_by'
            )
            ->get();

        if ($orders->isEmpty()) {
            return back()->withErrors('No orders found for the selected date range.');
        }

        if ($request->input('export_type') === 'excel') {
            // Existing Excel export logic
            return Excel::download(new OrderExport($orders), 'order-report-' . $sDate . '-to-' . $eDate . '.xlsx');
        }

        if ($request->input('export_type') === 'pdf') {
            // PDF export logic
            $data = [
                'purchases' => $orders,
                'start_date' => $sDate,
                'end_date' => $eDate,
            ];

            $pdf = PDF::loadView('orders.report-order-pdf', $data)
                    ->setPaper('a4', 'landscape');

            return $pdf->download('order-report-' . $sDate . '-to-' . $eDate . '.pdf');
        }

        return back()->withErrors('Invalid export type selected.');
    }

    public function exportExcel($products)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($products);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="sales-report.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return $e;
        }
    }
}
