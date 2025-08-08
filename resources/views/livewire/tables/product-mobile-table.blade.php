<div class="mobile-product-container">
    <!-- Mobile Header -->
    <div class="mobile-header bg-white shadow-sm sticky-top">
        <!-- Title and Add Button -->
        <div class="d-flex align-items-center justify-content-between p-3">
            <h5 class="mb-0 fw-bold">{{ __('Products') }}</h5>
            @can('create-product')
            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">
                {{ __('Add Product') }}
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
                               placeholder="{{ __('Search products...') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Panel -->
        @if($showFilters)
        <div class="border-top bg-light p-3">
            <div class="row g-2">
                <div class="col-6">
                    <label class="form-label mb-1 small">{{ __('Category') }}</label>
                    <select wire:model.live="selectedCategory" class="form-select form-select-sm">
                        <option value="">{{ __('All Categories') }}</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
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

    <!-- Products Grid -->
    <div wire:loading.remove class="p-3">
        @if($products->count() > 0)
            <div class="row g-3">
                @foreach($products as $product)
                <div class="col-12">
                    <div class="card product-card shadow-sm">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Product Info -->
                                <div class="flex-grow-1 me-2">
                                    <h6 class="mb-1 fw-bold text-truncate">{{ $product->name }}</h6>
                                    <span class="badge {{ $product->quantity > 10 ? 'bg-success' : ($product->quantity > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ $product->quantity }} {{ __('in stock') }}
                                    </span>
                                </div>
                                
                                <!-- Action Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        @can('view-product')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('products.show', $product->uuid) }}">
                                                <i class="ti ti-eye me-2"></i>{{ __('View') }}
                                            </a>
                                        </li>
                                        @endcan
                                        @can('update-product')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('products.edit', $product->uuid) }}">
                                                <i class="ti ti-edit me-2"></i>{{ __('Edit') }}
                                            </a>
                                        </li>
                                        @endcan
                                        @can('delete-product')
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('products.destroy', $product->uuid) }}" class="d-inline w-100">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete {{ $product->name }}?')"
                                                        class="dropdown-item text-danger">
                                                    <i class="ti ti-trash me-2"></i>{{ __('Delete') }}
                                                </button>
                                            </form>
                                        </li>
                                        @endcan
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
                        {{ __('Showing') }} {{ $products->firstItem() }} {{ __('to') }} {{ $products->lastItem() }} 
                        {{ __('of') }} {{ $products->total() }} {{ __('results') }}
                    </small>
                </div>
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="ti ti-package-off" style="font-size: 4rem; color: #6c757d;"></i>
                </div>
                <h5 class="text-muted">{{ __('No products found') }}</h5>
                <p class="text-muted">{{ __('Try adjusting your search or filters') }}</p>
                @can('create-product')
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> {{ __('Add Product') }}
                </a>
                @endcan
            </div>
        @endif
    </div>

    <!-- Custom Styles -->
    <style>
    .mobile-product-container {
        max-width: 100%;
        margin: 0 auto;
    }

    .mobile-header {
        border-bottom: 1px solid #dee2e6;
    }

    .product-card {
        border: 1px solid #e9ecef;
        transition: all 0.2s ease;
    }

    .product-card:hover {
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

    @media (max-width: 576px) {
        .mobile-header .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            min-height: 38px;
        }
        
        .mobile-header .btn .d-none.d-sm-inline {
            display: inline !important;
        }
        
        .product-card .card-body {
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

