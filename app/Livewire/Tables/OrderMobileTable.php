<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;

class OrderMobileTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $sortField = 'created_at';
    public $sortAsc = false;

    // Reset pagination when search changes
    public function updatingSearch()
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
        $query = Order::with(['customer']);

        // Search by invoice number or customer name (case-insensitive)
        $searchTerm = strtolower(trim($this->search));
        if (!empty($searchTerm)) {
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(invoice_no) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereHas('customer', function($customerQuery) use ($searchTerm) {
                      $customerQuery->whereRaw('LOWER(name) LIKE ?', ['%' . $searchTerm . '%']);
                  });
            });
        }

        $orders = $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.tables.order-mobile-table', [
            'orders' => $orders
        ]);
    }
}
