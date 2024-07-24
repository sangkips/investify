<?php

namespace App\Livewire\Tables;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'name';

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
        $suppliers = Supplier::where('name', 'like', '%' . $this->search . '%')
            ->with(['purchases'])
            ->orderBy('created_at', 'desc') // Default sorting
            ->paginate($this->perPage);
        return view('livewire.tables.supplier-table', [
            'suppliers' => $suppliers
        ]);
    }
}
