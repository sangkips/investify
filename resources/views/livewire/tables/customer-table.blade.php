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
    .customers-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .customers-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .customers-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .customers-header-content p {
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

    .customers-table {
        width: 100%;
        border-collapse: collapse;
    }

    .customers-table thead {
        background: #f8fafc;
    }

    .customers-table th {
        padding: 1rem 1.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
    }

    .customers-table th:first-child {
        text-align: left;
    }

    .customers-table th a {
        color: var(--text-light);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .customers-table th a:hover {
        color: var(--primary);
    }

    .customers-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .customers-table tbody tr:hover {
        background: #fafbfc;
    }

    .customers-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Customer Link */
    .customer-link {
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s;
    }

    .customer-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    /* Email */
    .customer-email {
        color: var(--text-light);
    }

    /* Phone */
    .customer-phone {
        font-weight: 500;
    }

    /* Footer */
    .customers-footer {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .customers-footer .text-secondary {
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

    .customer-card-item {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .customer-card-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .customer-card-item:last-child {
        margin-bottom: 0;
    }

    .customer-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }

    .customer-card-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        margin: 0;
    }

    .customer-card-name:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    .customer-card-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .customer-card-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--text-light);
    }

    .customer-card-row svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        opacity: 0.7;
    }

    .customer-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f1f5f9;
    }

    .customer-card-date {
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

        .customers-header {
            padding: 1rem;
        }

        .customers-header-content h1 {
            font-size: 1.25rem;
        }

        .btn-create {
            padding: 10px 20px;
            font-size: 0.85rem;
        }

        .filter-bar {
            display: none;
        }

        .customers-footer {
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

<div class="customers-card">
    <!-- Header -->
    <div class="customers-header">
        <div class="customers-header-content">
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                {{ __('Customers') }}
            </h1>
            <p>{{ $customers->total() }} {{ __('total customers') }}</p>
        </div>
        <a href="{{ route('customers.create') }}" class="btn-create">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            {{ __('Add New Customer') }}
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
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search customers...') }}">
        </div>
    </div>

    <!-- Loading Spinner -->
    <div wire:loading class="loading-overlay">
        <x-spinner.loading-spinner />
    </div>

    <!-- Desktop Table View -->
    <div wire:loading.remove class="desktop-view table-responsive">
        @if($customers->count() > 0)
        <table class="customers-table">
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
                        <a wire:click.prevent="sortBy('phone')" href="#" role="button">
                            {{ __('Phone') }}
                            @include('inclues._sort-icon', ['field' => 'phone'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('address')" href="#" role="button">
                            {{ __('Address') }}
                            @include('inclues._sort-icon', ['field' => 'address'])
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
                @foreach ($customers as $customer)
                <tr>
                    <td>
                        <a href="{{ route('customers.show', $customer->uuid) }}" class="customer-link">
                            {{ $customer->name }}
                        </a>
                    </td>
                    <td class="text-center customer-email">{{ $customer->email }}</td>
                    <td class="text-center customer-phone">{{ $customer->phone ?? '-' }}</td>
                    <td class="text-center">{{ Str::limit($customer->address, 30) ?? '-' }}</td>
                    <td class="text-center">{{ $customer->created_at->diffForHumans() }}</td>
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
            <h3>{{ __('No customers found') }}</h3>
            <p>{{ __('Try adjusting your search or add a new customer.') }}</p>
        </div>
        @endif
    </div>

    <!-- Mobile Card View -->
    <div wire:loading.remove class="mobile-view">
        @if($customers->count() > 0)
        <div class="mobile-cards-container">
            @foreach ($customers as $customer)
            <div class="customer-card-item">
                <div class="customer-card-header">
                    <a href="{{ route('customers.show', $customer->uuid) }}" class="customer-card-name">
                        {{ $customer->name }}
                    </a>
                </div>
                <div class="customer-card-info">
                    <div class="customer-card-row">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <span>{{ $customer->email }}</span>
                    </div>
                    @if($customer->phone)
                    <div class="customer-card-row">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <span>{{ $customer->phone }}</span>
                    </div>
                    @endif
                    @if($customer->address)
                    <div class="customer-card-row">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>{{ Str::limit($customer->address, 40) }}</span>
                    </div>
                    @endif
                </div>
                <div class="customer-card-footer">
                    <span class="customer-card-date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline; vertical-align: middle; margin-right: 4px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        {{ $customer->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Mobile Pagination -->
        <div class="mobile-pagination">
            <p class="mobile-pagination-info m-0">
                {{ __('Showing') }} {{ $customers->firstItem() }} - {{ $customers->lastItem() }} {{ __('of') }} {{ $customers->total() }}
            </p>
        </div>
        <div class="px-3 pb-3">
            {{ $customers->links() }}
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
            <h3>{{ __('No customers found') }}</h3>
            <p>{{ __('Try adjusting your search or add a new customer.') }}</p>
        </div>
        @endif
    </div>

    <!-- Desktop Footer -->
    @if($customers->count() > 0)
    <div class="customers-footer desktop-view">
        <p class="m-0 text-secondary">
            {{ __('Showing') }} <strong>{{ $customers->firstItem() }}</strong> {{ __('to') }} <strong>{{ $customers->lastItem() }}</strong> {{ __('of') }}
            <strong>{{ $customers->total() }}</strong> {{ __('entries') }}
        </p>
        <ul class="pagination m-0">
            {{ $customers->links() }}
        </ul>
    </div>
    @endif
</div>
</div>