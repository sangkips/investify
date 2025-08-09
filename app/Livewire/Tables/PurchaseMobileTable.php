<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\WithPagination;

class PurchaseMobileTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $sortField = 'created_at';
    public $sortAsc = false;
    public $showFilters = false;
    public $selectedSupplier = '';
    public $selectedStatus = '';

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedSupplier = '';
        $this->selectedStatus = '';
        $this->showFilters = false;
    }

    public function render()
    {
        $query = Purchase::with(['supplier'])
            ->where('user_id', auth()->id());

        if ($this->search) {
            $query->where(function($q) {
                $q->where('purchase_no', 'like', '%' . $this->search . '%')
                  ->orWhereHas('supplier', function($sq) {
                      $sq->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->selectedSupplier) {
            $query->where('supplier_id', $this->selectedSupplier);
        }

        if ($this->selectedStatus !== '') {
            $query->where('status', $this->selectedStatus);
        }

        $purchases = $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        // Ensure supplier relationship is loaded for all purchases
        $purchases->getCollection()->load('supplier');

        $suppliers = Supplier::where('user_id', auth()->id())
            ->select('id', 'name')
            ->get();

        return view('livewire.tables.purchase-mobile-table', [
            'purchases' => $purchases,
            'suppliers' => $suppliers
        ]);
    }
}