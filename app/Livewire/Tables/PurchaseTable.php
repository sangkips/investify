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

    /**
     * Reset pagination when search query is updated
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Reset pagination when perPage is updated
     */
    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

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
        $query = Purchase::with(['supplier']);

        // Case-insensitive search on purchase_no and supplier name
        if (!empty($this->search)) {
            $searchLower = strtolower($this->search);
            $query->where(function($q) use ($searchLower) {
                $q->whereRaw('LOWER(purchase_no) LIKE ?', ['%' . $searchLower . '%'])
                  ->orWhereHas('supplier', function($supplierQuery) use ($searchLower) {
                      $supplierQuery->whereRaw('LOWER(name) LIKE ?', ['%' . $searchLower . '%']);
                  });
            });
        }

        // Apply sorting
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $purchases = $query->paginate($this->perPage);

        return view('livewire.tables.purchase-table', [
            'purchases' => $purchases
        ]);
    }
}
