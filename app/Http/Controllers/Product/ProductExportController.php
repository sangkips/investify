<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductExportController extends Controller
{
    public function create()
    {
        $products = Product::all()->sortBy('product_name');

        $product_array[] = array(
            'Product Name',
            'Product Code',
            'Stock',
            "Stock Alert",
            'Buying Price',
            'Selling Price',
            "Note"
        );

        foreach ($products as $product) {
            $product_array[] = array(
                'Product Name' => $product->name,
                'Product Code' => $product->code,
                'Stock' => $product->quantity,
                "Stock Alert" => $product->quantity_alert,
                'Buying Price' => $product->buying_price,
                'Selling Price' => $product->selling_price,
                "Note" => $product->note
            );
        }

        $this->store($product_array);
    }

    public function store($products)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $data = [
                'products' => $products,
            ];
    
            // Load a PDF view and pass the product data
            $pdf = PDF::loadView('products.report-pdf', $data)
                ->setPaper('a4', 'landscape');
    
            return $pdf->download('products-report.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to generate PDF.'], 500);
        }
    }

    public function exportProductsAsPDF()
    {
        $products = Product::with('category', 'unit')
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'code' => $product->code,
                    'quantity' => $product->quantity,
                    'buying_price' => $product->getRawOriginal('buying_price'),
                    'selling_price' => $product->getRawOriginal('selling_price'),
                    'tax' => $product->tax,
                    'quantity_alert' => $product->quantity_alert,
                    'created_at' => $product->created_at->format('Y-m-d'),
                ];
            });

        return $this->store($products);
    }
}
