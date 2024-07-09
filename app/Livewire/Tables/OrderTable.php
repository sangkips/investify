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
        $orders = Order::where("invoice_no", "like", "%{$this->search}%")
            ->with(['customer'])
            ->orderBy('id', 'asc') // Default sorting
            ->paginate($this->perPage);
        return view('livewire.tables.order-table', [
            'orders' => $orders
        ]);
    }
}
