<?php

namespace App\Livewire\Tables;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'invoice_no';

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
        $query = Order::with(['customer']);

        // Case-insensitive search on invoice_no and customer name
        if (!empty($this->search)) {
            $searchLower = strtolower($this->search);
            $query->where(function($q) use ($searchLower) {
                $q->whereRaw('LOWER(invoice_no) LIKE ?', ['%' . $searchLower . '%'])
                  ->orWhereHas('customer', function($customerQuery) use ($searchLower) {
                      $customerQuery->whereRaw('LOWER(name) LIKE ?', ['%' . $searchLower . '%']);
                  });
            });
        }

        // Apply sorting
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $orders = $query->paginate($this->perPage);

        return view('livewire.tables.order-table', [
            'orders' => $orders
        ]);
    }
}
