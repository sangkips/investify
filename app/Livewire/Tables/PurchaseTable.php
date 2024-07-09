<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\WithPagination;

class PurchaseTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'purchase_no';

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
        $purchases = Purchase::where('purchase_no', 'like', '%' . $this->search . '%')
            ->with(['supplier'])
            ->orderBy('id', 'asc') // Default sorting
            ->paginate($this->perPage);
        return view('livewire.tables.purchase-table', [
            'purchases' => $purchases
        ]);
    }
}
