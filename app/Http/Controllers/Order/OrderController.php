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
        ->paginate(16) // Number of items per page - 4 rows of 4 cards
        ->withQueryString(); // Retain the search query for pagination

        $customers = Customer::where('user_id', auth()->id())->get(['id', 'name']);
        $carts = Cart::content();

        return view('orders.create', [
            'products' => $products,
            'customers' => $customers,
            'carts' => $carts,
        ]);
    }

    /**
     * AJAX endpoint for live product search
     */
    public function searchProducts(Request $request)
    {
        $search = $request->input('q', '');
        
        $query = Product::where('user_id', auth()->id())
            ->with(['unit']);
        
        if (!empty($search)) {
            $searchLower = strtolower($search);
            $query->where(function($q) use ($searchLower) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $searchLower . '%'])
                  ->orWhereRaw('LOWER(code) LIKE ?', ['%' . $searchLower . '%']);
            });
        }
        
        $products = $query->limit(50)->get();
        
        return response()->json([
            'products' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'code' => $product->code,
                    'slug' => $product->slug,
                    'quantity' => $product->quantity,
                    'unit_name' => $product->unit->name ?? 'N/A',
                    'selling_price' => number_format($product->selling_price, 2),
                    'selling_price_raw' => $product->selling_price,
                ];
            }),
            'count' => $products->count(),
            'search' => $search,
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'payment_type' => $request->payment_type,
            'pay' => (int) round((float) $request->pay * 100), // Convert to cents
            'order_date' => Carbon::now()->format('Y-m-d'),
            'order_status' => OrderStatus::PENDING->value,
            'total_products' => Cart::count(),
            'sub_total' => (int) round((float) str_replace(',', '', Cart::subtotal()) * 100), // Convert to cents
            'vat' => (int) round((float) str_replace(',', '', Cart::tax()) * 100), // Convert to cents
            'total' => (int) round((float) str_replace(',', '', Cart::total()) * 100), // Convert to cents
            'invoice_no' => IdGenerator::generate([
                'table' => 'orders',
                'field' => 'invoice_no',
                'length' => 10,
                'prefix' => 'INV-'
            ]),
            'due' => (int) round(((float) str_replace(',', '', Cart::total()) - (float) $request->pay) * 100), // Convert to cents
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
            $oDetails['unitcost'] = (int) round((float) $content->price * 100); // Convert to cents
            $oDetails['total'] = (int) round((float) $content->subtotal * 100); // Convert to cents
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
            'due' => 0,
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

    // Paginate the orders
    $orders = DB::table('order_details')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->whereBetween('orders.updated_at', [$sDate, $eDate])
        ->where('orders.order_status', '1')
        ->select(
            'orders.invoice_no',
            'orders.updated_at',
            'customers.name as customer_name',
            'products.name',
            'order_details.quantity',
            'orders.payment_type as payment_method',
            'order_details.unitcost',
            'order_details.total',
            'users.name as created_by'
        )
        ->get(); // Adjust the number of records per page

    if ($orders->isEmpty()) {
        return back()->withErrors('No orders found for the selected date range.');
    }

    // Calculate summary
    $totalSales = $orders->sum('total');
    $totalQuantity = $orders->sum('quantity');

    // Get the current date and time
    $reportTime = now()->format('Y-m-d H:i:s');

    // Shop details
    $shopDetails = [
        'name' => 'Daimar Hardware',
        'address' => 'P.O Box 00-20400 Bomet',
        'phone_number' => '+254 202 000 000',
        'description' => 'Dealers in hardware materials, cement, locks, twisted iron, etc.',
    ];

    if ($request->input('export_type') === 'excel') {
        // Existing Excel export logic
        return Excel::download(new OrderExport($orders), 'order-report-' . $sDate . '-to-' . $eDate . '.xlsx');
    }

    if ($request->input('export_type') === 'pdf') {
        // PDF export logic
        $data = [
            'orders' => $orders,
            'start_date' => $sDate,
            'end_date' => $eDate,
            'totalSales' => $totalSales,
            'totalQuantity' => $totalQuantity,
            'reportTime' => $reportTime,
            'shopDetails' => $shopDetails,
        ];

        $pdf = PDF::loadView('orders.report-order-pdf', $data)
                ->setPaper('a4', 'landscape')
                ->setOptions(['defaultFont' => 'sans-serif']); // Ensure proper font rendering

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

    public function getMonthlySalesReport(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        $monthlySales = DB::table('orders')
            ->selectRaw('EXTRACT(MONTH FROM orders.updated_at) as month, SUM(order_details.total) as total_sales, COUNT(orders.id) as total_orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->whereRaw('EXTRACT(YEAR FROM orders.updated_at) = ?', [$year])
            ->where('orders.order_status', 1)
            ->groupByRaw('EXTRACT(MONTH FROM orders.updated_at)')
            ->orderBy('month')
            ->get()
            ->map(function ($data) {
                return [
                    'month' => Carbon::create()->month($data->month)->format('F'), // Convert month number to name
                    'total_sales' => $data->total_sales,
                    'total_orders' => $data->total_orders,
                ];
            });

        return response()->json([
            'year' => $year,
            'monthly_sales' => $monthlySales,
        ]);
    }

    public function exportMonthlySalesReport(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        $monthlySales = DB::table('orders')
            ->selectRaw('EXTRACT(MONTH FROM orders.updated_at) as month, 
            SUM(order_details.total) as total_sales, 
            COUNT(orders.id) as total_orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->whereRaw('EXTRACT(YEAR FROM orders.updated_at) = ?', [$year])
            ->where('orders.order_status', 1)
            ->groupByRaw('EXTRACT(MONTH FROM orders.updated_at)')
            ->orderBy('month')
            ->get()
            ->map(function ($data) {
                return [
                    'month' => Carbon::create()->month($data->month)->format('F'),
                    'total_sales' => $data->total_sales,
                    'total_orders' => $data->total_orders,
                ];
            });

        $data = [
            'year' => $year,
            'monthlySales' => $monthlySales,
            'name' => 'Daimar Hardware',
            'address' => 'P.O Box 000-20400 Bomet',
            'description' => 'Dealers in hardware materials, cement, locks, twisted iron, etc.',
        ];

        $pdf = PDF::loadView('orders.monthly-sales-report', $data)->setPaper('a4', 'portrait');

        return $pdf->download('monthly-sales-report-' . $year . '.pdf');
    }

    public function getMonthlySalesReportWithDailyBreakdown($year)
    {
        // Fetching sales data by day for the selected month/year
        $dailySalesData = DB::table('orders')
            ->select(
                DB::raw('DATE(orders.created_at) as order_date'), // Group by the date
                DB::raw('SUM(order_details.total) as total_sales'),
                DB::raw('COUNT(orders.id) as total_orders')
            )
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->whereYear('orders.created_at', '=', $year) // Filter by the year
            ->groupBy(DB::raw('DATE(orders.created_at)'))
            ->orderBy('order_date') // Order by date for the report
            ->get();

        // Aggregate the data by month
        $monthlySales = $dailySalesData->groupBy(function ($date) {
            return Carbon::parse($date->order_date)->format('F'); // Group by month
        });

        // Calculate the total sales for the month by summing up the daily totals
        $monthlySalesReport = $monthlySales->map(function ($daysData, $month) {
            $totalSales = $daysData->sum('total_sales');
            $totalOrders = $daysData->sum('total_orders');
            return [
                'month' => $month,
                'total_sales' => $totalSales,
                'total_orders' => $totalOrders,
                'daily_sales' => $daysData // Include the daily sales breakdown
            ];
        });

        return view('orders.report-monthly-sales', compact('monthlySalesReport', 'year'));
    }

    public function exportSalesReportAsPDF(Request $request, $year)
    {
        // Generate the report data
        $monthlySalesReport = $this->getMonthlySalesReportWithDailyBreakdown($year);

        // Generate PDF from the view
        $pdf = PDF::loadView('orders.report-monthly-sales-pdf', compact('monthlySalesReport', 'year'));

        // Download the PDF
        return $pdf->download("monthly_sales_report_{$year}.pdf");
    }
}
