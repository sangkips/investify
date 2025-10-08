<?php

namespace App\Livewire\Tables;

use App\Models\Quotation;
use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class QuotationMobileTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $selectedCustomer = '';
    public $selectedStatus = '';
    public $showFilters = false;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->perPage = 10;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCustomer()
    {
        $this->resetPage();
    }

    public function updatingSelectedStatus()
    {
        $this->resetPage();
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCustomer = '';
        $this->selectedStatus = '';
        $this->resetPage();
    }

    public function render()
    {
        $query = Quotation::query()->where('user_id', auth()->id());

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('reference', 'like', '%' . $this->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('customer', function ($customerQuery) {
                      $customerQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Apply customer filter
        if ($this->selectedCustomer) {
            $query->where('customer_id', $this->selectedCustomer);
        }

        // Apply status filter
        if ($this->selectedStatus !== '') {
            $query->where('status', $this->selectedStatus);
        }

        // Get paginated results with eager loaded relationships
        $quotations = $query->with(['customer:id,name'])
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        // Load customers for filter dropdown
        $customers = Customer::select('id', 'name')
            ->where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('livewire.tables.quotation-mobile-table', [
            'quotations' => $quotations,
            'customers' => $customers,
        ]);
    }
}