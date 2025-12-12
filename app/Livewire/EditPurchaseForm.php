<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class EditPurchaseForm extends Component
{
    public Purchase $purchase;
    
    #[Validate('Required')]
    public float $taxes = 0;

    public array $invoiceProducts = [];

    #[Validate('required', message: 'Please select products')]
    public Collection $allProducts;

    public function mount(Purchase $purchase): void
    {
        $this->purchase = $purchase;
        $this->allProducts = Product::where("user_id", auth()->id())->get();
        
        // Load existing purchase details
        $this->loadPurchaseDetails();
    }
    
    public function loadPurchaseDetails(): void
    {
        $this->invoiceProducts = [];
        
        foreach ($this->purchase->details as $detail) {
            $this->invoiceProducts[] = [
                'id' => $detail->id,
                'product_id' => $detail->product_id,
                'quantity' => $detail->quantity,
                'is_saved' => true,
                'product_name' => $detail->product->name,
                'product_price' => $detail->unitcost
            ];
        }
        
        // Set the tax percentage
        $this->taxes = $this->purchase->tax_percentage ?? 0;
    }

    public function render(): View
    {
        $total = 0;

        foreach ($this->invoiceProducts as $invoiceProduct)
        {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity'])
            {
                $total += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }

        return view('livewire.edit-purchase-form', [
            'subtotal' => $total,
            'total' => $total * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100)
        ]);
    }

    public function addProduct(): void
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct)
        {
            if (!$invoiceProduct['is_saved'])
            {
                $this->addError('invoiceProducts.' . $key, 'This line must be saved before creating a new one.');
                return;
            }
        }

        $this->invoiceProducts[] = [
            'id' => null,
            'product_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'product_name' => '',
            'product_price' => 0
        ];
    }

    public function editProduct($index): void
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct)
        {
            if (! $invoiceProduct['is_saved'])
            {
                $this->addError('invoiceProducts.' . $key, 'This line must be saved before editing another.');
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
            $this->invoiceProducts[$index]['product_price'] = $product->buying_price;
            $this->invoiceProducts[$index]['is_saved'] = true;
        }
    }

    public function removeProduct($index): void
    {
        unset($this->invoiceProducts[$index]);
        $this->invoiceProducts = array_values($this->invoiceProducts);
    }
    
    public function updatePurchase(): void
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
        
        $taxPercentage = is_numeric($this->taxes) ? $this->taxes : 0;
        $taxAmount = $subtotal * ($taxPercentage / 100);
        $totalAmount = $subtotal + $taxAmount;
        
        // Delete old purchase details
        $this->purchase->details()->delete();
        
        // Create new purchase details
        foreach ($this->invoiceProducts as $product) {
            if ($product['is_saved'] && $product['product_id']) {
                PurchaseDetails::create([
                    'purchase_id' => $this->purchase->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'unitcost' => $product['product_price'],
                    'total' => $product['product_price'] * $product['quantity']
                ]);
            }
        }
        
        // Update purchase totals
        $this->purchase->update([
            'total_amount' => $totalAmount,
            'tax_percentage' => $taxPercentage,
            'tax_amount' => $taxAmount,
            'updated_by' => auth()->id()
        ]);
        
        session()->flash('success', 'Purchase updated successfully!');
        
        // Redirect to purchase view
        $this->redirect(route('purchases.edit', $this->purchase->uuid));
    }
    
    public function approvePurchase(): void
    {
        // First save any pending changes
        $this->updatePurchaseWithoutRedirect();
        
        // Update stock for each product
        foreach ($this->purchase->details as $detail) {
            Product::where('id', $detail->product_id)
                ->increment('quantity', $detail->quantity);
        }
        
        // Update purchase status
        $this->purchase->update([
            'status' => \App\Enums\PurchaseStatus::APPROVED,
            'updated_by' => auth()->id()
        ]);
        
        session()->flash('success', 'Purchase approved successfully! Stock has been updated.');
        
        // Redirect to purchase view
        $this->redirect(route('purchases.edit', $this->purchase->uuid));
    }
    
    private function updatePurchaseWithoutRedirect(): void
    {
        // Validate that there are products
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
        
        $taxPercentage = is_numeric($this->taxes) ? $this->taxes : 0;
        $taxAmount = $subtotal * ($taxPercentage / 100);
        $totalAmount = $subtotal + $taxAmount;
        
        // Delete old purchase details
        $this->purchase->details()->delete();
        
        // Create new purchase details
        foreach ($this->invoiceProducts as $product) {
            if ($product['is_saved'] && $product['product_id']) {
                PurchaseDetails::create([
                    'purchase_id' => $this->purchase->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'unitcost' => $product['product_price'],
                    'total' => $product['product_price'] * $product['quantity']
                ]);
            }
        }
        
        // Update purchase totals
        $this->purchase->update([
            'total_amount' => $totalAmount,
            'tax_percentage' => $taxPercentage,
            'tax_amount' => $taxAmount,
            'updated_by' => auth()->id()
        ]);
        
        // Refresh the purchase model
        $this->purchase->refresh();
    }
}
