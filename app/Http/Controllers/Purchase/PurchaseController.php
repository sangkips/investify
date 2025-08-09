<?php

namespace App\Http\Controllers\Purchase;


use App\Enums\PurchaseStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PurchaseExport;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $purchases = Purchase::where('user_id', auth()->id())->exists();
        
        // Check if request is from mobile device
        $isMobile = $this->isMobileDevice($request);
        
        if ($isMobile) {
            return view('purchases.mobile-index', [
                'purchases' => $purchases,
            ]);
        }

        $purchases = Purchase::all();
        return view('purchases.index', [
            'purchases' => $purchases
        ]);
    }

    /**
     * Mobile-specific purchases index
     */
    public function mobileIndex()
    {
        $purchases = Purchase::where('user_id', auth()->id())->exists();
        
        return view('purchases.mobile-index', [
            'purchases' => $purchases,
        ]);
    }

    /**
     * Check if the request is from a mobile device
     */
    private function isMobileDevice(Request $request): bool
    {
        $userAgent = $request->header('User-Agent');
        
        // Check for mobile indicators in user agent
        $mobileKeywords = [
            'Mobile', 'Android', 'iPhone', 'iPad', 'iPod', 
            'BlackBerry', 'Windows Phone', 'Opera Mini'
        ];
        
        foreach ($mobileKeywords as $keyword) {
            if (stripos($userAgent, $keyword) !== false) {
                return true;
            }
        }
        
        // Also check for mobile parameter in request
        if ($request->has('mobile') || $request->is('*/mobile')) {
            return true;
        }
        
        return false;
    }

    public function approvedPurchases()
    {
        $purchases = Purchase::with(['supplier'])
            ->where('status', PurchaseStatus::APPROVED)->get(); // 1 = approved

        return view('purchases.approved-purchases', [
            'purchases' => $purchases
        ]);
    }

    public function show($uuid)
    {
        $purchase = Purchase::with(['supplier', 'details.product', 'createdBy', 'updatedBy'])
            ->where('id', $uuid)
            ->firstOrFail();

        $purchaseDetails = $purchase->details;

        return view('purchases.details-purchase', [
            'purchase' => $purchase,
            'purchaseDetails' => $purchaseDetails
        ]);
    }

    public function edit($uuid)
    {
        $purchase = Purchase::where('uuid', $uuid)->firstOrFail();
        // N+1 Problem if load 'createdBy', 'updatedBy',
        $purchase->with(['supplier', 'details'])->get();

        return view('purchases.edit', [
            'purchase' => $purchase
        ]);
    }

    public function create(Request $request)
    {
        // Check if request is from mobile device
        $isMobile = $this->isMobileDevice($request);
        
        $data = [
            'categories' => Category::where('user_id', auth()->id())->select(['id', 'name'])->get(),
            'suppliers' => Supplier::where('user_id', auth()->id())->select(['id', 'name'])->get(),
        ];
        
        if ($isMobile) {
            return view('purchases.mobile-create', $data);
        }

        return view('purchases.create', $data);
    }

    public function store(StorePurchaseRequest $request)
    {
        if ($request->invoiceProducts == null || $request->invoiceProducts[0]['total'] == 0) {
            return redirect()
                ->back()
                ->with('error', 'Please add product!');
        }
        $purchase = Purchase::create([
            'purchase_no' => IdGenerator::generate([
                'table' => 'purchases',
                'field' => 'purchase_no',
                'length' => 10,
                'prefix' => 'PRS-'
            ]),
            'status'     => PurchaseStatus::PENDING->value,
            'created_by' => auth()->user()->id,
            'supplier_id.required' => $request->required,
            'supplier_id'   => $request->supplier_id,
            'date'          => $request->date,
            'total_amount'  => $request->total_amount,
            'uuid' => Str::uuid(),
            'user_id' => auth()->id()
        ]);

        /*
         * TODO: Must validate that
         */
        if (!$request->invoiceProducts == null) {
            $pDetails = [];

            foreach ($request->invoiceProducts as $product) {
                $pDetails['purchase_id']    = $purchase['id'];
                $pDetails['product_id']     = $product['product_id'];
                $pDetails['quantity']       = $product['quantity'];
                $pDetails['unitcost']       = intval($product['unitcost']);
                $pDetails['total']          = $product['total'];
                $pDetails['created_at']     = Carbon::now();

                //PurchaseDetails::insert($pDetails);
                $purchase->details()->insert($pDetails);
            }
        }

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Purchase has been created!');
    }

    public function update($uuid)
    {
        $purchase = Purchase::where('uuid', $uuid)->firstOrFail();
        $products = PurchaseDetails::where('purchase_id', $purchase->id)->get();

        foreach ($products as $product) {
            Product::where('id', $product->product_id)
                ->update(['quantity' => DB::raw('quantity+' . $product->quantity)]);
        }

        Purchase::findOrFail($purchase->id)
            ->update([
                'status' => PurchaseStatus::APPROVED,
                'updated_by' => auth()->user()->id
            ]);

        return redirect()
            ->back()
            ->with('success', 'Purchase has been approved!');
    }

    public function destroy($uuid)
    {
        $purchase = Purchase::where('uuid', $uuid)->firstOrFail();
        $purchase->delete();

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Purchase has been deleted!');
    }


    public function purchaseReport()
    {
        $purchases = Purchase::with(['supplier'])
            //->where('status', 1)
            ->where('date', today()->format('Y-m-d'))
            ->get();

        return view('purchases.report-purchase', [
            'purchases' => $purchases
        ]);
    }

    public function getPurchaseReport()
    {
        return view('purchases.report-purchase');
    }


    public function exportPurchaseReport(Request $request)
    {
        $rules = [
            'start_date' => 'required|string|date_format:Y-m-d',
            'end_date' => 'required|string|date_format:Y-m-d',
        ];

        $validatedData = $request->validate($rules);

        $sDate = $validatedData['start_date'];
        $eDate = $validatedData['end_date'];

        $purchases = DB::table('purchase_details')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('users', 'users.id', '=', 'purchases.created_by')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->whereBetween('purchases.updated_at', [$sDate, $eDate])
            ->where('purchases.status', '1')
            ->select(
                'purchases.purchase_no',
                'purchases.updated_at',
                'suppliers.name as supplier_name',
                'products.code',
                'products.name',
                'purchase_details.quantity',
                'purchase_details.unitcost',
                'purchases.total_amount as purchase_total',
                'users.name as created_by'
            )
            ->get();

        if ($purchases->isEmpty()) {
            return back()->withErrors('No purchases found for the selected date range.');
        }

        if ($request->input('export_type') === 'excel') {
            // Existing Excel export logic
            return Excel::download(new PurchaseExport($purchases), 'purchase-report-' . $sDate . '-to-' . $eDate . '.xlsx');
        }

        if ($request->input('export_type') === 'pdf') {
            // PDF export logic
            $data = [
                'purchases' => $purchases,
                'start_date' => $sDate,
                'end_date' => $eDate,
                'name' => 'Daimar Hardware',
                'address' => 'P.O Box 000-20400 Bomet',
                'description' => 'Dealers in hardware materials, cement, locks, twisted iron, etc.',
            ];

            $pdf = PDF::loadView('purchases.report-purchase-pdf', $data)
                    ->setPaper('a4', 'landscape');

            return $pdf->download('purchase-report-' . $sDate . '-to-' . $eDate . '.pdf');
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
            $spreadSheet->getActiveSheet()->fromArray($products, null, 'A1');
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="purchase-report.xls"');
            header('Cache-Control: max-age=0');
            
            if (ob_get_contents()) {
                ob_end_clean();
            }
            
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function exportPDFPurchaseReport(Request $request)
    {
        $rules = [
            'start_date' => 'required|string|date_format:Y-m-d',
            'end_date' => 'required|string|date_format:Y-m-d',
        ];

        $validatedData = $request->validate($rules);

        $sDate = $validatedData['start_date'];
        $eDate = $validatedData['end_date'];

        $purchases = DB::table('purchase_details')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('users', 'users.id', '=', 'purchases.created_by')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->whereBetween('purchases.updated_at', [$sDate, $eDate])
            ->where('purchases.status', '1')
            ->select(
                'purchases.purchase_no',
                'purchases.updated_at',
                'suppliers.name as supplier_name',
                'products.code',
                'products.name',
                'purchase_details.quantity',
                'purchase_details.unitcost',
                'purchases.total_amount as purchase_total',
                'users.name as created_by'
            )
            ->get();

        $data = [
            'purchases' => $purchases,
            'start_date' => $sDate,
            'end_date' => $eDate
        ];

        $pdf = PDF::loadView('purchases.report-purchase', $data);
        return $pdf->download('purchase-report.pdf');
    }
}
