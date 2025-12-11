<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductMobileTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $sortField = 'created_at';
    public $sortAsc = false;
    public $showFilters = false;
    public $selectedCategory = '';

    // Reset pagination when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Reset pagination when category changes
    public function updatingSelectedCategory()
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

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->showFilters = false;
    }

    public function render()
    {
        $query = Product::with(['category']);

        // Search by name or code (case-insensitive)
        $searchTerm = strtolower(trim($this->search));
        if (!empty($searchTerm)) {
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(code) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        $products = $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        $categories = \App\Models\Category::select('id', 'name')
            ->get();

        return view('livewire.tables.product-mobile-table', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}