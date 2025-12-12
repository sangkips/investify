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

    .purchase-page {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
        padding: 1.5rem;
    }

    /* Card Styling */
    .purchase-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .purchase-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .purchase-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .purchase-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
        backdrop-filter: blur(10px);
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        transform: translateY(-2px);
    }

    /* Form Section */
    .purchase-form-section {
        padding: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 0.8rem;
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
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        color: var(--text-dark);
        transition: all 0.2s;
        background: #f8fafc;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background: white;
    }

    /* Products Section */
    .products-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .products-section-header h3 {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    /* Footer */
    .purchase-footer {
        padding: 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
    }

    .btn-submit {
        background: var(--accent);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
        cursor: pointer;
    }

    .btn-submit:hover {
        background: var(--accent-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .purchase-page {
            padding: 0;
        }

        .purchase-card {
            border-radius: 0;
        }

        .purchase-header {
            flex-direction: column;
            text-align: center;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .purchase-footer {
            justify-content: center;
        }

        .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="purchase-page">
    <x-alert />
    
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <div class="purchase-card">
            <!-- Header -->
            <div class="purchase-header">
                <div class="purchase-header-content">
                    <h1>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                        {{ __('Create Purchase') }}
                    </h1>
                    <p>{{ __('Add a new purchase order to your inventory') }}</p>
                </div>
                <a href="{{ route('purchases.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    {{ __('Back to List') }}
                </a>
            </div>

            <!-- Form Section -->
            <div class="purchase-form-section">
                <div class="form-row">
                    <div class="form-group">
                        <label for="date" class="required">{{ __('Purchase Date') }}</label>
                        <input name="date" id="date" type="date" 
                               class="@error('date') is-invalid @enderror" 
                               value="{{ old('date') ?? now()->format('Y-m-d') }}" required>
                        @error('date')
                        <div class="invalid-feedback" style="display: block; color: #ef4444; font-size: 0.8rem; margin-top: 4px;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="supplier_id" class="required">{{ __('Supplier') }}</label>
                        <select name="supplier_id" id="supplier_id" class="@error('supplier_id') is-invalid @enderror" required>
                            <option value="">{{ __('Select Supplier') }}</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                        <div class="invalid-feedback" style="display: block; color: #ef4444; font-size: 0.8rem; margin-top: 4px;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reference" class="required">{{ __('Reference') }}</label>
                        <input type="text" id="reference" name="reference" value="PRS" readonly 
                               style="background: #e2e8f0; cursor: not-allowed;">
                        @error('reference')
                        <div class="invalid-feedback" style="display: block; color: #ef4444; font-size: 0.8rem; margin-top: 4px;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Products Section Header -->
            <div class="products-section-header">
                <h3>{{ __('Products') }}</h3>
            </div>

            <!-- Products Table (Livewire) -->
            @livewire('purchase-form')

            <!-- Footer -->
            <div class="purchase-footer">
                <button type="submit" class="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    {{ __('Create Purchase') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection