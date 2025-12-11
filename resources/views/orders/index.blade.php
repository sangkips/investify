@extends('layouts.tabler')

@push('page-styles')
<style>
    /* Orders Page Styles - Matching landing page gradient */
    :root {
        --orders-primary: #1e1b4b;
        --orders-primary-light: #312e81;
        --orders-accent: #f97316;
        --orders-bg-gradient-start: #fef3e2;
        --orders-bg-gradient-end: #e0e7ff;
    }

    .page-wrapper {
        background: linear-gradient(135deg, var(--orders-bg-gradient-start) 0%, var(--orders-bg-gradient-end) 100%);
        min-height: 100vh;
    }

    .page-body {
        padding: 1.5rem 0;
    }

    /* Refined Card Styling */
    .card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        background: transparent;
        padding: 1.25rem 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--orders-primary);
        margin: 0;
    }

    .card-body {
        padding: 1.25rem 1.5rem;
    }

    .card-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        background: transparent;
        padding: 1rem 1.5rem;
    }

    /* Button Styling */
    .btn-success {
        background: var(--orders-primary);
        border-color: var(--orders-primary);
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-success:hover {
        background: var(--orders-primary-light);
        border-color: var(--orders-primary-light);
        transform: translateY(-1px);
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        padding: 0.875rem 1rem;
    }

    .table tbody td {
        padding: 0.875rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: #f8fafc;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Form Controls */
    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 0.75rem;
    }

    .form-select:focus, .form-control:focus {
        border-color: var(--orders-primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    /* Pagination */
    .pagination {
        gap: 0.25rem;
    }

    .page-link {
        border-radius: 8px;
        border: none;
        color: #64748b;
        padding: 0.5rem 0.75rem;
    }

    .page-link:hover {
        background: #f1f5f9;
        color: var(--orders-primary);
    }

    .page-item.active .page-link {
        background: var(--orders-primary);
        color: white;
    }

    /* Action Buttons */
    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .btn-icon:hover {
        transform: scale(1.05);
    }

    /* Status Badges */
    .status {
        border-radius: 50px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* Alert Styling */
    .alert {
        border-radius: 12px;
        border: none;
    }
</style>
@endpush

@section('content')
<div class="page-body">
    @if (!$orders)
    <x-empty title="No orders found" message="Try adjusting your search or filter to find what you're looking for." button_label="{{ __('Add your first Order') }}" button_route="{{ route('orders.create') }}" />
    @else
    <div class="container-xl">
        {{-- <x-card> --}}
        {{-- <x-slot:header> --}}
        {{-- <x-slot:title> --}}
        {{-- {{ __('Orders') }} --}}
        {{-- </x-slot:title> --}}

        {{-- <x-slot:actions> --}}
        {{-- <x-action.create route="{{ route('orders.create') }}" /> --}}
        {{-- </x-slot:actions> --}}
        {{-- </x-slot:header> --}}

        {{-- -
            <x-table.index>
                <x-slot:th>
                    <x-table.th>{{ __('No.') }}</x-table.th>
        <x-table.th>{{ __('Invoice No.') }}</x-table.th>
        <x-table.th>{{ __('Customer') }}</x-table.th>
        <x-table.th>{{ __('Date') }}</x-table.th>
        <x-table.th>{{ __('Payment') }}</x-table.th>
        <x-table.th>{{ __('Total') }}</x-table.th>
        <x-table.th>{{ __('Status') }}</x-table.th>
        <x-table.th>{{ __('Actions') }}</x-table.th>
        </x-slot:th>
        <x-slot:tbody>
            @foreach ($orders as $order)
            <tr>
                <x-table.td>{{ $loop->iteration }}</x-table.td>
                <x-table.td>{{ $order->invoice_no }}</x-table.td>
                <x-table.td>{{ $order->customer->name }}</x-table.td>
                <x-table.td>{{ $order->order_date->format('d-m-Y') }}</x-table.td>
                <x-table.td>{{ $order->payment_type }}</x-table.td>
                <x-table.td>{{ Number::currency($order->total, 'KES') }}</x-table.td>
                <x-table.td>
                    <x-badge class="{{ $order->order_status === 'complete' ? 'bg-green' : 'bg-orange' }}">
                        {{ $order->order_status }}
                    </x-badge>
                </x-table.td>
                <x-table.td>
                    <x-button.show class="btn-icon" route="{{ route('orders.show', $order->uuid) }}" />
                    <x-button.print class="btn-icon" route="{{ route('orders.downloadInvoice', $order) }}" />
                </x-table.td>
            </tr>
            @endforeach
        </x-slot:tbody>
        </x-table.index>
        - --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <h3 class="mb-1">Success</h3>
            <p>{{ session('success') }}</p>

            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif
        <livewire:tables.order-table />
    </div>
    @endif
</div>
@endsection