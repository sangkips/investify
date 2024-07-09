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
        $units = Unit::where('name', 'like', '%' . $this->search . '%')
            // ->orWhere('slug', 'like', '%' . $this->search . '%')
            // ->orWhere('short_name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc') // Default sorting
            ->paginate($this->perPage);
        return view('livewire.tables.unit-table', [
            'units' => $units
        ]);
    }
}

// 'units' => Unit::where("user_id", auth()->id())->with('products')
// ->search($this->search)
// ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
// ->paginate($this->perPage)
