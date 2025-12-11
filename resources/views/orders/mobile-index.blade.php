@extends('layouts.tabler')

@section('content')
    <div class="page-body mobile-orders-page">
        @if (!$orders)
            <div class="container-xl">
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="ti ti-receipt-off" style="font-size: 4rem; color: #6c757d;"></i>
                    </div>
                    <h5 class="text-muted">{{ __('No orders found') }}</h5>
                    <p class="text-muted">{{ __('Get started by creating your first order') }}</p>
                    @can('manage-orders')
                    <div class="d-flex flex-column gap-2 align-items-center">
                        <a href="{{ route('orders.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> {{ __('Create your first Order') }}
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.order-mobile-table')
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
/* Mobile Orders Page - Landing Page Inspired */
.mobile-orders-page {
    background: linear-gradient(135deg, #fef3e2 0%, #e0e7ff 100%);
    min-height: 100vh;
    padding: 0 !important;
}

.mobile-orders-page .container-xl {
    padding: 0;
    max-width: 100%;
}

/* Override Tabler defaults for mobile */
@media (max-width: 768px) {
    .page-wrapper {
        background: linear-gradient(135deg, #fef3e2 0%, #e0e7ff 100%);
    }
    
    .page-body {
        padding: 0;
    }
}
</style>
@endpush
