@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$purchases)
            <div class="container-xl">
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="ti ti-shopping-cart-off" style="font-size: 4rem; color: #6c757d;"></i>
                    </div>
                    <h5 class="text-muted">{{ __('No purchases found') }}</h5>
                    <p class="text-muted">{{ __('Get started by adding your first purchase') }}</p>
                    @can('create-purchase')
                    <div class="d-flex flex-column gap-2 align-items-center">
                        <a href="{{ route('purchases.create') }}" class="btn btn-success">
                            <i class="ti ti-plus"></i> {{ __('Add your first Purchase') }}
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.purchase-mobile-table')
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
/* Mobile-specific optimizations */
@media (max-width: 768px) {
    .page-body {
        padding: 0;
    }
    
    .container-xl {
        padding: 0;
        max-width: 100%;
    }
}
</style>
@endpush