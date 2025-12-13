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
    }

    /* Card Styling */
    .units-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .units-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .units-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .units-header-content p {
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

    .units-table {
        width: 100%;
        border-collapse: collapse;
    }

    .units-table thead {
        background: #f8fafc;
    }

    .units-table th {
        padding: 1rem 1.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
    }

    .units-table th:first-child {
        text-align: left;
    }

    .units-table th a {
        color: var(--text-light);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .units-table th a:hover {
        color: var(--primary);
    }

    .units-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .units-table tbody tr:hover {
        background: #fafbfc;
    }

    .units-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Unit Link */
    .unit-link {
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s;
    }

    .unit-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    /* Short Code Badge */
    .short-code-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        background: #e0e7ff;
        color: var(--primary);
    }

    /* Footer */
    .units-footer {
        padding: 1rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        gap: 0.75rem;
    }

    .units-footer .text-secondary {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* Pagination styling */
    .pagination {
        display: flex;
        gap: 4px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination .page-item {
        display: none;
    }

    .pagination .page-item:first-child,
    .pagination .page-item:last-child,
    .pagination .page-item:nth-child(2),
    .pagination .page-item:nth-child(3),
    .pagination .page-item:nth-last-child(2),
    .pagination .page-item:nth-last-child(3),
    .pagination .page-item.active,
    .pagination .page-item.disabled {
        display: inline-block;
    }

    .pagination .page-link {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
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

    .unit-card-item {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .unit-card-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .unit-card-item:last-child {
        margin-bottom: 0;
    }

    .unit-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .unit-card-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        margin: 0;
    }

    .unit-card-name:hover {
        color: var(--primary-light);
        text-decoration: underline;
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
        justify-content: flex-end;
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

        .units-header {
            padding: 1rem;
        }

        .units-header-content h1 {
            font-size: 1.25rem;
        }

        .btn-create {
            padding: 10px 20px;
            font-size: 0.85rem;
        }

        .filter-bar {
            display: none;
        }

        .units-footer {
            flex-direction: column;
            text-align: center;
            padding: 1rem;
        }

        /* Simplified mobile pagination */
        .mobile-view .pagination .page-item {
            display: none;
        }

        .mobile-view .pagination .page-item:first-child,
        .mobile-view .pagination .page-item:last-child,
        .mobile-view .pagination .page-item.active,
        .mobile-view .pagination .page-item.disabled {
            display: inline-block;
        }

        .mobile-view .pagination {
            justify-content: center;
            gap: 4px;
        }

        .mobile-view .pagination .page-link {
            padding: 8px 12px;
            font-size: 0.85rem;
            border-radius: 8px;
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

<div class="units-card">
    <!-- Header -->
    <div class="units-header">
        <div class="units-header-content">
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
                {{ __('Units') }}
            </h1>
            <p>{{ $units->total() }} {{ __('total units') }}</p>
        </div>
        <a href="{{ route('units.create') }}" class="btn-create">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            {{ __('Add New Unit') }}
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
        <x-search-input placeholder="Search units..." />
    </div>

    <!-- Mobile Search -->
    <div class="mobile-view mobile-search">
        <div class="mobile-search-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search units...') }}">
        </div>
    </div>

    <!-- Loading Spinner -->
    <div wire:loading class="loading-overlay">
        <x-spinner.loading-spinner />
    </div>

    <!-- Desktop Table View -->
    <div wire:loading.remove class="desktop-view table-responsive">
        @if($units->count() > 0)
        <table class="units-table">
            <thead>
                <tr>
                    <th>
                        <a wire:click.prevent="sortBy('name')" href="#" role="button">
                            {{ __('Unit Name') }}
                            @include('inclues._sort-icon', ['field' => 'name'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('short_code')" href="#" role="button">
                            {{ __('Short Code') }}
                            @include('inclues._sort-icon', ['field' => 'short_code'])
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                <tr>
                    <td>
                        <a href="{{ route('units.show', $unit) }}" class="unit-link">{{ $unit->name }}</a>
                    </td>
                    <td class="text-center">
                        <span class="short-code-badge">{{ $unit->short_code }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                </svg>
            </div>
            <h3>{{ __('No units found') }}</h3>
            <p>{{ __('Try adjusting your search or add a new unit.') }}</p>
        </div>
        @endif
    </div>

    <!-- Mobile Card View -->
    <div wire:loading.remove class="mobile-view">
        @if($units->count() > 0)
        <div class="mobile-cards-container">
            @foreach ($units as $unit)
            <div class="unit-card-item">
                <div class="unit-card-header">
                    <a href="{{ route('units.show', $unit) }}" class="unit-card-name">{{ $unit->name }}</a>
                    <span class="short-code-badge">{{ $unit->short_code }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Mobile Pagination -->
        <div class="mobile-pagination">
            <p class="mobile-pagination-info m-0">
                {{ __('Showing') }} {{ $units->firstItem() }} - {{ $units->lastItem() }} {{ __('of') }} {{ $units->total() }}
            </p>
        </div>
        <div class="px-3 pb-3">
            {{ $units->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                </svg>
            </div>
            <h3>{{ __('No units found') }}</h3>
            <p>{{ __('Try adjusting your search or add a new unit.') }}</p>
        </div>
        @endif
    </div>

    <!-- Desktop Footer -->
    @if($units->count() > 0)
    <div class="units-footer desktop-view">
        <p class="m-0 text-secondary">
            {{ __('Showing') }} <strong>{{ $units->firstItem() }}</strong> {{ __('to') }} <strong>{{ $units->lastItem() }}</strong> {{ __('of') }}
            <strong>{{ $units->total() }}</strong> {{ __('entries') }}
        </p>
        <ul class="pagination m-0">
            {{ $units->links() }}
        </ul>
    </div>
    @endif
</div>
</div>