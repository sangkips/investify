<?php

namespace App\Http\Controllers\Quotation;

use App\Enums\QuotationStatus;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\QuotationDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\Quotation\StoreQuotationRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::all();

        return view('quotations.index', [
            'quotations' => $quotations
        ]);
    }

    public function create()
    {
        Cart::instance('quotation')->destroy();

        return view('quotations.create', [
            'cart' => Cart::content('quotation'),
            'products' => Product::where("user_id", auth()->id())->get(),
            'customers' => Customer::where("user_id", auth()->id())->get(),

            // maybe?
            //'statuses' => QuotationStatus::cases()
        ]);
    }

    public function store(StoreQuotationRequest $request)
    {
        if (count(Cart::instance('quotation')->content()) === 0) {
            return redirect()->back()->with('message', 'Please search & select products!');
        }
    
        DB::transaction(function () use ($request) {
            // Store discount and tax in session
            session()->put('cart_discount_percentage', $request->discount_percentage);
            session()->put('cart_tax_percentage', $request->tax_percentage);
    
            // Calculate discount and tax based on session values
            $subtotal = Cart::instance('quotation')->subtotal();
            $discountPercentage = session()->get('cart_discount_percentage', 0);
            $taxPercentage = session()->get('cart_tax_percentage', 0);
    
            $discountAmount = ($discountPercentage / 100) * $subtotal;
            $taxAmount = ($taxPercentage / 100) * $subtotal;
    
            // Save discount and tax amounts in session
            session()->put('cart_discount_amount', $discountAmount);
            session()->put('cart_tax_amount', $taxAmount);
            session()->save(); // Ensure session persists
    
            $quotation = Quotation::create([
                'date' => $request->date,
                'reference' => $request->reference,
                'customer_id' => $request->customer_id,
                'customer_name' => Customer::findOrFail($request->customer_id)->name,
                'tax_percentage' => $taxPercentage,
                'discount_percentage' => $discountPercentage,
                'shipping_amount' => $request->shipping_amount,
                'total_amount' => $request->total_amount,
                'status' => $request->status,
                'note' => $request->note,
                "uuid" => Str::uuid(),
                "user_id" => auth()->id(),
                'tax_amount' => $taxAmount,
                'discount_amount' => $discountAmount,
            ]);
    
            foreach (Cart::instance('quotation')->content() as $cart_item) {
                QuotationDetails::create([
                    'quotation_id' => $quotation->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'quantity' => $cart_item->qty,
                    'price' => $cart_item->price,
                    'unit_price' => $cart_item->options->unit_price,
                    'sub_total' => $cart_item->options->sub_total,
                    'product_discount_amount' => $cart_item->options->product_discount,
                    'product_discount_type' => $cart_item->options->product_discount_type,
                    'product_tax_amount' => $cart_item->options->product_tax,
                ]);
                
                // Reduce product quantity if status is 'sent'
                if ($request->status == 1) {
                    Product::where('id', $cart_item->id)->update(['quantity' => DB::raw('quantity-' . $cart_item->qty)]);
                }
            }
    
            Cart::instance('quotation')->destroy();
        });
    
        return redirect()
            ->route('quotations.index')
            ->with('success', 'Quotation Created!');
    }
    

    public function show($uuid)
    {
        $quotation = Quotation::where("user_id", auth()->id())->where('uuid', $uuid)->firstOrFail();

        return view('quotations.show', [
            'quotation' => $quotation,
            'quotation_details' => QuotationDetails::where('quotation_id', $quotation->id)->get()
        ]);
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->update([
            "status" => 2
        ]);
        $quotations = Quotation::where("user_id", auth()->id())->count();

        return redirect()
            ->route('quotations.index', [
                'quotations' => $quotations
            ]);
    }

    // complete quotaion method
    public function update(Request $request, $uuid)
    {
        $quotation = Quotation::where("user_id", auth()->id())->where('uuid', $uuid)->firstOrFail();
        $quotation->with(['customer', 'quotationDetails'])->get();
        $quotation->status = 1;
        // Reduce the stock
        $quoteProducts = $quotation->quotationDetails;

        foreach ($quoteProducts as $product) {
            Product::where('id', $product->product_id)
                ->update(['quantity' => DB::raw('quantity-' . $product->quantity)]);
        }
        $quotation->save();

        return redirect()
            ->route('quotations.index')
            ->with('success', 'Quotation Completed!');
    }
}
