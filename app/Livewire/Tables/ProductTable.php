<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'id';

    public $sortAsc = false;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->with(['category'])
            ->orderBy('id', 'asc') // Default sorting
            ->paginate($this->perPage);
        return view('livewire.tables.product-table', [
            'products' => $products
        ]);
    }
}
