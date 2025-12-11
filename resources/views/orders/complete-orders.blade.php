@extends('layouts.tabler')

@push('page-styles')
<style>
    /* Variables matching landing page */
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --accent-hover: #ea580c;
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
        background: var(--success);
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

    /* Filter Bar */
    .filter-bar {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .filter-bar .text-secondary {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .filter-bar select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 6px 12px;
        font-size: 0.875rem;
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

    /* Amount */
    .order-amount {
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
        background: var(--success-light);
        color: var(--success);
    }

    /* Footer */
    .orders-footer {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .orders-footer .text-secondary {
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

        .filter-bar {
            padding: 1rem;
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
                        {{ __('Completed Orders') }}
                        <span class="status-badge-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Complete
                        </span>
                    </h1>
                    <p>{{ $orders->total() }} {{ __('orders completed') }}</p>
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
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="16 12 12 8 8 12"></polyline>
                        <line x1="12" y1="16" x2="12" y2="8"></line>
                    </svg>
                </div>
                <h3>{{ __('No completed orders yet') }}</h3>
                <p>{{ __('Completed orders will appear here once you mark them as complete.') }}</p>
                @can('manage-orders')
                <a href="{{ route('orders.create') }}" class="empty-action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    {{ __('Create Order') }}
                </a>
                @endcan
            </div>
            @else
            <!-- Filter Bar -->
            <div class="filter-bar">
                <span class="text-secondary">{{ __('Show') }}</span>
                <form method="GET" action="{{ route('orders.complete') }}" class="d-inline-block">
                    <select name="per_page" onchange="this.form.submit()" class="form-select form-select-sm" aria-label="result per page">
                        @foreach($allowedPerPage as $perPageOption)
                            <option value="{{ $perPageOption }}" {{ $perPage == $perPageOption ? 'selected' : '' }}>
                                {{ $perPageOption }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <span class="text-secondary">{{ __('entries') }}</span>
            </div>

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
                                <th class="text-center">{{ __('Total') }}</th>
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
                                <td class="text-center order-amount">{{ Number::currency($order->total, 'KES') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="orders-footer">
                <p class="m-0 text-secondary">
                    {{ __('Showing') }} <strong>{{ $orders->firstItem() ?? 0 }}</strong> {{ __('to') }} <strong>{{ $orders->lastItem() ?? 0 }}</strong> {{ __('of') }}
                    <strong>{{ $orders->total() }}</strong> {{ __('entries') }}
                </p>
                <ul class="pagination m-0">
                    {{ $orders->links() }}
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection