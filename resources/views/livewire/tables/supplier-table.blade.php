<div>
<style>
    /* Variables matching landing page */
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --accent-hover: #ea580c;
        --success: #22c55e;
        --success-light: #dcfce7;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
        --bg-gradient-start: #fef3e2;
        --bg-gradient-end: #e0e7ff;
    }

    /* Card Styling */
    .suppliers-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .suppliers-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .suppliers-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .suppliers-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .btn-create {
        background: var(--accent);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-create:hover {
        background: var(--accent-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    /* Filter Bar */
    .filter-bar {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .filter-bar .entries-select {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .filter-bar select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 6px 12px;
        font-size: 0.875rem;
    }

    /* Loading Spinner */
    .loading-overlay {
        padding: 3rem;
        text-align: center;
    }

    /* Desktop Table Styling */
    .desktop-view {
        display: block;
    }

    .suppliers-table {
        width: 100%;
        border-collapse: collapse;
    }

    .suppliers-table thead {
        background: #f8fafc;
    }

    .suppliers-table th {
        padding: 1rem 1.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
    }

    .suppliers-table th:first-child {
        text-align: left;
    }

    .suppliers-table th a {
        color: var(--text-light);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .suppliers-table th a:hover {
        color: var(--primary);
    }

    .suppliers-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .suppliers-table tbody tr:hover {
        background: #fafbfc;
    }

    .suppliers-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Supplier Link */
    .supplier-link {
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s;
    }

    .supplier-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    /* Shop Name */
    .shop-name {
        font-weight: 500;
    }

    /* Email */
    .supplier-email {
        color: var(--text-light);
    }

    /* Type Badge */
    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        background: #e0e7ff;
        color: var(--primary);
    }

    /* Footer */
    .suppliers-footer {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .suppliers-footer .text-secondary {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon svg {
        width: 40px;
        height: 40px;
        color: var(--text-light);
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 8px;
    }

    .empty-state p {
        color: var(--text-light);
        font-size: 0.9rem;
        margin: 0;
    }

    /* Mobile View */
    .mobile-view {
        display: none;
    }

    .supplier-card-item {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .supplier-card-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .supplier-card-item:last-child {
        margin-bottom: 0;
    }

    .supplier-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }

    .supplier-card-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        margin: 0;
    }

    .supplier-card-name:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    .supplier-card-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .supplier-card-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--text-light);
    }

    .supplier-card-row svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        opacity: 0.7;
    }

    .supplier-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f1f5f9;
    }

    .supplier-card-date {
        font-size: 0.75rem;
        color: var(--text-light);
    }

    /* Mobile Search */
    .mobile-search {
        padding: 0 1rem 1rem;
        background: #f8fafc;
    }

    .mobile-search input {
        width: 100%;
        padding: 12px 16px 12px 44px;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.9rem;
        background: white;
        transition: all 0.2s;
    }

    .mobile-search input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    .mobile-search-wrapper {
        position: relative;
    }

    .mobile-search-wrapper svg {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: var(--text-light);
    }

    .mobile-cards-container {
        padding: 1rem;
        background: #f8fafc;
    }

    .mobile-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
    }

    .mobile-pagination-info {
        font-size: 0.8rem;
        color: var(--text-light);
        text-align: center;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .desktop-view {
            display: none;
        }

        .mobile-view {
            display: block;
        }

        .suppliers-header {
            padding: 1rem;
        }

        .suppliers-header-content h1 {
            font-size: 1.25rem;
        }

        .btn-create {
            padding: 10px 20px;
            font-size: 0.85rem;
        }

        .filter-bar {
            display: none;
        }

        .suppliers-footer {
            flex-direction: column;
            text-align: center;
            padding: 1rem;
        }
    }

    @media (min-width: 769px) {
        .mobile-view {
            display: none !important;
        }

        .desktop-view {
            display: block !important;
        }
    }
</style>

