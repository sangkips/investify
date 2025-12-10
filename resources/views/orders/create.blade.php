@extends('layouts.tabler')

@push('page-styles')
<style>
    /* ============================================
       CREATE ORDER PAGE - FULL REDESIGN
       Modern, Scalable, Mobile-First
    ============================================ */
    
    :root {
        --pos-primary: #1e1b4b;
        --pos-primary-light: #312e81;
        --pos-accent: #f97316;
        --pos-accent-hover: #ea580c;
        --pos-success: #22c55e;
        --pos-danger: #ef4444;
        --pos-bg-start: #fef3e2;
        --pos-bg-end: #e0e7ff;
        --pos-text: #1e293b;
        --pos-text-muted: #64748b;
        --pos-border: #e2e8f0;
        --pos-card-bg: #ffffff;
        --pos-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    /* Make navbar sticky */
    .navbar {
        position: sticky !important;
        top: 0;
        z-index: 1020;
        background: #fff !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .page-body {
        background: linear-gradient(135deg, var(--pos-bg-start) 0%, var(--pos-bg-end) 100%);
        min-height: calc(100vh - 60px);
        padding: 1rem;
    }

    /* ===== Layout Container ===== */
    .pos-container {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 1.5rem;
        max-width: 1600px;
        margin: 0 auto;
        height: calc(100vh - 100px);
    }

    /* ===== Panel Styles ===== */
    .pos-panel {
        background: var(--pos-card-bg);
        border-radius: 20px;
        box-shadow: var(--pos-shadow);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        max-height: calc(100vh - 100px);
    }

    .pos-panel.cart-panel {
        display: flex;
        flex-direction: column;
    }

    .pos-panel.cart-panel form {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-height: 0;
        overflow: hidden;
    }

    .pos-panel-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--pos-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }

    .pos-panel-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--pos-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pos-panel-body {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
    }

    /* Products panel should fill available height */
    .products-panel .pos-panel-body {
        max-height: calc(100vh - 200px);
    }

    /* Pagination styling */
    #paginationArea {
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        border-top: 1px solid var(--pos-border);
    }

    #paginationArea .pagination {
        margin: 0;
        justify-content: center;
        gap: 0.25rem;
    }

    #paginationArea .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.8rem;
        border-radius: 6px;
    }

    /* ===== Search Box ===== */
    .pos-search {
        position: relative;
        margin-bottom: 1rem;
    }

    .pos-search input {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border: 2px solid var(--pos-border);
        border-radius: 50px;
        font-size: 1rem;
        transition: all 0.2s;
        background: #f8fafc;
    }

    .pos-search input:focus {
        outline: none;
        border-color: var(--pos-primary);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(30, 27, 75, 0.1);
    }

    .pos-search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--pos-text-muted);
    }

    .pos-search-clear {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: #e2e8f0;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--pos-text-muted);
    }

    .pos-search-clear:hover {
        background: #cbd5e1;
        color: var(--pos-text);
    }

    .pos-search-status {
        font-size: 0.75rem;
        color: var(--pos-text-muted);
        margin-top: 0.5rem;
        min-height: 1.25rem;
    }

    /* ===== Product Grid ===== */
    .pos-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1rem;
    }

    .pos-product-card {
        background: #f8fafc;
        border: 2px solid transparent;
        border-radius: 16px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }

    .pos-product-card:hover {
        border-color: var(--pos-primary);
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .pos-product-card.out-of-stock {
        opacity: 0.5;
        pointer-events: none;
    }

    .pos-product-name {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--pos-text);
        margin-bottom: 0.25rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .pos-product-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--pos-accent);
        margin-bottom: 0.25rem;
    }

    .pos-product-stock {
        font-size: 0.7rem;
        color: var(--pos-text-muted);
    }

    .pos-product-add-btn {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: none;
        background: var(--pos-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.2s;
    }

    .pos-product-card:hover .pos-product-add-btn {
        opacity: 1;
        transform: scale(1);
    }

    /* ===== Cart Panel ===== */
    .pos-cart-header-info {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .pos-cart-field {
        flex: 1;
        min-width: 100px;
    }

    .pos-cart-field label {
        display: block;
        font-size: 0.7rem;
        text-transform: uppercase;
        color: var(--pos-text-muted);
        margin-bottom: 0.25rem;
        font-weight: 600;
    }

    .pos-cart-field input,
    .pos-cart-field select {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--pos-border);
        border-radius: 8px;
        font-size: 0.875rem;
    }

    /* ===== Cart Items ===== */
    .pos-cart-items {
        flex: 1;
        overflow-y: auto;
        min-height: 100px;
        max-height: calc(100vh - 450px);
    }

    .pos-cart-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        border-bottom: 1px solid var(--pos-border);
        transition: background 0.2s;
    }

    .pos-cart-item:hover {
        background: #f8fafc;
    }

    .pos-cart-item-info {
        flex: 1;
        min-width: 0;
    }

    .pos-cart-item-name {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--pos-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pos-cart-item-price {
        font-size: 0.75rem;
        color: var(--pos-text-muted);
    }

    /* Quantity Stepper */
    .pos-qty-stepper {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        background: #f1f5f9;
        border-radius: 8px;
        padding: 2px;
    }

    .pos-qty-btn {
        width: 28px;
        height: 28px;
        border: none;
        background: var(--pos-card-bg);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        color: var(--pos-text);
    }

    .pos-qty-btn:hover {
        background: var(--pos-primary);
        color: #fff;
    }

    .pos-qty-value {
        min-width: 32px;
        text-align: center;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .pos-cart-item-subtotal {
        font-weight: 700;
        font-size: 0.875rem;
        color: var(--pos-primary);
        min-width: 70px;
        text-align: right;
    }

    .pos-cart-item-remove {
        background: none;
        border: none;
        color: var(--pos-danger);
        cursor: pointer;
        padding: 0.25rem;
        opacity: 0.6;
        transition: opacity 0.2s;
    }

    .pos-cart-item-remove:hover {
        opacity: 1;
    }

    /* ===== Cart Footer (Sticky) ===== */
    .pos-cart-footer {
        background: var(--pos-card-bg);
        border-top: 2px solid var(--pos-border);
        padding: 1rem;
        flex-shrink: 0;
    }

    .pos-totals {
        margin-bottom: 1rem;
    }

    .pos-total-row {
        display: flex;
        justify-content: space-between;
        padding: 0.375rem 0;
        font-size: 0.875rem;
    }

    .pos-total-row.grand-total {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--pos-primary);
        border-top: 2px solid var(--pos-border);
        padding-top: 0.75rem;
        margin-top: 0.5rem;
    }

    .pos-checkout-btn {
        width: 100%;
        padding: 1rem;
        border: none;
        border-radius: 50px;
        background: var(--pos-primary);
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .pos-checkout-btn:hover {
        background: var(--pos-primary-light);
        transform: translateY(-2px);
    }

    .pos-checkout-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    /* ===== Empty States ===== */
    .pos-empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--pos-text-muted);
    }

    .pos-empty-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* ===== Mobile Tabs ===== */
    .pos-mobile-tabs {
        display: none;
        background: var(--pos-card-bg);
        border-radius: 50px;
        padding: 4px;
        margin-bottom: 1rem;
        box-shadow: var(--pos-shadow);
    }

    .pos-mobile-tab {
        flex: 1;
        padding: 0.75rem 1rem;
        border: none;
        background: transparent;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .pos-mobile-tab.active {
        background: var(--pos-primary);
        color: #fff;
    }

    .pos-cart-badge {
        background: var(--pos-accent);
        color: #fff;
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 10px;
        font-weight: 700;
    }

    /* ===== Floating Cart Button (Mobile) ===== */
    .pos-floating-cart {
        display: none;
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        background: var(--pos-primary);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 1rem 1.5rem;
        box-shadow: 0 8px 24px rgba(30, 27, 75, 0.4);
        cursor: pointer;
        z-index: 1000;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .pos-floating-cart-badge {
        background: var(--pos-accent);
        color: #fff;
        padding: 4px 10px;
        border-radius: 20px;
        margin-left: 0.5rem;
        font-weight: 700;
    }

    /* ===== Highlight Match ===== */
    .highlight-match {
        background: #fef3c7;
        padding: 0 2px;
        border-radius: 2px;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 1024px) {
        .pos-container {
            grid-template-columns: 1fr 350px;
        }
    }

    @media (max-width: 768px) {
        .pos-mobile-tabs {
            display: flex;
        }

        .pos-container {
            grid-template-columns: 1fr;
            height: auto;
        }

        .pos-panel.products-panel {
            display: block;
        }

        /* Sticky search on mobile */
        .pos-panel.products-panel .pos-panel-header {
            position: sticky;
            top: 0;
            z-index: 10;
            background: var(--pos-card-bg);
        }

        .pos-panel.products-panel .pos-search {
            position: sticky;
            top: 52px;
            z-index: 9;
            background: var(--pos-card-bg);
            padding: 0.5rem 1rem;
            margin: -1rem -1rem 0.5rem -1rem;
            border-bottom: 1px solid var(--pos-border);
        }

        .pos-panel.products-panel .pos-search-status {
            margin-bottom: 0.25rem;
        }

        .pos-panel.products-panel .pos-products-grid {
            padding-top: 0;
        }

        .pos-panel.cart-panel {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1001;
            border-radius: 0;
            margin: 0;
        }

        .pos-panel.cart-panel.show {
            display: flex;
        }

        .pos-floating-cart {
            display: flex;
            align-items: center;
        }

        .pos-products-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        }

        .pos-cart-close {
            display: block;
        }
    }

    @media (max-width: 480px) {
        .pos-products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }

        .pos-product-card {
            padding: 0.75rem;
        }

        .pos-product-name {
            font-size: 0.8rem;
        }
    }
