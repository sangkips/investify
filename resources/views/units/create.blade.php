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
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
    }

    /* Page Background */
    .unit-create-page {
        min-height: 100vh;
        padding-bottom: 2rem;
    }

    /* Header Card */
    .unit-header-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        border-radius: 20px;
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .unit-header-card h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .unit-header-card p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin: 4px 0 0;
    }

    /* Modern Card */
    .modern-card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        max-width: 600px;
        margin: 0 auto;
    }

    .modern-card-header {
        background: #f8fafc;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modern-card-header h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .modern-card-header svg {
        color: var(--primary);
    }

    .modern-card-body {
        padding: 2rem 1.5rem;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-label.required::after {
        content: ' *';
        color: var(--danger);
    }

    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.2s;
        width: 100%;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        outline: none;
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    .form-hint {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-top: 0.5rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding: 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }

    .btn-cancel {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: var(--primary-light);
        color: white;
    }

    .btn-save {
        background: var(--success);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .btn-save:hover {
        background: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .unit-create-page {
            padding-bottom: 100px;
        }

        .unit-header-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
            border-radius: 12px;
        }

        .unit-header-card h1 {
            justify-content: center;
            font-size: 1.25rem;
        }

        .unit-header-card h1 svg {
            width: 24px;
            height: 24px;
        }

        .modern-card {
            border-radius: 12px;
        }

        .modern-card-body {
            padding: 1.5rem 1rem;
        }

        /* Fixed Action Buttons on Mobile */
        .action-buttons {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 1rem;
            margin: 0;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            z-index: 100;
            justify-content: center;
            gap: 0.75rem;
            border-radius: 0;
        }

        .btn-cancel, .btn-save {
            flex: 1;
            justify-content: center;
            padding: 12px 16px;
            font-size: 0.875rem;
        }
    }
</style>

<div class="unit-create-page">
    <div class="container-xl">
        <!-- Header -->
        <div class="unit-header-card">
            <div>
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <line x1="12" y1="11" x2="12" y2="17"></line>
                        <line x1="9" y1="14" x2="15" y2="14"></line>
                    </svg>
                    {{ __('Add New Unit') }}
                </h1>
                <p>{{ __('Create a new measurement unit') }}</p>
            </div>
        </div>

        <form action="{{ route('units.store') }}" method="POST">
            @csrf
            <div class="modern-card">
                <div class="modern-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    </svg>
                    <h3>{{ __('Unit Details') }}</h3>
                </div>
                <div class="modern-card-body">
                    <div class="form-group">
                        <label for="name" class="form-label required">{{ __('Unit Name') }}</label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            placeholder="e.g., Kilogram, Meter, Piece"
                            required
                            autofocus
                        >
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <p class="form-hint">{{ __('Enter the full name of the measurement unit.') }}</p>
                    </div>

                    <div class="form-group">
                        <label for="short_code" class="form-label required">{{ __('Short Code') }}</label>
                        <input 
                            type="text" 
                            class="form-control @error('short_code') is-invalid @enderror" 
                            id="short_code" 
                            name="short_code" 
                            value="{{ old('short_code') }}" 
                            placeholder="e.g., kg, m, pcs"
                            required
                        >
                        @error('short_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <p class="form-hint">{{ __('A short abbreviation for the unit (used in reports and invoices).') }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('units.index') }}" class="btn-cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn-save">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        {{ __('Create Unit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
