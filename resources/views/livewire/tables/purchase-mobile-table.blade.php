<div class="mobile-purchase-container">
    <!-- Mobile Header -->
    <div class="mobile-header bg-white shadow-sm sticky-top">
        <!-- Title and Add Button -->
        <div class="d-flex align-items-center justify-content-between p-3">
            <h5 class="mb-0 fw-bold">{{ __('Purchases') }}</h5>
            @can('create-purchase')
            <a href="{{ route('purchases.create') }}" class="btn btn-success btn-sm">
                {{ __('Add Purchase') }}
            </a>
            @endcan
        </div>

        <!-- Filter Controls -->
        <div class="px-3 pb-3">
            <div class="row g-2 align-items-center">
                <div class="col-4">
                    <div class="d-flex align-items-center gap-2">
                        <button wire:click="toggleFilters" class="btn btn-outline-secondary btn-sm">
                            <i class="ti ti-filter me-1"></i>{{ __('Filter') }}
                        </button>
                    </div>
                </div>
                <div class="col-8">
                    <div class="d-flex align-items-center gap-2">
                        <label class="form-label mb-0 text-muted small">{{ __('Search:') }}</label>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               class="form-control form-control-sm" 
                               placeholder="{{ __('Search purchases...') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Panel -->
        @if($showFilters)
        <div class="border-top bg-light p-3">
            <div class="row g-2">
                <div class="col-4">
                    <label class="form-label mb-1 small">{{ __('Supplier') }}</label>
                    <select wire:model.live="selectedSupplier" class="form-select form-select-sm">
                        <option value="">{{ __('All Suppliers') }}</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label class="form-label mb-1 small">{{ __('Status') }}</label>
                    <select wire:model.live="selectedStatus" class="form-select form-select-sm">
                        <option value="">{{ __('All Status') }}</option>
                        <option value="0">{{ __('Pending') }}</option>
                        <option value="1">{{ __('Approved') }}</option>
                    </select>
                </div>
                <div class="col-2">
                    <label class="form-label mb-1 small">{{ __('Show') }}</label>
                    <select wire:model.live="perPage" class="form-select form-select-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="col-3 d-flex align-items-end">
                    <button wire:click="clearFilters" class="btn btn-outline-danger btn-sm w-100">
                        {{ __('Clear') }}
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Loading Spinner -->
    <div wire:loading class="text-center p-4">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Purchases Grid -->
    <div wire:loading.remove class="p-3">
        @if($purchases->count() > 0)
            <div class="row g-3">
                @foreach($purchases as $purchase)
                <div class="col-12">
                    <div class="card purchase-card shadow-sm">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <!-- Purchase Info -->
                                <div class="flex-grow-1 me-2">
                                    <h6 class="mb-1 fw-bold">{{ $purchase->purchase_no }}</h6>
                                    <p class="text-muted small mb-1">
                                        <i class="ti ti-building-store me-1"></i>{{ $purchase->supplier ? $purchase->supplier->name : 'No Supplier' }}
                                    </p>
                                    <p class="text-muted small mb-2">
                                        <i class="ti ti-calendar me-1"></i>{{ $purchase->date->format('d M Y') }}
                                    </p>
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="fw-bold text-primary">{{ Number::currency($purchase->total_amount, 'KES') }}</span>
                                        @if ($purchase->status === \App\Enums\PurchaseStatus::APPROVED)
                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                        @else
                                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Action Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        @can('view-purchase')
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ route('purchases.show', $purchase->id) }}">
                                                <i class="ti ti-eye me-2 text-primary"></i>{{ __('View') }}
                                            </a>
                                        </li>
                                        @endcan
                                        @can('update-purchase')
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ route('purchases.edit', $purchase->uuid) }}">
                                                <i class="ti ti-edit me-2 text-warning"></i>{{ __('Edit') }}
                                            </a>
                                        </li>
                                        @endcan
                                        @if ($purchase->status !== \App\Enums\PurchaseStatus::APPROVED)
                                        @can('update-purchase')
                                        <li>
                                            <form method="POST" action="{{ route('purchases.update', $purchase->uuid) }}" class="w-100">
                                                @csrf
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure to approve purchase no. {{ $purchase->purchase_no }}?')"
                                                        class="dropdown-item d-flex align-items-center w-100 border-0 bg-transparent">
                                                    <i class="ti ti-check me-2 text-success"></i>{{ __('Approve') }}
                                                </button>
                                            </form>
                                        </li>
                                        @endcan
                                        @can('delete-purchase')
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <form method="POST" action="{{ route('purchases.delete', $purchase->uuid) }}" class="w-100">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete {{ $purchase->purchase_no }}?')"
                                                        class="dropdown-item d-flex align-items-center w-100 border-0 bg-transparent text-danger">
                                                    <i class="ti ti-trash me-2"></i>{{ __('Delete') }}
                                                </button>
                                            </form>
                                        </li>
                                        @endcan
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <small class="text-muted">
                        {{ __('Showing') }} {{ $purchases->firstItem() }} {{ __('to') }} {{ $purchases->lastItem() }} 
                        {{ __('of') }} {{ $purchases->total() }} {{ __('results') }}
                    </small>
                </div>
                {{ $purchases->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="ti ti-shopping-cart-off" style="font-size: 4rem; color: #6c757d;"></i>
                </div>
                <h5 class="text-muted">{{ __('No purchases found') }}</h5>
                <p class="text-muted">{{ __('Try adjusting your search or filters') }}</p>
                @can('create-purchase')
                <a href="{{ route('purchases.create') }}" class="btn btn-success">
                    <i class="ti ti-plus"></i> {{ __('Add Purchase') }}
                </a>
                @endcan
            </div>
        @endif
    </div>

    <!-- Custom Styles -->
    <style>
    .mobile-purchase-container {
        max-width: 100%;
        margin: 0 auto;
    }

    .mobile-header {
        border-bottom: 1px solid #dee2e6;
    }

    .purchase-card {
        border: 1px solid #e9ecef;
        transition: all 0.2s ease;
    }

    .purchase-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }

    /* Dropdown menu styling */
    .dropdown-menu {
        min-width: 150px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 1px solid #e9ecef;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    
    .dropdown-item.text-danger:hover {
        background-color: #f8d7da;
        color: #721c24 !important;
    }
    
    .dropdown-item.text-success:hover {
        background-color: #d1e7dd;
        color: #0f5132 !important;
    }

    @media (max-width: 576px) {
        .mobile-header .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            min-height: 38px;
        }
        
        .purchase-card .card-body {
            padding: 0.75rem !important;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            min-height: 32px;
        }
        
        .dropdown-toggle::after {
            margin-left: 0.5em;
        }
        
        .dropdown-menu {
            font-size: 0.9rem;
        }
        
        .dropdown-item {
            padding: 0.75rem 1rem;
        }
    }

    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }
    </style>
</div>