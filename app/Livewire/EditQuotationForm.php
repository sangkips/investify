<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationDetails;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class EditQuotationForm extends Component
{
    public Quotation $quotation;
    
    public float $discountPercentage = 0;
    public float $shippingAmount = 0;

    public array $invoiceProducts = [];

    public Collection $allProducts;

    public function mount(Quotation $quotation): void
    {
        $this->quotation = $quotation;
        
        // Load products based on user role
        $user = auth()->user();
        if ($user->hasRole(['admin', 'super-admin'])) {
            $this->allProducts = Product::all();
        } else {
            $this->allProducts = Product::where("user_id", auth()->id())->get();
        }
        
        // Load existing quotation details
        $this->loadQuotationDetails();
    }
    
    public function loadQuotationDetails(): void
    {
        $this->invoiceProducts = [];
        
        foreach ($this->quotation->quotationDetails as $detail) {
            $this->invoiceProducts[] = [
                'id' => $detail->id,
                'product_id' => $detail->product_id,
                'quantity' => $detail->quantity,
                'is_saved' => true,
                'product_name' => $detail->product_name,
                'product_code' => $detail->product_code,
                'product_price' => $detail->price,
                'stock' => $detail->product->quantity ?? 0,
            ];
        }
        
        // Load discount and shipping
        $this->discountPercentage = $this->quotation->discount_percentage ?? 0;
        $this->shippingAmount = $this->quotation->shipping_amount ?? 0;
    }

    public function render(): View
    {
        $subtotal = 0;

        foreach ($this->invoiceProducts as $invoiceProduct) {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity']) {
                $subtotal += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }
        
        // Calculate discount amount
        $discountAmount = $subtotal * ($this->discountPercentage / 100);
        $afterDiscount = $subtotal - $discountAmount;
        
        // VAT is already included in prices, just extract for display
        $vatAmount = $afterDiscount - ($afterDiscount / 1.16);
        
        // Grand total = subtotal - discount + shipping
        $total = $afterDiscount + $this->shippingAmount;

        return view('livewire.edit-quotation-form', [
            'subtotal' => $subtotal,
            'discountAmount' => $discountAmount,
            'vatAmount' => $vatAmount,
            'total' => $total
        ]);
    }

    public function addProduct(): void
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (!$invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'Please save this product before adding another.');
                return;
            }
        }

        $this->invoiceProducts[] = [
            'id' => null,
            'product_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'product_name' => '',
            'product_code' => '',
            'product_price' => 0,
            'stock' => 0,
        ];
    }

    public function editProduct($index): void
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (!$invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'Please save this product first.');
                return;
            }
        }

        $this->invoiceProducts[$index]['is_saved'] = false;
    }

    public function saveProduct($index): void
    {
        $this->resetErrorBag();

        $product = $this->allProducts->find($this->invoiceProducts[$index]['product_id']);

        if ($product) {
            $this->invoiceProducts[$index]['product_name'] = $product->name;
            $this->invoiceProducts[$index]['product_code'] = $product->code;
            $this->invoiceProducts[$index]['product_price'] = $product->selling_price;
            $this->invoiceProducts[$index]['stock'] = $product->quantity;
            $this->invoiceProducts[$index]['is_saved'] = true;
        }
    }

    public function removeProduct($index): void
    {
        unset($this->invoiceProducts[$index]);
        $this->invoiceProducts = array_values($this->invoiceProducts);
    }
    
    public function updateQuotation(): void
    {
        // Validate that there are products
        if (empty($this->invoiceProducts)) {
            $this->addError('invoiceProducts', 'Please add at least one product.');
            return;
        }
        
        // Check if all products are saved
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (!$invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'Please save all products before updating.');
                return;
            }
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($this->invoiceProducts as $invoiceProduct) {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity']) {
                $subtotal += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }
        
        $discountAmount = $subtotal * ($this->discountPercentage / 100);
        $afterDiscount = $subtotal - $discountAmount;
        $vatAmount = $afterDiscount - ($afterDiscount / 1.16);
        $totalAmount = $afterDiscount + $this->shippingAmount;
        
        // Delete old quotation details
        $this->quotation->quotationDetails()->delete();
        
        // Create new quotation details
        foreach ($this->invoiceProducts as $product) {
            if ($product['is_saved'] && $product['product_id']) {
                QuotationDetails::create([
                    'quotation_id' => $this->quotation->id,
                    'product_id' => $product['product_id'],
                    'product_name' => $product['product_name'],
                    'product_code' => $product['product_code'],
                    'quantity' => $product['quantity'],
                    'price' => $product['product_price'],
                    'unit_price' => $product['product_price'] / 1.16,
                    'sub_total' => $product['product_price'] * $product['quantity'],
                    'product_discount_amount' => 0,
                    'product_discount_type' => 'fixed',
                    'product_tax_amount' => ($product['product_price'] * $product['quantity']) - (($product['product_price'] * $product['quantity']) / 1.16),
                ]);
            }
        }
        
        // Update quotation totals
        $this->quotation->update([
            'total_amount' => $totalAmount,
            'discount_percentage' => $this->discountPercentage,
            'discount_amount' => $discountAmount,
            'shipping_amount' => $this->shippingAmount,
            'tax_percentage' => 16,
            'tax_amount' => $vatAmount,
        ]);
        
        session()->flash('success', 'Quotation updated successfully!');
        
        // Refresh the quotation
        $this->quotation->refresh();
        $this->loadQuotationDetails();
    }
    
    public function completeQuotation(): void
    {
        // First save any pending changes
        $this->updateQuotationWithoutFlash();
        
        // Reduce stock for each product
        foreach ($this->quotation->quotationDetails as $detail) {
            Product::where('id', $detail->product_id)
                ->decrement('quantity', $detail->quantity);
        }
        
        // Update quotation status to Sent (1)
        $this->quotation->update([
            'status' => 1
        ]);
        
        session()->flash('success', 'Quotation completed successfully! Stock has been updated.');
        
        // Redirect to quotation view
        $this->redirect(route('quotations.show', $this->quotation->uuid));
    }
    
    private function updateQuotationWithoutFlash(): void
    {
        if (empty($this->invoiceProducts)) {
            return;
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($this->invoiceProducts as $invoiceProduct) {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity']) {
                $subtotal += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }
        
        $discountAmount = $subtotal * ($this->discountPercentage / 100);
        $afterDiscount = $subtotal - $discountAmount;
        $vatAmount = $afterDiscount - ($afterDiscount / 1.16);
        $totalAmount = $afterDiscount + $this->shippingAmount;
        
        // Delete old quotation details
        $this->quotation->quotationDetails()->delete();
        
        // Create new quotation details
        foreach ($this->invoiceProducts as $product) {
            if ($product['is_saved'] && $product['product_id']) {
                QuotationDetails::create([
                    'quotation_id' => $this->quotation->id,
                    'product_id' => $product['product_id'],
                    'product_name' => $product['product_name'],
                    'product_code' => $product['product_code'],
                    'quantity' => $product['quantity'],
                    'price' => $product['product_price'],
                    'unit_price' => $product['product_price'] / 1.16,
                    'sub_total' => $product['product_price'] * $product['quantity'],
                    'product_discount_amount' => 0,
                    'product_discount_type' => 'fixed',
                    'product_tax_amount' => ($product['product_price'] * $product['quantity']) - (($product['product_price'] * $product['quantity']) / 1.16),
                ]);
            }
        }
        
        // Update quotation totals
        $this->quotation->update([
            'total_amount' => $totalAmount,
            'discount_percentage' => $this->discountPercentage,
            'discount_amount' => $discountAmount,
            'shipping_amount' => $this->shippingAmount,
            'tax_percentage' => 16,
            'tax_amount' => $vatAmount,
        ]);
        
        $this->quotation->refresh();
    }
}