</style>
@endpush

@section('content')
<div class="page-body">
    <div class="container-xl">
        
        <!-- Mobile Tabs -->
        <div class="pos-mobile-tabs" id="mobileTabs">
            <button class="pos-mobile-tab active" data-tab="products" id="productsTab">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                Products
            </button>
            <button class="pos-mobile-tab" data-tab="cart" id="cartTab">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                Cart
                <span class="pos-cart-badge" id="cartBadge">{{ Cart::count() }}</span>
            </button>
        </div>

        <div class="pos-container">
            
            <!-- Products Panel -->
            <div class="pos-panel products-panel" id="productsPanel">
                <div class="pos-panel-header">
                    <h2 class="pos-panel-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                        </svg>
                        Products
                    </h2>
                </div>
                
                <div class="pos-panel-body">
                    <!-- Search -->
                    <div class="pos-search">
                        <svg class="pos-search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="productSearch" placeholder="Search products by name or code..." autocomplete="off">
                        <button class="pos-search-clear" id="searchClear" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="pos-search-status" id="searchStatus"></div>

                    <!-- Products Grid -->
                    <div class="pos-products-grid" id="productsGrid">
                        @forelse ($products as $product)
                        <div class="pos-product-card {{ $product->quantity <= 0 ? 'out-of-stock' : '' }}" 
                             data-id="{{ $product->id }}"
                             data-name="{{ $product->name }}"
                             data-slug="{{ $product->slug }}"
                             data-price="{{ $product->selling_price }}"
                             data-stock="{{ $product->quantity }}">
                            <button class="pos-product-add-btn" type="button" title="Add to cart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                            <div class="pos-product-name">{{ $product->name }}</div>
                            <div class="pos-product-price">{{ number_format($product->selling_price, 2) }}</div>
                            <div class="pos-product-stock">
                                {{ $product->quantity > 0 ? $product->quantity . ' ' . ($product->unit->name ?? 'pcs') : 'Out of stock' }}
                            </div>
                        </div>
                        @empty
                        <div class="pos-empty-state" style="grid-column: 1/-1;">
                            <div class="pos-empty-icon">📦</div>
                            <p>No products found</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3" id="paginationArea">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>

            <!-- Cart Panel -->
            <div class="pos-panel cart-panel" id="cartPanel">
                <div class="pos-panel-header">
                    <h2 class="pos-panel-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        New Order
                    </h2>
                    <button class="pos-cart-close btn btn-sm d-md-none" id="closeCart" style="display:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('invoice.create') }}" method="POST" id="orderForm">
                    @csrf
                    
                    <!-- Cart Header Fields -->
                    <div class="pos-cart-header-info" style="padding: 1rem; border-bottom: 1px solid var(--pos-border);">
                        <div class="pos-cart-field">
                            <label>Date</label>
                            <input type="date" name="purchase_date" value="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        <div class="pos-cart-field">
                            <label>Customer</label>
                            <select name="customer_id" required>
                                <option value="">Select</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pos-cart-field" style="max-width: 80px;">
                            <label>Ref</label>
                            <input type="text" name="reference" value="ORD" readonly>
                        </div>
                    </div>

                    <!-- Cart Items -->
                    <div class="pos-cart-items" id="cartItems">
                        @forelse ($carts as $item)
                        <div class="pos-cart-item" data-rowid="{{ $item->rowId }}">
                            <div class="pos-cart-item-info">
                                <div class="pos-cart-item-name">{{ $item->name }}</div>
                                <div class="pos-cart-item-price">@ {{ number_format($item->price, 2) }}</div>
                            </div>
                            <div class="pos-qty-stepper">
                                <button type="button" class="pos-qty-btn qty-minus" data-rowid="{{ $item->rowId }}" data-productid="{{ $item->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                                <span class="pos-qty-value">{{ $item->qty }}</span>
                                <button type="button" class="pos-qty-btn qty-plus" data-rowid="{{ $item->rowId }}" data-productid="{{ $item->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="pos-cart-item-subtotal">{{ number_format($item->subtotal, 2) }}</div>
                            <button type="button" class="pos-cart-item-remove" data-rowid="{{ $item->rowId }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                        @empty
                        <div class="pos-empty-state" id="emptyCart">
                            <div class="pos-empty-icon">🛒</div>
                            <p>Your cart is empty</p>
                            <small>Click on products to add them</small>
                        </div>
                        @endforelse
                    </div>

                    <!-- Cart Footer with Totals -->
                    <div class="pos-cart-footer">
                        <div class="pos-totals">
                            <div class="pos-total-row">
                                <span>Items</span>
                                <span id="totalItems">{{ Cart::count() }}</span>
                            </div>
                            <div class="pos-total-row">
                                <span>Subtotal</span>
                                <span id="subtotal">{{ Cart::subtotal() }}</span>
                            </div>
                            <div class="pos-total-row">
                                <span>Tax (16%)</span>
                                <span id="taxAmount">{{ Cart::tax() }}</span>
                            </div>
                            <div class="pos-total-row grand-total">
                                <span>Total</span>
                                <span id="grandTotal">{{ Cart::total() }}</span>
                            </div>
                        </div>
                        <button type="submit" class="pos-checkout-btn" id="checkoutBtn" {{ Cart::count() > 0 ? '' : 'disabled' }}>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                            Create Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Floating Cart Button (Mobile) -->
        <button class="pos-floating-cart" id="floatingCart">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            View Cart
            <span class="pos-floating-cart-badge" id="floatingCartBadge">{{ Cart::count() }}</span>
        </button>

    </div>
