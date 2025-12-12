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
        --text-dark: #1e1b4b;
        --text-light: #64748b;
        --bg-gradient-start: #fef3e2;
        --bg-gradient-end: #e0e7ff;
    }

    /* Card Styling */
    .purchases-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .purchases-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .purchases-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .purchases-header-content p {
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

    .filter-bar .search-box {
        position: relative;
        flex: 1;
        max-width: 350px;
    }

    .filter-bar .search-box input {
        width: 100%;
        padding: 10px 16px 10px 40px;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.875rem;
        background: white;
        transition: all 0.2s;
    }

    .filter-bar .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    .filter-bar .search-box .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    /* Loading Spinner */
    .loading-overlay {
        padding: 3rem;
        text-align: center;
    }

    /* Table Styling */
    .purchases-table {
        width: 100%;
        border-collapse: collapse;
    }

    .purchases-table thead {
        background: #f8fafc;
    }

    .purchases-table th {
        padding: 1rem 1.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
    }

    .purchases-table th:first-child {
        text-align: left;
    }

    .purchases-table th a {
        color: var(--text-light);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .purchases-table th a:hover {
        color: var(--primary);
    }

    .purchases-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .purchases-table tbody tr:hover {
        background: #fafbfc;
    }

    .purchases-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Purchase Link */
    .purchase-link {
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s;
    }

    .purchase-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    /* Supplier Name */
    .supplier-name {
        font-weight: 500;
    }

    /* Amount */
    .purchase-amount {
        font-weight: 600;
        color: var(--success);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-approved {
        background: var(--success-light);
        color: var(--success);
    }

    .status-pending {
        background: var(--warning-light);
        color: var(--warning);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .action-btn-view {
        background: #e0e7ff;
        color: var(--primary);
    }

    .action-btn-view:hover {
        background: var(--primary);
        color: white;
    }

    .action-btn-approve {
        background: var(--success-light);
        color: var(--success);
    }

    .action-btn-approve:hover {
        background: var(--success);
        color: white;
    }

    .action-btn-delete {
        background: #fee2e2;
        color: #ef4444;
    }

    .action-btn-delete:hover {
        background: #ef4444;
        color: white;
    }

    /* Footer */
    .purchases-footer {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .purchases-footer .text-secondary {
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

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .purchases-header {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .purchases-header-content h1 {
            justify-content: center;
        }

        .btn-create {
            justify-content: center;
        }

        .filter-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-bar .search-box {
            max-width: 100%;
        }

        .purchases-table th,
        .purchases-table td {
            padding: 0.75rem 1rem;
        }

        .purchases-footer {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="purchases-card">
    <!-- Header -->
    <div class="purchases-header">
        <div class="purchases-header-content">
            <h1>{{ __('Purchases') }}</h1>
            <p>{{ $purchases->total() }} {{ __('total purchases') }}</p>
        </div>
        @can('create-purchase')
        <a href="{{ route('purchases.create') }}" class="btn-create">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            {{ __('Add New Purchase') }}
        </a>
        @endcan
    </div>

    <!-- Filter Bar -->
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
        <x-search-input placeholder="Search by purchase no. or supplier..." />
    </div>

    <!-- Loading Spinner -->
    <div wire:loading class="loading-overlay">
        <x-spinner.loading-spinner />
    </div>

    <!-- Table -->
    <div wire:loading.remove class="table-responsive">
        @if($purchases->count() > 0)
        <table class="purchases-table">
            <thead>
                <tr>
                    <th>
                        <a wire:click.prevent="sortBy('purchase_no')" href="#" role="button">
                            {{ __('Purchase No.') }}
                            @include('inclues._sort-icon', ['field' => 'purchase_no'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('supplier_id')" href="#" role="button">
                            {{ __('Supplier') }}
                            @include('inclues._sort-icon', ['field' => 'supplier_id'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            {{ __('Date') }}
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('total_amount')" href="#" role="button">
                            {{ __('Total') }}
                            @include('inclues._sort-icon', ['field' => 'total_amount'])
                        </a>
                    </th>
                    <th class="text-center">
                        <a wire:click.prevent="sortBy('status')" href="#" role="button">
                            {{ __('Status') }}
                            @include('inclues._sort-icon', ['field' => 'status'])
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                <tr>
                    <td>
                        <a href="{{ route('purchases.edit', $purchase->uuid) }}" class="purchase-link">
                            {{ $purchase->purchase_no }}
                        </a>
                    </td>
                    <td class="text-center supplier-name">{{ $purchase->supplier->name }}</td>
                    <td class="text-center">{{ $purchase->date->format('d M Y') }}</td>
                    <td class="text-center purchase-amount">{{ Number::currency($purchase->total_amount, 'KES') }}</td>
                    <td class="text-center">
                        <span class="status-badge {{ $purchase->status === \App\Enums\PurchaseStatus::APPROVED ? 'status-approved' : 'status-pending' }}">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                            {{ $purchase->status === \App\Enums\PurchaseStatus::APPROVED ? __('Approved') : __('Pending') }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
            </div>
            <h3>{{ __('No purchases found') }}</h3>
            <p>{{ __('Try adjusting your search or create a new purchase.') }}</p>
        </div>
        @endif
    </div>

    <!-- Footer -->
    @if($purchases->count() > 0)
    <div class="purchases-footer">
        <p class="m-0 text-secondary">
            {{ __('Showing') }} <strong>{{ $purchases->firstItem() }}</strong> {{ __('to') }} <strong>{{ $purchases->lastItem() }}</strong> {{ __('of') }}
            <strong>{{ $purchases->total() }}</strong> {{ __('entries') }}
        </p>
        <ul class="pagination m-0">
            {{ $purchases->links() }}
        </ul>
    </div>
    @endif
</div>
</div>