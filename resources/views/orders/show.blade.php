@extends('layouts.tabler')

@push('page-styles')
<style>
    /* Order View Page Styles - Matching landing page gradient */
    :root {
        --order-primary: #1e1b4b;
        --order-primary-light: #312e81;
        --order-accent: #f97316;
        --order-accent-hover: #ea580c;
        --order-success: #22c55e;
        --order-success-light: #dcfce7;
        --order-warning: #f59e0b;
        --order-warning-light: #fef3c7;
        --order-text-dark: #1e1b4b;
        --order-text-light: #64748b;
        --order-bg-gradient-start: #fef3e2;
        --order-bg-gradient-end: #e0e7ff;
    }

    .page-wrapper {
        background: linear-gradient(135deg, var(--order-bg-gradient-start) 0%, var(--order-bg-gradient-end) 100%);
        min-height: 100vh;
    }

    .page-body {
        padding: 1.5rem 0;
        height: calc(100vh - 60px); /* Account for header */
        overflow: hidden;
    }

    .container-xl {
        height: 100%;
    }

    /* Card Styling */
    .order-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        max-height: calc(100vh - 90px);
    }

    .order-header {
        background: linear-gradient(135deg, var(--order-primary) 0%, var(--order-primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
    }

    .order-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .order-actions {
        display: flex;
        gap: 8px;
    }

    .btn-action-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-action-icon:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        transform: scale(1.05);
    }

    /* Order Info Grid */
    .order-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .info-item {
        text-align: center;
    }

    .info-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--order-text-light);
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--order-text-dark);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-complete {
        background: var(--order-success-light);
        color: var(--order-success);
    }

    .status-pending {
        background: var(--order-warning-light);
        color: var(--order-warning);
    }

    /* Products Section */
    .products-section {
        padding: 1.5rem;
        flex: 1;
        overflow-y: auto;
        min-height: 0; /* Important for flex children to scroll */
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--order-text-dark);
        margin-bottom: 1rem;
    }

    /* Product Items */
    .product-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .product-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 14px;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.2s;
    }

    .product-item:hover {
        background: #f1f5f9;
    }

    .product-details {
        flex: 1;
        min-width: 0;
    }

    .product-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--order-text-dark);
        margin: 0 0 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-code {
        font-size: 0.75rem;
        color: var(--order-text-light);
    }

    .product-qty {
        text-align: center;
        padding: 0 12px;
    }

    .product-qty-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--order-text-dark);
    }

    .product-qty-label {
        font-size: 0.65rem;
        color: var(--order-text-light);
        text-transform: uppercase;
    }

    .product-price {
        text-align: right;
        min-width: 80px;
    }

    .product-price-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--order-text-dark);
    }

    .product-price-unit {
        font-size: 0.7rem;
        color: var(--order-text-light);
    }

    /* Order Summary */
    .order-summary {
        background: #f8fafc;
        padding: 1.25rem 1.5rem;
        border-radius: 14px;
        margin: 0 1.5rem 1rem;
        flex-shrink: 0;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 0.9rem;
    }

    .summary-row.total {
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        margin-top: 8px;
        padding-top: 16px;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--order-text-dark);
    }

    .summary-label {
        color: var(--order-text-light);
    }

    .summary-value {
        font-weight: 600;
        color: var(--order-text-dark);
    }

    /* Footer Actions */
    .order-footer {
        padding: 1rem 1.5rem;
        display: flex;
        gap: 12px;
        background: white;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
        flex-shrink: 0;
    }

    .btn-complete {
        flex: 1;
        background: var(--order-success);
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .btn-complete:hover {
        background: #16a34a;
        transform: translateY(-1px);
    }

    .btn-back {
        background: var(--order-primary);
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: var(--order-primary-light);
        color: white;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .page-body {
            padding: 0;
            height: 100vh;
        }

        .container-xl {
            padding: 0;
            height: 100%;
        }

        .order-card {
            border-radius: 0;
            height: 100%;
            max-height: 100vh;
        }

        .order-header {
            border-radius: 0 0 20px 20px;
        }

        .order-info-grid {
            grid-template-columns: repeat(2, 1fr);
            padding: 1rem;
        }

        .info-item {
            padding: 8px 0;
        }

        .products-section {
            padding: 1rem;
        }

        .product-item {
            padding: 10px 12px;
        }

        .product-image {
            width: 44px;
            height: 44px;
        }

        .order-summary {
            margin: 0 1rem 0.5rem;
            padding: 1rem;
        }

        .order-footer {
            flex-direction: column;
            padding: 1rem;
            border-radius: 20px 20px 0 0;
        }

        .order-footer form {
            width: 100%;
        }

        .order-footer .btn-complete,
        .order-footer .btn-back {
            width: 100%;
        }

        .btn-back {
            order: 2;
        }
    }
</style>
@endpush

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="order-card">
            <!-- Header -->
            <div class="order-header">
                <div class="order-header-content">
                    <h1>{{ __('Order Details') }}</h1>
                    <p>{{ $order->invoice_no }}</p>
                </div>
                <div class="order-actions">
                    <a href="{{ route('orders.downloadInvoice', $order->uuid) }}" class="btn-action-icon" title="Print Invoice">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    </a>
                    <a href="{{ route('orders.index') }}" class="btn-action-icon" title="Back">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </a>
                </div>
            </div>

            <!-- Order Info Grid -->
            <div class="order-info-grid">
                <div class="info-item">
                    <div class="info-label">{{ __('Order Date') }}</div>
                    <div class="info-value">{{ $order->order_date->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">{{ __('Customer') }}</div>
                    <div class="info-value">{{ $order->customer->name }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">{{ __('Payment') }}</div>
                    <div class="info-value">{{ $order->payment_type }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">{{ __('Status') }}</div>
                    <div class="info-value">
                        <span class="status-badge {{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'status-complete' : 'status-pending' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="8"/></svg>
                            {{ $order->order_status->label() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="products-section">
                <h3 class="section-title">{{ __('Order Items') }} ({{ $order->details->count() }})</h3>
                <div class="product-list">
                    @foreach ($order->details as $item)
                    <div class="product-item">
                        <div class="product-details">
                            <h4 class="product-name">{{ $item->product->name }}</h4>
                            <span class="product-code">{{ $item->product->code }}</span>
                        </div>
                        <div class="product-qty">
                            <div class="product-qty-value">{{ $item->quantity }}</div>
                            <div class="product-qty-label">QTY</div>
                        </div>
                        <div class="product-price">
                            <div class="product-price-value">{{ Number::currency($item->total, 'KES') }}</div>
                            <div class="product-price-unit">@ {{ Number::currency($item->unitcost, 'KES') }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <div class="summary-row">
                    <span class="summary-label">{{ __('Subtotal') }}</span>
                    <span class="summary-value">{{ Number::currency($order->sub_total, 'KES') }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">{{ __('VAT') }}</span>
                    <span class="summary-value">{{ Number::currency($order->vat, 'KES') }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">{{ __('Paid') }}</span>
                    <span class="summary-value">{{ Number::currency($order->pay, 'KES') }}</span>
                </div>
                @if($order->due > 0)
                <div class="summary-row">
                    <span class="summary-label">{{ __('Due') }}</span>
                    <span class="summary-value" style="color: #ef4444;">{{ Number::currency($order->due, 'KES') }}</span>
                </div>
                @endif
                <div class="summary-row total">
                    <span class="summary-label">{{ __('Total') }}</span>
                    <span class="summary-value">{{ Number::currency($order->total, 'KES') }}</span>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="order-footer">
                @if ($order->order_status === \App\Enums\OrderStatus::PENDING)
                <form action="{{ route('orders.update', $order->uuid) }}" method="POST" style="flex: 1;">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn-complete" onclick="return confirm('Are you sure you want to complete this order?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10"/></svg>
                        {{ __('Complete Order') }}
                    </button>
                </form>
                @endif
                <a href="{{ route('orders.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection