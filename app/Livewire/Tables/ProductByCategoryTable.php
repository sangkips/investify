<?php

namespace App\Livewire\Tables;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductByCategoryTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = true;

    public $category = null;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            // ->with(['category'])
            ->orderBy('id', 'asc') // Default sorting
            ->paginate($this->perPage);
        return view('livewire.tables.product-by-category-table', [
            'products' => $products
        ]);
    }
}
