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
        $quotations = Quotation::where("customer_name", "like", "%{$this->search}%")
            ->with(['customer'])
            ->orderBy('created_at', 'desc') // Default sorting
            ->paginate($this->perPage);
        return view('livewire.tables.quotation-table', [
            'quotations' => $quotations
        ]);
    }
}
