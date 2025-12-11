<?php

namespace App\Livewire\Tables;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class UnitTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = true;

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
        $query = Unit::select(['id', 'name', 'slug', 'short_code']);

        // Case-insensitive search on name, slug, and short_code
        if (!empty($this->search)) {
            $searchLower = strtolower($this->search);
            $query->where(function($q) use ($searchLower) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $searchLower . '%'])
                  ->orWhereRaw('LOWER(slug) LIKE ?', ['%' . $searchLower . '%'])
                  ->orWhereRaw('LOWER(short_code) LIKE ?', ['%' . $searchLower . '%']);
            });
        }

        // Apply sorting
        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $units = $query->paginate($this->perPage);

        return view('livewire.tables.unit-table', [
            'units' => $units
        ]);
    }
}
