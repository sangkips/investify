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

    /* Container */
    .mobile-purchases-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
    }

    /* Header */
    .mobile-purchases-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.25rem;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .header-title h1 {
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
    }

    .header-title p {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .btn-add {
        background: var(--accent);
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
        transition: all 0.2s;
    }

    .btn-add:hover {
        background: var(--accent-hover);
        color: white;
        transform: translateY(-2px);
    }

    /* Search Bar */
    .search-container {
        position: relative;
    }

    .search-container input {
        width: 100%;
        padding: 12px 16px 12px 44px;
        border: none;
        border-radius: 50px;
        font-size: 0.875rem;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        backdrop-filter: blur(10px);
    }

    .search-container input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-container input:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.25);
    }

    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.6);
    }

    /* Loading */
    .loading-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 3rem;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid rgba(30, 27, 75, 0.1);
        border-top-color: var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Purchases List */
    .purchases-list {
        padding: 1rem;
    }

    /* Purchase Card */
    .purchase-card {
        background: white;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
    }

    .purchase-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .purchase-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }

    .purchase-info .purchase-number {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        display: block;
        margin-bottom: 4px;
    }

    .purchase-info .purchase-number:hover {
        color: var(--primary-light);
    }

    .purchase-info .supplier-name {
        font-size: 0.8rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.65rem;
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

    .purchase-card-body {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .purchase-details {
        display: flex;
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 0.65rem;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .detail-value {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .detail-value.amount {
        color: var(--success);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 6px;
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
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 8px;
    }

    .empty-state p {
        color: var(--text-light);
        font-size: 0.875rem;
        margin: 0 0 1.5rem;
    }

    /* Pagination */
    .pagination-container {
        padding: 1rem;
        background: white;
        border-radius: 16px;
        margin: 0 1rem 1rem;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }

    .pagination-info {
        text-align: center;
        font-size: 0.75rem;
        color: var(--text-light);
        margin-bottom: 0.75rem;
    }

    .pagination-nav {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: white;
        color: var(--text-dark);
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .page-btn:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .page-current {
        font-size: 0.8rem;
        color: var(--text-light);
        padding: 8px 12px;
    }
</style>

<div class="mobile-purchases-container">
    <!-- Header -->
    <div class="mobile-purchases-header">
        <div class="header-top">
            <div class="header-title">
                <h1>{{ __('Purchases') }}</h1>
                <p>{{ $purchases->total() }} {{ __('total purchases') }}</p>
            </div>
            @can('create-purchase')
            <a href="{{ route('purchases.create') }}" class="btn-add">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                {{ __('Add') }}
            </a>
            @endcan
        </div>
        <div class="search-container">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="{{ __('Search purchases...') }}">
        </div>
    </div>

    <!-- Loading -->
    <div wire:loading class="loading-container">
        <div class="loading-spinner"></div>
    </div>

    <!-- Purchases List -->
    <div wire:loading.remove class="purchases-list">
        @if($purchases->count() > 0)
            @foreach($purchases as $purchase)
            <div class="purchase-card">
                <div class="purchase-card-header">
                    <div class="purchase-info">
                        <a href="{{ route('purchases.edit', $purchase->uuid) }}" class="purchase-number">
                            {{ $purchase->purchase_no }}
                        </a>
                        <span class="supplier-name">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            {{ $purchase->supplier ? $purchase->supplier->name : 'No Supplier' }}
                        </span>
                    </div>
                    <span class="status-badge {{ $purchase->status === \App\Enums\PurchaseStatus::APPROVED ? 'status-approved' : 'status-pending' }}">
                        <span style="width: 5px; height: 5px; border-radius: 50%; background: currentColor;"></span>
                        {{ $purchase->status === \App\Enums\PurchaseStatus::APPROVED ? __('Approved') : __('Pending') }}
                    </span>
                </div>
                <div class="purchase-card-body">
                    <div class="purchase-details">
                        <div class="detail-item">
                            <span class="detail-label">{{ __('Date') }}</span>
                            <span class="detail-value">{{ $purchase->date->format('d M Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">{{ __('Total') }}</span>
                            <span class="detail-value amount">{{ Number::currency($purchase->total_amount, 'KES') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info">
                    {{ __('Showing') }} {{ $purchases->firstItem() }} {{ __('to') }} {{ $purchases->lastItem() }} {{ __('of') }} {{ $purchases->total() }}
                </div>
                <div class="pagination-nav">
                    @if($purchases->onFirstPage())
                        <span class="page-btn" style="opacity: 0.5; pointer-events: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </span>
                    @else
                        <a href="{{ $purchases->previousPageUrl() }}" class="page-btn" wire:click.prevent="previousPage">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </a>
                    @endif
                    <span class="page-current">{{ $purchases->currentPage() }} / {{ $purchases->lastPage() }}</span>
                    @if($purchases->hasMorePages())
                        <a href="{{ $purchases->nextPageUrl() }}" class="page-btn" wire:click.prevent="nextPage">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </a>
                    @else
                        <span class="page-btn" style="opacity: 0.5; pointer-events: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    @endif
                </div>
            </div>
        @else
            <!-- Empty State -->
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
                @can('create-purchase')
                <a href="{{ route('purchases.create') }}" class="btn-add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    {{ __('Add Purchase') }}
                </a>
                @endcan
            </div>
        @endif
    </div>
</div>
</div>