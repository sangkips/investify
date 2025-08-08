@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$products)
            <div class="container-xl">
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="ti ti-package-off" style="font-size: 4rem; color: #6c757d;"></i>
                    </div>
                    <h5 class="text-muted">{{ __('No products found') }}</h5>
                    <p class="text-muted">{{ __('Get started by adding your first product') }}</p>
                    @can('create-product')
                    <div class="d-flex flex-column gap-2 align-items-center">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> {{ __('Add your first Product') }}
                        </a>
                        <a href="{{ route('products.import.view') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-upload"></i> {{ __('Import Products') }}
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.product-mobile-table')
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