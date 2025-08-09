@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl p-0">
        <x-alert />
        
        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf
            
            <!-- Mobile Header -->
            <div class="mobile-header bg-white shadow-sm sticky-top">
                <div class="d-flex align-items-center justify-content-between p-3">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="ti ti-arrow-left"></i>
                        </a>
                        <h5 class="mb-0 fw-bold">{{ __('Create Purchase') }}</h5>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-3">
                <!-- Basic Information Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="card-title mb-0">{{ __('Purchase Information') }}</h6>
                    </div>
                    <div class="card-body">
                        <!-- Purchase Date -->
                        <div class="mb-3">
                            <label for="date" class="form-label required">
                                {{ __('Purchase Date') }}
                            </label>
                            <input name="date" id="date" type="date" 
                                   class="form-control @error('date') is-invalid @enderror" 
                                   value="{{ old('date') ?? now()->format('Y-m-d') }}" required>
                            @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Supplier -->
                        <div class="mb-3">
                            <label for="supplier_id" class="form-label required">
                                {{ __('Supplier') }}
                            </label>
                            <select name="supplier_id" id="supplier_id" 
                                    class="form-select @error('supplier_id') is-invalid @enderror" required>
                                <option value="">{{ __('Select Supplier') }}</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Reference -->
                        <div class="mb-0">
                            <label for="reference" class="form-label">
                                {{ __('Reference') }}
                            </label>
                            <input type="text" class="form-control" id="reference" 
                                   name="reference" value="PRS" readonly>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                @livewire('purchase-mobile-form')
            </div>
        </form>
    </div>
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
        max-width: 100%;
    }
    
    .mobile-header {
        border-bottom: 1px solid #dee2e6;
    }
    
    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }
}
</style>
@endpush