@extends('layouts.tabler')

@section('content')
<style>
    /* Variables matching landing page */
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --accent-hover: #ea580c;
        --success: #22c55e;
        --success-light: #dcfce7;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
        --bg-gradient-start: #fef3e2;
        --bg-gradient-end: #e0e7ff;
    }

    .mobile-purchase-page {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
    }

    /* Header */
    .mobile-purchase-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }

    .header-title h1 {
        font-size: 1.125rem;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .btn-save {
        background: var(--accent);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-save:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
    }

    /* Form Content */
    .form-content {
        padding: 1rem;
    }

    /* Info Card */
    .info-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
        margin-bottom: 1rem;
    }

    .info-card-header {
        background: #f8fafc;
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-card-header h2 {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-card-body {
        padding: 1rem;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        margin-bottom: 8px;
    }

    .form-group label.required::after {
        content: ' *';
        color: #ef4444;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        color: var(--text-dark);
        background: #f8fafc;
        transition: all 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background: white;
    }

    .form-group input[readonly] {
        background: #e2e8f0;
        cursor: not-allowed;
    }

    .error-text {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 4px;
    }
</style>

<div class="mobile-purchase-page">
    <x-alert />
    
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        
        <!-- Header -->
        <div class="mobile-purchase-header">
            <div class="header-left">
                <a href="{{ route('purchases.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </a>
                <div class="header-title">
                    <h1>{{ __('Create Purchase') }}</h1>
                </div>
            </div>
            <button type="submit" class="btn-save">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                {{ __('Save') }}
            </button>
        </div>

        <!-- Form Content -->
        <div class="form-content">
            <!-- Purchase Information Card -->
            <div class="info-card">
                <div class="info-card-header">
                    <h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                        {{ __('Purchase Information') }}
                    </h2>
                </div>
                <div class="info-card-body">
                    <!-- Purchase Date -->
                    <div class="form-group">
                        <label for="date" class="required">{{ __('Purchase Date') }}</label>
                        <input name="date" id="date" type="date" 
                               class="@error('date') is-invalid @enderror" 
                               value="{{ old('date') ?? now()->format('Y-m-d') }}" required>
                        @error('date')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Supplier -->
                    <div class="form-group">
                        <label for="supplier_id" class="required">{{ __('Supplier') }}</label>
                        <select name="supplier_id" id="supplier_id" 
                                class="@error('supplier_id') is-invalid @enderror" required>
                            <option value="">{{ __('Select Supplier') }}</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Reference -->
                    <div class="form-group">
                        <label for="reference">{{ __('Reference') }}</label>
                        <input type="text" id="reference" name="reference" value="PRS" readonly>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            @livewire('purchase-mobile-form')
        </div>
    </form>
</div>
@endsection