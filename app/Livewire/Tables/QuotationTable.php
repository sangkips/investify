<?php

namespace App\Livewire\Tables;

use App\Models\Quotation;
use Livewire\Component;
use Livewire\WithPagination;

class QuotationTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'reference';

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
        $query = Quotation::with(['customer']);

        // Case-insensitive search on reference and customer_name
        if (!empty($this->search)) {
            $searchLower = strtolower($this->search);
            $query->where(function($q) use ($searchLower) {
                $q->whereRaw('LOWER(reference) LIKE ?', ['%' . $searchLower . '%'])
                  ->orWhereRaw('LOWER(customer_name) LIKE ?', ['%' . $searchLower . '%']);
            });
        }

        // Apply sorting
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $quotations = $query->paginate($this->perPage);

        return view('livewire.tables.quotation-table', [
            'quotations' => $quotations
        ]);
    }
}
