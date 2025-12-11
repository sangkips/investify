@extends('layouts.tabler')

@push('page-styles')
<style>
    /* Variables matching landing page */
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --accent-hover: #ea580c;
        --danger: #dc2626;
        --danger-light: #fef2f2;
        --success: #22c55e;
        --success-light: #dcfce7;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
        --bg-gradient-start: #fef3e2;
        --bg-gradient-end: #e0e7ff;
    }

    .page-wrapper {
        background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
        min-height: 100vh;
    }

    .page-body {
        padding: 1.5rem 0;
    }

    /* Main Card */
    .due-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .due-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .due-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
    }

    .due-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .btn-close-page {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-close-page:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    /* Error Alert */
    .error-alert {
        background: var(--danger-light);
        border: 1px solid rgba(220, 38, 38, 0.2);
        border-radius: 12px;
        padding: 1rem;
        margin: 1rem 1.5rem 0;
        color: var(--danger);
    }

    .error-alert ul {
        margin: 0;
        padding-left: 1.25rem;
    }

    /* Order Info Grid */
    .order-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-item label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        margin-bottom: 6px;
    }

    .info-item .value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
        background: white;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    /* Products Section */
    .products-section {
        padding: 1.5rem;
    }

    .section-title {
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        margin-bottom: 1rem;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table thead {
        background: #f8fafc;
    }

    .products-table th {
        padding: 0.75rem 1rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
        text-align: center;
    }

    .products-table th:first-child {
        text-align: left;
    }

    .products-table td {
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        text-align: center;
    }

    .products-table td:first-child {
        text-align: left;
    }

    .products-table tbody tr:hover {
        background: #fafbfc;
    }

    .product-name {
        font-weight: 500;
    }

    .product-code {
        font-size: 0.8rem;
        color: var(--text-light);
    }

    /* Summary Section */
    .summary-section {
        background: #f8fafc;
        padding: 1.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .summary-grid {
        max-width: 400px;
        margin-left: auto;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-label {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .summary-value {
        font-weight: 600;
        color: var(--text-dark);
    }

    .summary-row.paid .summary-value {
        color: var(--success);
    }

    .summary-row.due .summary-value {
        color: var(--danger);
        font-size: 1.1rem;
    }

    .summary-row.total {
        padding-top: 1rem;
        margin-top: 0.5rem;
        border-top: 2px solid #e2e8f0;
    }

    .summary-row.total .summary-label,
    .summary-row.total .summary-value {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    /* Footer */
    .due-footer {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-back {
        background: white;
        color: var(--text-dark);
        border: 2px solid #e2e8f0;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: #f8fafc;
        color: var(--text-dark);
        border-color: #cbd5e1;
    }

    .btn-pay {
        background: var(--primary);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(30, 27, 75, 0.3);
    }

    .btn-pay:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(30, 27, 75, 0.4);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .page-body {
            padding: 0;
        }

        .container-xl {
            padding: 0;
        }

        .due-card {
            border-radius: 0;
        }

        .due-header {
            border-radius: 0;
        }

        .order-info-grid {
            grid-template-columns: 1fr 1fr;
        }

        .products-section {
            padding: 1rem;
            overflow-x: auto;
        }

        .summary-section {
            padding: 1rem;
        }

        .summary-grid {
            max-width: 100%;
        }

        .due-footer {
            flex-direction: column;
            padding: 1rem;
        }

        .btn-back,
        .btn-pay {
            width: 100%;
            justify-content: center;
        }

        .btn-pay {
            order: -1;
        }
    }
</style>
@endpush

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="due-card">
            <!-- Header -->
            <div class="due-header">
                <div class="due-header-content">
                    <h1>{{ __('Pay Due Amount') }}</h1>
                    <p>{{ __('Invoice') }}: {{ $order->invoice_no }}</p>
                </div>
                <a href="{{ route('due.index') }}" class="btn-close-page">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </a>
            </div>

            @if ($errors->any())
            <div class="error-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Order Info Grid -->
            <div class="order-info-grid">
                <div class="info-item">
                    <label>{{ __('Order Date') }}</label>
                    <div class="value">{{ $order->order_date->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <label>{{ __('Invoice No.') }}</label>
                    <div class="value">{{ $order->invoice_no }}</div>
                </div>
                <div class="info-item">
                    <label>{{ __('Customer') }}</label>
                    <div class="value">{{ $order->customer->name }}</div>
                </div>
                <div class="info-item">
                    <label>{{ __('Payment Type') }}</label>
                    <div class="value">{{ $order->payment_type }}</div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="products-section">
                <h3 class="section-title">{{ __('Order Items') }}</h3>
                <div class="table-responsive">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Qty') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $item)
                            <tr>
                                <td>
                                    <div class="product-name">{{ $item->product->name }}</div>
                                    <div class="product-code">{{ $item->product->code }}</div>
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ Number::currency($item->unitcost, 'KES') }}</td>
                                <td>{{ Number::currency($item->total, 'KES') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="summary-section">
                <div class="summary-grid">
                    <div class="summary-row">
                        <span class="summary-label">{{ __('VAT') }}</span>
                        <span class="summary-value">{{ Number::currency($order->vat, 'KES') }}</span>
                    </div>
                    <div class="summary-row paid">
                        <span class="summary-label">{{ __('Paid Amount') }}</span>
                        <span class="summary-value">{{ Number::currency($order->pay, 'KES') }}</span>
                    </div>
                    <div class="summary-row due">
                        <span class="summary-label">{{ __('Due Amount') }}</span>
                        <span class="summary-value">{{ Number::currency($order->due, 'KES') }}</span>
                    </div>
                    <div class="summary-row total">
                        <span class="summary-label">{{ __('Order Total') }}</span>
                        <span class="summary-value">{{ Number::currency($order->total, 'KES') }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="due-footer">
                <a href="{{ route('due.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    {{ __('Back to Due Orders') }}
                </a>
                <button type="button" class="btn-pay" data-bs-toggle="modal" data-bs-target="#modal-due">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    {{ __('Pay Due Amount') }}
                </button>
            </div>
        </div>
    </div>
</div>

@include('partials._modal_due', $order)
@endsection