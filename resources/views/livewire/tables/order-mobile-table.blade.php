<div class="mobile-order-container">
    <!-- Mobile Header -->
    <div class="mobile-header">
        <!-- Title Row with Gradient Banner -->
        <div class="header-banner">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="header-title">{{ __('Orders') }}</h1>
                    <p class="header-subtitle">{{ __('Manage your sales') }}</p>
                </div>
                @can('manage-orders')
                <a href="{{ route('orders.create') }}" class="add-order-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
                @endcan
            </div>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       class="search-input" 
                       placeholder="{{ __('Search orders...') }}">
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div wire:loading class="loading-container">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>{{ __('Loading orders...') }}</p>
        </div>
    </div>

    <!-- Orders Grid -->
    <div wire:loading.remove class="orders-section">
        @if($orders->count() > 0)
            <div class="orders-grid">
                @foreach($orders as $order)
                <a href="{{ route('orders.show', $order->uuid) }}" class="order-card">
                    <div class="order-content">
                        <!-- Order Info -->
                        <div class="order-info">
                            <div class="order-header">
                                <h3 class="order-invoice">{{ $order->invoice_no }}</h3>
                                <span class="status-badge {{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'status-complete' : 'status-pending' }}">
                                    {{ $order->order_status->label() }}
                                </span>
                            </div>
                            <p class="order-customer">{{ $order->customer->name ?? 'N/A' }}</p>
                            <div class="order-meta">
                                <span class="order-amount">{{ Number::currency($order->total, 'KES') }}</span>
                                <span class="order-date">{{ $order->order_date->format('d M Y') }}</span>
                            </div>
                        </div>
                        
                        <!-- Arrow indicator -->
                        <div class="card-arrow">
                            <i class="ti ti-chevron-right"></i>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination - Simple Mobile Style -->
            <div class="pagination-section">
                <div class="simple-pagination">
                    @if($orders->onFirstPage())
                        <span class="page-nav disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </span>
                    @else
                        <a href="{{ $orders->previousPageUrl() }}" class="page-nav" wire:click.prevent="previousPage">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </a>
                    @endif
                    
                    <span class="page-indicator">
                        <strong>{{ $orders->currentPage() }}</strong> / {{ $orders->lastPage() }}
                    </span>
                    
                    @if($orders->hasMorePages())
                        <a href="{{ $orders->nextPageUrl() }}" class="page-nav" wire:click.prevent="nextPage">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </a>
                    @else
                        <span class="page-nav disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    @endif
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="ti ti-receipt-off"></i>
                </div>
                <h3>{{ __('No orders found') }}</h3>
                <p>{{ __('Try adjusting your search') }}</p>
                @can('manage-orders')
                <a href="{{ route('orders.create') }}" class="empty-action-btn">
                    <i class="ti ti-plus"></i> {{ __('Create Order') }}
                </a>
                @endcan
            </div>
        @endif
    </div>

    <!-- Custom Styles - Landing Page Inspired -->
    <style>
    /* CSS Variables matching landing page */
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --accent-hover: #ea580c;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
        --bg-gradient-start: #fef3e2;
        --bg-gradient-end: #e0e7ff;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    }

    .mobile-order-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Header Banner */
    .mobile-header {
        position: sticky;
        top: 0;
        z-index: 100;
        background: var(--white);
        border-radius: 0 0 24px 24px;
        box-shadow: var(--shadow-lg);
    }

    .header-banner {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 20px;
        border-radius: 0 0 24px 24px;
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--white);
        margin: 0 0 2px;
    }

    .header-subtitle {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .add-order-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        background: var(--accent);
        color: var(--white);
        border-radius: 50%;
        font-size: 1.25rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
    }

    .add-order-btn:hover {
        background: var(--accent-hover);
        transform: scale(1.05);
        color: var(--white);
    }

    /* Search Container */
    .search-container {
        padding: 16px 20px;
        background: var(--white);
    }

    .search-wrapper {
        display: flex;
        align-items: center;
        background: #f8fafc;
        border-radius: 50px;
        padding: 4px 8px 4px 16px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .search-wrapper:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    .search-icon {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-right: 10px;
    }

    .search-input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 10px 0;
        font-size: 0.95rem;
        color: var(--text-dark);
        outline: none;
    }

    .search-input::placeholder {
        color: var(--text-light);
    }

    /* Loading State */
    .loading-container {
        padding: 60px 20px;
        display: flex;
        justify-content: center;
    }

    .loading-spinner {
        text-align: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 3px solid #e2e8f0;
        border-top-color: var(--accent);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 16px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .loading-spinner p {
        color: var(--text-light);
        font-size: 0.875rem;
    }

    /* Orders Section */
    .orders-section {
        padding: 16px;
    }

    .orders-grid {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Order Card - Clean, tappable design */
    .order-card {
        display: block;
        background: var(--white);
        border-radius: 14px;
        border: none;
        overflow: hidden;
        transition: all 0.2s ease;
        box-shadow: var(--shadow-sm);
        text-decoration: none;
    }

    .order-card:hover,
    .order-card:active {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .order-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px;
    }

    .order-info {
        flex: 1;
        min-width: 0;
    }

    .order-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
    }

    .order-invoice {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .order-customer {
        font-size: 0.85rem;
        color: var(--text-light);
        margin: 0 0 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .order-meta {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .order-amount {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--primary);
    }

    .order-date {
        font-size: 0.75rem;
        color: var(--text-light);
    }

    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 50px;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-complete {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef9c3;
        color: #854d0e;
    }

    /* Arrow indicator */
    .card-arrow {
        color: #cbd5e1;
        font-size: 1.25rem;
        margin-left: 12px;
        flex-shrink: 0;
    }

    /* Pagination */
    .pagination-section {
        margin-top: 20px;
        padding: 16px;
        background: var(--white);
        border-radius: 14px;
        box-shadow: var(--shadow-sm);
    }

    /* Simple Pagination */
    .simple-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
    }

    .page-nav {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--white);
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .page-nav:hover:not(.disabled) {
        background: var(--primary);
        border-color: var(--primary);
        color: var(--white);
    }

    .page-nav.disabled {
        color: #cbd5e1;
        cursor: not-allowed;
        background: #f8fafc;
    }

    .page-indicator {
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .page-indicator strong {
        color: var(--primary);
        font-weight: 700;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        background: var(--white);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon i {
        font-size: 2.5rem;
        color: var(--text-light);
    }

    .empty-state h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 6px;
    }

    .empty-state p {
        color: var(--text-light);
        font-size: 0.875rem;
        margin: 0 0 20px;
    }

    .empty-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary);
        color: var(--white);
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .empty-action-btn:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        color: var(--white);
        box-shadow: var(--shadow-md);
    }
    </style>
</div>
