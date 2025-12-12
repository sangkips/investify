@extends('layouts.tabler')

@push('page-styles')
<style>
    /* ============================================
       INVOICE PAGE - MODERN REDESIGN
       Matching app design system
    ============================================ */
    
    :root {
        --inv-primary: #1e1b4b;
        --inv-primary-light: #312e81;
        --inv-accent: #f97316;
        --inv-accent-hover: #ea580c;
        --inv-success: #22c55e;
        --inv-danger: #ef4444;
        --inv-bg-start: #fef3e2;
        --inv-bg-end: #e0e7ff;
        --inv-text: #1e293b;
        --inv-text-muted: #64748b;
        --inv-border: #e2e8f0;
        --inv-card-bg: #ffffff;
    }

    .page-body {
        background: linear-gradient(135deg, var(--inv-bg-start) 0%, var(--inv-bg-end) 100%);
        min-height: calc(100vh - 60px);
        padding: 1.5rem;
    }

    /* ===== Invoice Container ===== */
    .invoice-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* ===== Invoice Card ===== */
    .invoice-card {
        background: var(--inv-card-bg);
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 180px; /* Space for fixed payment section */
    }

    /* ===== Invoice Header ===== */
    .invoice-header {
        background: linear-gradient(135deg, var(--inv-primary) 0%, var(--inv-primary-light) 100%);
        padding: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .invoice-brand h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 0.5rem;
    }

    .invoice-brand p {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        font-size: 0.9rem;
    }

    .invoice-meta {
        text-align: right;
    }

    .invoice-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--inv-accent);
        margin-bottom: 0.5rem;
    }

    .invoice-date {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }

    /* ===== Info Section ===== */
    .invoice-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        padding: 2rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--inv-border);
    }

    .info-block h3 {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--inv-text-muted);
        margin-bottom: 0.75rem;
        font-weight: 600;
    }

    .info-block p {
        margin: 0.25rem 0;
        color: var(--inv-text);
        font-size: 0.95rem;
    }

    .info-block .name {
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--inv-primary);
    }

    /* ===== Items Table ===== */
    .invoice-items {
        padding: 2rem;
    }

    .items-table {
        width: 100%;
        border-collapse: collapse;
    }

    .items-table thead {
        background: var(--inv-primary);
    }

    .items-table th {
        padding: 1rem 1.25rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #fff;
        font-weight: 600;
        text-align: left;
    }

    .items-table th:last-child {
        text-align: right;
    }

    .items-table th:nth-child(2),
    .items-table th:nth-child(3) {
        text-align: center;
    }

    .items-table tbody tr {
        border-bottom: 1px solid var(--inv-border);
        transition: background 0.2s;
    }

    .items-table tbody tr:hover {
        background: #f8fafc;
    }

    .items-table td {
        padding: 1rem 1.25rem;
        font-size: 0.95rem;
        color: var(--inv-text);
    }

    .items-table td:last-child {
        text-align: right;
        font-weight: 600;
    }

    .items-table td:nth-child(2),
    .items-table td:nth-child(3) {
        text-align: center;
    }

    .item-name {
        font-weight: 500;
    }

    /* ===== Totals Section ===== */
    .invoice-totals {
        display: flex;
        justify-content: flex-end;
        padding: 0 2rem 2rem;
    }

    .totals-box {
        width: 320px;
        background: #f8fafc;
        border-radius: 16px;
        padding: 1.5rem;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 0.625rem 0;
        font-size: 0.95rem;
        color: var(--inv-text);
    }

    .total-row.divider {
        border-top: 2px solid var(--inv-border);
        margin-top: 0.5rem;
        padding-top: 1rem;
    }

    .total-row.grand {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--inv-primary);
    }

    .total-row .label {
        color: var(--inv-text-muted);
    }

    .total-row .value {
        font-weight: 600;
    }

    /* ===== Payment Section ===== */
    .invoice-payment {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        padding: 1rem 2rem;
        padding-bottom: calc(1rem + env(safe-area-inset-bottom, 0px));
        border-top: 2px solid var(--inv-border);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.15);
    }

    .invoice-payment .payment-inner {
        max-width: 1000px;
        margin: 0 auto;
    }

    .payment-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--inv-primary);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .payment-form {
        display: grid;
        grid-template-columns: auto 1.5fr 0.8fr 0.8fr auto;
        gap: 0.75rem;
        align-items: end;
    }

    .payment-actions-left {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .invoice-payment .form-group {
        display: flex;
        flex-direction: column;
    }

    .invoice-payment .form-group label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--inv-text-muted);
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .invoice-payment .form-group input,
    .invoice-payment .form-group select {
        padding: 0.75rem 1rem;
        border: 2px solid var(--inv-border);
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.2s;
        background: #fff;
        color: var(--inv-text);
        width: 100%;
        min-width: 0;
    }

    .invoice-payment .form-group select {
        -webkit-appearance: menulist;
        -moz-appearance: menulist;
        appearance: menulist;
        cursor: pointer;
    }

    .invoice-payment .form-group input:focus,
    .invoice-payment .form-group select:focus {
        outline: none;
        border-color: var(--inv-primary);
        box-shadow: 0 0 0 4px rgba(30, 27, 75, 0.1);
    }

    .invoice-payment .form-group input:disabled {
        background: #f8fafc;
        color: var(--inv-text-muted);
    }

    .invoice-payment .form-group input::placeholder {
        color: var(--inv-text-muted);
    }

    /* ===== Action Buttons ===== */
    .invoice-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 1.5rem;
        border: 2px solid var(--inv-border);
        background: #fff;
        color: var(--inv-text);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: var(--inv-text);
    }

    .btn-pay {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.875rem 1.25rem;
        background: var(--inv-primary);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 16px rgba(30, 27, 75, 0.3);
        white-space: nowrap;
    }

    .btn-pay:hover {
        background: var(--inv-primary-light);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30, 27, 75, 0.4);
    }

    .btn-pay:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .btn-print {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 1.5rem;
        border: 2px solid var(--inv-primary);
        background: transparent;
        color: var(--inv-primary);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-print:hover {
        background: var(--inv-primary);
        color: #fff;
    }

    /* ===== Empty State ===== */
    .empty-cart {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-cart-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-cart h2 {
        font-size: 1.5rem;
        color: var(--inv-text);
        margin-bottom: 0.5rem;
    }

    .empty-cart p {
        color: var(--inv-text-muted);
        margin-bottom: 1.5rem;
    }

    .btn-start {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 1.5rem;
        background: var(--inv-primary);
        color: #fff;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-start:hover {
        background: var(--inv-primary-light);
        color: #fff;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .page-body {
            padding: 0;
        }

        .invoice-card {
            border-radius: 0;
            margin-bottom: 220px; /* More space for mobile fixed footer */
        }

        .invoice-header {
            flex-direction: column;
            text-align: center;
        }

        .invoice-meta {
            text-align: center;
        }

        .invoice-info {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .invoice-items {
            padding: 1rem;
            overflow-x: auto;
        }

        .items-table {
            min-width: 500px;
        }

        .invoice-totals {
            padding: 0 1rem 1.5rem;
        }

        .totals-box {
            width: 100%;
        }

        .invoice-payment {
            padding: 1rem;
            padding-bottom: calc(1rem + env(safe-area-inset-bottom, 20px));
        }

        .payment-title {
            display: none; /* Hide title on mobile to save space */
        }

        .payment-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        /* Hide action buttons and customer field on mobile */
        .payment-actions-left {
            display: none;
        }
        
        /* Hide customer field on mobile (2nd element in the form) */
        .payment-form > .form-group:first-of-type {
            display: none;
        }

        .btn-pay {
            grid-column: 1 / -1;
            padding: 1rem 1.5rem;
            margin-bottom: 0.5rem;
        }
    }

    /* ===== Print Styles ===== */
    @media print {
        .page-wrapper, .navbar, .sidebar {
            margin: 0 !important;
            padding: 0 !important;
        }

        .sidebar, .navbar, .invoice-payment, .invoice-actions, .sidebar-toggle {
            display: none !important;
        }

        .page-body {
            background: #fff !important;
            padding: 0 !important;
        }

        .invoice-container {
            max-width: 100% !important;
        }

        .invoice-card {
            box-shadow: none !important;
            border-radius: 0 !important;
            border: 1px solid #e2e8f0;
        }

        /* Print-friendly header - light background with dark text */
        .invoice-header {
            background: #f8fafc !important;
            border-bottom: 2px solid #1e1b4b;
            padding: 1.5rem 2rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .invoice-brand h1 {
            color: #1e1b4b !important;
            font-size: 1.5rem;
        }

        .invoice-brand p {
            color: #64748b !important;
        }

        .invoice-number {
            color: #1e1b4b !important;
            font-size: 1.25rem;
        }

        .invoice-date {
            color: #1e293b !important;
        }

        /* Make table header print with background */
        .items-table thead {
            background: #1e1b4b !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .items-table th {
            color: #fff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Totals box styling for print */
        .totals-box {
            border: 1px solid #e2e8f0;
        }

        .total-row.grand {
            color: #1e1b4b !important;
        }
    }
</style>
@endpush

@section('content')
<div class="page-body">
    <div class="invoice-container">
        @php
            $user = auth()->user();
        @endphp

        @if($carts->isEmpty())
            <!-- Empty Cart State -->
            <div class="invoice-card">
                <div class="empty-cart">
                    <div class="empty-cart-icon">🛒</div>
                    <h2>{{ __('Your cart is empty') }}</h2>
                    <p>{{ __('Add some products to create an invoice') }}</p>
                    <a href="{{ route('orders.create') }}" class="btn-start">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        {{ __('Start New Order') }}
                    </a>
                </div>
            </div>
        @else
            <!-- Invoice Card -->
            <div class="invoice-card" id="invoiceCard">
                <!-- Header -->
                <div class="invoice-header">
                    <div class="invoice-brand">
                        <h1>{{ $user->store_name ?? config('app.name') }}</h1>
                        @if($user->store_address)
                            <p>{{ $user->store_address }}</p>
                        @endif
                        @if($user->store_phone)
                            <p>{{ $user->store_phone }}</p>
                        @endif
                    </div>
                    <div class="invoice-meta">
                        <div class="invoice-number">INVOICE</div>
                        <div class="invoice-date">{{ Carbon\Carbon::now()->format('M d, Y') }}</div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="invoice-info">
                    <div class="info-block">
                        <h3>{{ __('Bill To') }}</h3>
                        @if(isset($customer))
                            <p class="name">{{ $customer->name }}</p>
                            @if($customer->phone)<p>{{ $customer->phone }}</p>@endif
                            @if($customer->email)<p>{{ $customer->email }}</p>@endif
                            @if($customer->address)<p>{{ $customer->address }}</p>@endif
                        @else
                            <p class="name">{{ __('Walk-in Customer') }}</p>
                        @endif
                    </div>
                    <div class="info-block" style="text-align: right;">
                        <h3>{{ __('From') }}</h3>
                        <p class="name">{{ $user->store_name ?? config('app.name') }}</p>
                        @if($user->store_phone)<p>{{ $user->store_phone }}</p>@endif
                        @if($user->store_email)<p>{{ $user->store_email }}</p>@endif
                    </div>
                </div>

                <!-- Items Table -->
                <div class="invoice-items">
                    <table class="items-table">
                        <thead>
                            <tr>
                                <th>{{ __('Item') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Qty') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $item)
                            <tr>
                                <td><span class="item-name">{{ $item->name }}</span></td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="invoice-totals">
                    <div class="totals-box">
                        <div class="total-row">
                            <span class="label">{{ __('Subtotal') }}</span>
                            <span class="value">{{ Cart::subtotal() }}</span>
                        </div>
                        <div class="total-row">
                            <span class="label">{{ __('Tax (16%)') }}</span>
                            <span class="value">{{ Cart::tax() }}</span>
                        </div>
                        <div class="total-row divider grand">
                            <span>{{ __('Total') }}</span>
                            <span>{{ Cart::total() }}</span>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Fixed Payment Section (outside invoice-card for proper fixed positioning) -->
        <div class="invoice-payment">
            <div class="payment-inner">
                <h3 class="payment-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    {{ __('Complete Payment') }} — <strong>Total: {{ Cart::total() }}</strong>
                </h3>

                <form action="{{ route('orders.store') }}" method="POST" id="paymentForm">
                    @csrf
                    @if(isset($customer))
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                    @endif

                    <div class="payment-form">
                        <div class="payment-actions-left">
                            <a href="{{ route('orders.create') }}" class="btn-back" title="{{ __('Back') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                <span>{{ __('Back') }}</span>
                            </a>
                            <button type="button" class="btn-print" onclick="window.print()" title="{{ __('Print') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                    <rect x="6" y="14" width="12" height="8"></rect>
                                </svg>
                                <span>{{ __('Print') }}</span>
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="customer_display">{{ __('Customer') }}</label>
                            <input type="text" id="customer_display" value="{{ isset($customer) ? $customer->name : 'Walk-in Customer' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="payment_type">{{ __('Payment') }}</label>
                            <select name="payment_type" id="payment_type" required>
                                <option value="Cash">{{ __('Cash') }}</option>
                                <option value="Mpesa">{{ __('M-Pesa') }}</option>
                                <option value="Cheque">{{ __('Cheque') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pay">{{ __('Amount') }}</label>
                            <input type="number" 
                                   name="pay" 
                                   id="pay" 
                                   step="0.01" 
                                   min="0" 
                                   placeholder="0.00"
                                   value="{{ str_replace(',', '', Cart::total()) }}"
                                   required>
                        </div>
                        <button type="submit" class="btn-pay">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            {{ __('Complete Payment') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const payInput = document.getElementById('pay');
    
    // Pre-fill with total amount for convenience
    if (payInput && !payInput.value) {
        const total = '{{ str_replace(",", "", Cart::total()) }}';
        payInput.value = total;
    }
});
</script>
@endpush