<div class="suppliers-card">
    <!-- Header -->
    <div class="suppliers-header">
        <div class="suppliers-header-content">
            <h1>{{ __('Suppliers') }}</h1>
            <p>{{ $suppliers->total() }} {{ __('total suppliers') }}</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn-create">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            {{ __('Add New Supplier') }}
        </a>
    </div>

    <!-- Desktop Filter Bar -->
    <div class="filter-bar">
        <div class="entries-select">
            <span>{{ __('Show') }}</span>
            <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
            </select>
            <span>{{ __('entries') }}</span>
        </div>
        <x-search-input placeholder="Search by name, email or phone..." />
    </div>

    <!-- Mobile Search -->
    <div class="mobile-view mobile-search">
        <div class="mobile-search-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search suppliers...') }}">
        </div>
    </div>

    <!-- Loading Spinner -->
    <div wire:loading class="loading-overlay">
        <x-spinner.loading-spinner />
    </div>

    <!-- Desktop Table View -->
    <div wire:loading.remove class="desktop-view table-responsive">
        @if($suppliers->count() > 0)
        <table class="suppliers-table">
            <thead>
                <tr>
                    <th>
                        <a wire:click.prevent="sortBy('name')" href="#" role="button">
                            {{ __('Name') }}
                            @include('inclues._sort-icon', ['field' => 'name'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('email')" href="#" role="button">
                            {{ __('Email') }}
                            @include('inclues._sort-icon', ['field' => 'email'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('shopname')" href="#" role="button">
                            {{ __('Shop Name') }}
                            @include('inclues._sort-icon', ['field' => 'shopname'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('type')" href="#" role="button">
                            {{ __('Type') }}
                            @include('inclues._sort-icon', ['field' => 'type'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('created_at')" href="#" role="button">
                            {{ __('Created') }}
                            @include('inclues._sort-icon', ['field' => 'created_at'])
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <td>
                        <a href="{{ route('suppliers.show', $supplier->uuid) }}" class="supplier-link">
                            {{ $supplier->name }}
                        </a>
                    </td>
                    <td class="text-center supplier-email">{{ $supplier->email }}</td>
                    <td class="text-center shop-name">{{ $supplier->shopname }}</td>
                    <td class="text-center">
                        <span class="type-badge">
                            {{ $supplier->type }}
                        </span>
                    </td>
                    <td class="text-center">{{ $supplier->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h3>{{ __('No suppliers found') }}</h3>
            <p>{{ __('Try adjusting your search or add a new supplier.') }}</p>
        </div>
        @endif
    </div>

    <!-- Mobile Card View -->
    <div wire:loading.remove class="mobile-view">
        @if($suppliers->count() > 0)
        <div class="mobile-cards-container">
            @foreach ($suppliers as $supplier)
            <div class="supplier-card-item">
                <div class="supplier-card-header">
                    <a href="{{ route('suppliers.show', $supplier->uuid) }}" class="supplier-card-name">
                        {{ $supplier->name }}
                    </a>
                    <span class="type-badge">
                        {{ $supplier->type }}
                    </span>
                </div>
                <div class="supplier-card-info">
                    <div class="supplier-card-row">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <span>{{ $supplier->email }}</span>
                    </div>
                    @if($supplier->shopname)
                    <div class="supplier-card-row">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>{{ $supplier->shopname }}</span>
                    </div>
                    @endif
                    @if($supplier->phone)
                    <div class="supplier-card-row">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <span>{{ $supplier->phone }}</span>
                    </div>
                    @endif
                </div>
                <div class="supplier-card-footer">
                    <span class="supplier-card-date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline; vertical-align: middle; margin-right: 4px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        {{ $supplier->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Mobile Pagination -->
        <div class="mobile-pagination">
            <p class="mobile-pagination-info m-0">
                {{ __('Showing') }} {{ $suppliers->firstItem() }} - {{ $suppliers->lastItem() }} {{ __('of') }} {{ $suppliers->total() }}
            </p>
        </div>
        <div class="px-3 pb-3">
            {{ $suppliers->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h3>{{ __('No suppliers found') }}</h3>
            <p>{{ __('Try adjusting your search or add a new supplier.') }}</p>
        </div>
        @endif
    </div>

    <!-- Desktop Footer -->
    @if($suppliers->count() > 0)
    <div class="suppliers-footer desktop-view">
        <p class="m-0 text-secondary">
            {{ __('Showing') }} <strong>{{ $suppliers->firstItem() }}</strong> {{ __('to') }} <strong>{{ $suppliers->lastItem() }}</strong> {{ __('of') }}
            <strong>{{ $suppliers->total() }}</strong> {{ __('entries') }}
        </p>
        <ul class="pagination m-0">
            {{ $suppliers->links() }}
        </ul>
    </div>
    @endif
</div>
</div>