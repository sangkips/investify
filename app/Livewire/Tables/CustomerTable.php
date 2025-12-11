<?php

namespace App\Livewire\Tables;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'name';

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
        $query = Customer::query();

        // Case-insensitive search on name, email, and phone
        if (!empty($this->search)) {
            $searchLower = strtolower($this->search);
            $query->where(function($q) use ($searchLower) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $searchLower . '%'])
                  ->orWhereRaw('LOWER(email) LIKE ?', ['%' . $searchLower . '%'])
                  ->orWhereRaw('LOWER(phone) LIKE ?', ['%' . $searchLower . '%']);
            });
        }

        // Apply sorting
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $customers = $query->paginate($this->perPage);

        return view('livewire.tables.customer-table', [
            'customers' => $customers
        ]);
    }
}
