<?php

namespace App\Livewire\Tables;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductByUnitTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = true;

    public $unit = null;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function mount($unit)
    {
        $this->unit = $unit;
    }

    public function render()
    {
        $products = Product::where('unit_id', $this->unit->id);
        return view('livewire.tables.product-by-unit-table', [
            'products' => $products->paginate($this->perPage),
        ]);
    }
}