</div>
@endsection

@pushonce('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const searchInput = document.getElementById('productSearch');
    const searchClear = document.getElementById('searchClear');
    const searchStatus = document.getElementById('searchStatus');
    const productsGrid = document.getElementById('productsGrid');
    const paginationArea = document.getElementById('paginationArea');
    const cartPanel = document.getElementById('cartPanel');
    const floatingCart = document.getElementById('floatingCart');
    const cartBadge = document.getElementById('cartBadge');
    const floatingCartBadge = document.getElementById('floatingCartBadge');
    const productsTab = document.getElementById('productsTab');
    const cartTab = document.getElementById('cartTab');
    const closeCartBtn = document.getElementById('closeCart');
    
    let debounceTimer;
    let originalGridContent = productsGrid.innerHTML;
    let isSearching = false;

    // ===== SEARCH FUNCTIONALITY =====
    function debounce(func, delay) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(func, delay);
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function highlightMatch(text, term) {
        if (!term) return escapeHtml(text);
        const regex = new RegExp(`(${term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return escapeHtml(text).replace(regex, '<span class="highlight-match">$1</span>');
    }

    function createProductCard(product, searchTerm) {
        const outOfStock = product.quantity <= 0;
        return `
            <div class="pos-product-card ${outOfStock ? 'out-of-stock' : ''}" 
                 data-id="${product.id}"
                 data-name="${escapeHtml(product.name)}"
                 data-slug="${product.slug}"
                 data-price="${product.selling_price_raw}"
                 data-stock="${product.quantity}">
                <button class="pos-product-add-btn" type="button" title="Add to cart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
                <div class="pos-product-name">${highlightMatch(product.name, searchTerm)}</div>
                <div class="pos-product-price">${product.selling_price}</div>
                <div class="pos-product-stock">${outOfStock ? 'Out of stock' : product.quantity + ' ' + product.unit_name}</div>
            </div>
        `;
    }

    async function performSearch() {
        const term = searchInput.value.trim();
        
        searchClear.style.display = term.length > 0 ? 'flex' : 'none';
        
        if (term === '') {
            if (isSearching) {
                productsGrid.innerHTML = originalGridContent;
                paginationArea.style.display = '';
                isSearching = false;
            }
            searchStatus.textContent = '';
            bindProductCards();
            return;
        }
        
        searchStatus.textContent = 'Searching...';
        
        try {
            const response = await fetch(`/orders/search-products?q=${encodeURIComponent(term)}`);
            const data = await response.json();
            isSearching = true;
            paginationArea.style.display = 'none';
            
            if (data.products.length === 0) {
                productsGrid.innerHTML = `
                    <div class="pos-empty-state" style="grid-column: 1/-1;">
                        <div class="pos-empty-icon">🔍</div>
                        <p>No products matching "${escapeHtml(term)}"</p>
                    </div>
                `;
                searchStatus.textContent = 'No results';
            } else {
                productsGrid.innerHTML = data.products.map(p => createProductCard(p, term)).join('');
                searchStatus.textContent = `Found ${data.count} product${data.count !== 1 ? 's' : ''}`;
                bindProductCards();
            }
        } catch (error) {
            searchStatus.textContent = 'Search failed';
        }
    }

    searchInput.addEventListener('input', () => debounce(performSearch, 250));
    searchClear.addEventListener('click', () => {
        searchInput.value = '';
        performSearch();
        searchInput.focus();
    });
    searchInput.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            searchInput.value = '';
            performSearch();
        }
    });

    // ===== ADD TO CART =====
    function bindProductCards() {
        document.querySelectorAll('.pos-product-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (this.classList.contains('out-of-stock')) return;
                addToCart(this);
            });
        });
    }

    async function addToCart(card) {
        const id = card.dataset.id;
        const name = card.dataset.name;
        const price = card.dataset.price;
        
        // Visual feedback
        card.style.opacity = '0.5';
        card.style.pointerEvents = 'none';
        
        try {
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('id', id);
            formData.append('name', name);
            formData.append('selling_price', price);
            
            const response = await fetch('/pos/cart/add', {
                method: 'POST',
                body: formData
            });
            
            if (response.ok) {
                // Reload to update cart
                window.location.reload();
            } else {
                // Restore card if failed
                card.style.opacity = '1';
                card.style.pointerEvents = 'auto';
                alert('Failed to add product to cart');
            }
        } catch (error) {
            console.error('Failed to add to cart', error);
            card.style.opacity = '1';
            card.style.pointerEvents = 'auto';
            alert('Failed to add product to cart');
        }
    }

    bindProductCards();

    // ===== MOBILE TAB SWITCHING =====
    function switchTab(tab) {
        if (tab === 'cart') {
            cartPanel.classList.add('show');
            cartTab.classList.add('active');
            productsTab.classList.remove('active');
            if (closeCartBtn) closeCartBtn.style.display = 'block';
        } else {
            cartPanel.classList.remove('show');
            productsTab.classList.add('active');
            cartTab.classList.remove('active');
            if (closeCartBtn) closeCartBtn.style.display = 'none';
        }
    }

    productsTab?.addEventListener('click', () => switchTab('products'));
    cartTab?.addEventListener('click', () => switchTab('cart'));
    floatingCart?.addEventListener('click', () => switchTab('cart'));
    closeCartBtn?.addEventListener('click', () => switchTab('products'));

    // ===== QUANTITY CONTROLS =====
    document.querySelectorAll('.qty-minus, .qty-plus').forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.stopPropagation();
            const rowId = this.dataset.rowid;
            const productId = this.dataset.productid;
            const stepper = this.closest('.pos-qty-stepper');
            const qtySpan = stepper.querySelector('.pos-qty-value');
            let qty = parseInt(qtySpan.textContent);
            
            if (this.classList.contains('qty-minus')) {
                qty = Math.max(1, qty - 1);
            } else {
                qty++;
            }
            
            // Disable buttons while updating
            stepper.style.opacity = '0.5';
            stepper.style.pointerEvents = 'none';
            
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('qty', qty);
            formData.append('product_id', productId);
            
            await fetch(`/pos/cart/update/${rowId}`, {
                method: 'POST',
                body: formData
            });
            
            window.location.reload();
        });
    });

    // ===== REMOVE FROM CART =====
    document.querySelectorAll('.pos-cart-item-remove').forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.stopPropagation();
            if (!confirm('Remove this item?')) return;
            
            const rowId = this.dataset.rowid;
            
            // Disable button while deleting
            this.style.opacity = '0.5';
            this.style.pointerEvents = 'none';
            
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('_method', 'DELETE');
            
            await fetch(`/pos/cart/delete/${rowId}`, {
                method: 'POST',
                body: formData
            });
            
            window.location.reload();
        });
    });
});
</script>
@endpushonce