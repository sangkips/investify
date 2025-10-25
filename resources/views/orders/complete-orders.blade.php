@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($orders->isEmpty())
    <div class="empty">
        <div class="empty-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <circle cx="12" cy="12" r="9" />
                <line x1="9" y1="10" x2="9.01" y2="10" />
                <line x1="15" y1="10" x2="15.01" y2="10" />
                <path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" />
            </svg>
        </div>
        <p class="empty-title">
            No orders found
        </p>
        <p class="empty-subtitle text-secondary">
            Try adjusting your search or filter to find what you're looking for.
        </p>
        <div class="empty-action">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 5l0 14"></path>
                    <path d="M5 12l14 0"></path>
                </svg>
                Add your first Order
            </a>
        </div>
    </div>
    @else
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Orders: ') }}
                        <x-status dot color="green" class="text-uppercase">
                            {{ __('Complete') }}
                        </x-status>
                    </h3>
                </div>

                <div class="card-actions">
                    <a href="{{ route('orders.create') }}" class="btn btn-success add-list mx-1 rounded">
                        Create new order
                    </a>
                </div>
            </div>
            
            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-secondary">
                        Show
                        <div class="mx-2 d-inline-block">
                            <form method="GET" action="{{ route('orders.complete') }}" class="d-inline-block">
                                <select name="per_page" onchange="this.form.submit()" class="form-select form-select-sm" aria-label="result per page">
                                    @foreach($allowedPerPage as $perPageOption)
                                        <option value="{{ $perPageOption }}" {{ $perPage == $perPageOption ? 'selected' : '' }}>
                                            {{ $perPageOption }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        entries
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center">{{ __('No.') }}</th>
                            <th scope="col" class="text-center">{{ __('Invoice No.') }}</th>
                            <th scope="col" class="text-center">{{ __('Customers') }}</th>
                            <th scope="col" class="text-center">{{ __('Date') }}</th>
                            <th scope="col" class="text-center">{{ __('Payment') }}</th>
                            <th scope="col" class="text-center">{{ __('Total') }}</th>
                            <th scope="col" class="text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $orders->firstItem() - 1 }}</td>
                            <td class="text-center">{{ $order->invoice_no }}</td>
                            <td class="text-center">{{ $order->customer->name }}</td>
                            <td class="text-center">{{ $order->order_date->format('d-m-Y') }}</td>
                            <td class="text-center">{{ $order->payment_type }}</td>
                            <td class="text-center">{{ Number::currency($order->total, 'KES') }}</td>
                            <td class="text-center">
                                <a href="{{ route('orders.show', $order->uuid) }}" class="btn btn-icon btn-outline-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                </a>
                                <a href="{{ route('orders.downloadInvoice', $order->uuid) }}" class="btn btn-icon btn-outline-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="7">No completed orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">
                    Showing <span>{{ $orders->firstItem() ?? 0 }}</span> to <span>{{ $orders->lastItem() ?? 0 }}</span> of
                    <span>{{ $orders->total() }}</span> entries
                </p>
                <ul class="pagination m-0 ms-auto">
                    {{ $orders->links() }}
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection