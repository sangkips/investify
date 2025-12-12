<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class SearchProduct extends Component
{
    public $selectedProduct;

    public function mount()
    {
        $this->selectedProduct = '';
    }

    public function updatedSelectedProduct()
    {
        if ($this->selectedProduct) {
            $product = Product::find($this->selectedProduct);
            if ($product) {
                $this->dispatch('productSelected', [
                    'id' => $product->id,
                    'name' => $product->name,
                    'code' => $product->code,
                    'quantity' => $product->quantity,
                    'selling_price' => $product->selling_price,
                    'product_cost' => $product->product_cost,
                    'tax' => $product->tax ?? 0,
                    'tax_type' => $product->tax_type ?? 0,
                    'unit_id' => $product->unit_id,
                ]);
                $this->selectedProduct = ''; // Reset dropdown after selection
            }
        }
    }

    public function render()
    {
        // Get all products - show all for admins/super-admins
        $query = Product::query();
        if (!auth()->user()->hasAnyRole(['admin', 'super-admin'])) {
            $query->where("user_id", auth()->id());
        }
        
        $products = $query->orderBy('name')->limit(50)->get();
        
        return view('livewire.search-product', [
            'products' => $products
        ]);
    }
}
