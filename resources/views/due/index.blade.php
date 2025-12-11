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

    /* Card Styling */
    .orders-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .orders-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .orders-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .orders-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .status-badge-header {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--danger);
        color: white;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
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

    /* Table Styling */
    .table-container {
        padding: 0;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
    }

    .orders-table thead {
        background: #f8fafc;
    }

    .orders-table th {
        padding: 1rem 1.25rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
    }

    .orders-table th:first-child {
        text-align: left;
    }

    .orders-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .orders-table tbody tr:hover {
        background: #fafbfc;
    }

    .orders-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Invoice Link */
    .invoice-link {
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s;
    }

    .invoice-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
    }

    /* Customer Name */
    .customer-name {
        font-weight: 500;
    }

    /* Amount Badges */
    .paid-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #dcfce7;
        color: var(--success);
    }

    .due-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--danger-light);
        color: var(--danger);
    }

    /* Pay Due Button */
    .btn-pay-due {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-pay-due:hover {
        background: var(--primary-light);
        color: white;
        transform: translateY(-1px);
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
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon svg {
        width: 40px;
        height: 40px;
        color: var(--success);
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
        margin: 0 0 1.5rem;
    }

    .empty-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: white;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .empty-action-btn:hover {
        background: var(--primary-light);
        color: white;
        transform: translateY(-2px);
    }

    /* Footer */
    .orders-footer {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }

    .orders-footer .text-secondary {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .page-body {
            padding: 0;
        }

        .container-xl {
            padding: 0;
        }

        .orders-card {
            border-radius: 0;
        }

        .orders-header {
            border-radius: 0;
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .orders-header-content h1 {
            justify-content: center;
        }

        .btn-create {
            justify-content: center;
        }

        .orders-table th,
        .orders-table td {
            padding: 0.75rem 1rem;
        }

        .orders-footer {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="orders-card">
            <!-- Header -->
            <div class="orders-header">
                <div class="orders-header-content">
                    <h1>
                        {{ __('Due Orders') }}
                        <span class="status-badge-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            Due
                        </span>
                    </h1>
                    <p>{{ $orders->count() }} {{ __('orders with outstanding balance') }}</p>
                </div>
                @can('manage-orders')
                <a href="{{ route('orders.create') }}" class="btn-create">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    {{ __('Create New Order') }}
                </a>
                @endcan
            </div>

            @if($orders->isEmpty())
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M9 9l.01 0"></path>
                        <path d="M15 9l.01 0"></path>
                        <path d="M8 13a4 4 0 1 0 8 0h-8"></path>
                    </svg>
                </div>
                <h3>{{ __('No due orders!') }}</h3>
                <p>{{ __('All orders have been fully paid. Great job!') }}</p>
                @can('manage-orders')
                <a href="{{ route('orders.create') }}" class="empty-action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    {{ __('Create Order') }}
                </a>
                @endcan
            </div>
            @else
            <!-- Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>{{ __('Invoice No.') }}</th>
                                <th class="text-center">{{ __('Customer') }}</th>
                                <th class="text-center">{{ __('Date') }}</th>
                                <th class="text-center">{{ __('Payment') }}</th>
                                <th class="text-center">{{ __('Paid') }}</th>
                                <th class="text-center">{{ __('Due') }}</th>
                                <th class="text-center">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('orders.show', $order->uuid) }}" class="invoice-link">
                                        {{ $order->invoice_no }}
                                    </a>
                                </td>
                                <td class="text-center customer-name">{{ $order->customer->name }}</td>
                                <td class="text-center">{{ $order->order_date->format('d M Y') }}</td>
                                <td class="text-center">{{ $order->payment_type }}</td>
                                <td class="text-center">
                                    <span class="paid-badge">{{ Number::currency($order->pay, 'KES') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="due-badge">{{ Number::currency($order->due, 'KES') }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('due.edit', $order) }}" class="btn-pay-due">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                        {{ __('Pay Due') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="orders-footer">
                <p class="m-0 text-secondary">
                    {{ __('Showing') }} <strong>{{ $orders->count() }}</strong> {{ __('orders with due balance') }}
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
