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
    .quotation-page {
        min-height: 100vh;
        padding-bottom: 2rem;
    }

    /* Header Card */
    .quotation-header-card {
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

    .quotation-header-card h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .quotation-header-card p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 4px 0 0;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }

    /* Modern Card */
    .modern-card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: visible;
        margin-bottom: 1.5rem;
        position: relative;
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
        padding: 1.5rem;
    }

    /* Form Styling */
    .form-label-modern {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-label-modern .required {
        color: var(--danger);
    }

    .form-input-modern {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        color: var(--text-dark);
        background: #f8fafc;
        transition: all 0.2s;
    }

    .form-input-modern:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background: white;
    }

    .form-input-modern:disabled,
    .form-input-modern[readonly] {
        background: #f1f5f9;
        color: var(--text-light);
    }

    .form-select-modern {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        color: var(--text-dark);
        background: #f8fafc url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") right 12px center/16px no-repeat;
        appearance: none;
        transition: all 0.2s;
    }

    .form-select-modern:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background-color: white;
    }

    .form-textarea-modern {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        color: var(--text-dark);
        background: #f8fafc;
        transition: all 0.2s;
        resize: vertical;
        min-height: 120px;
    }

    .form-textarea-modern:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background: white;
    }

    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .form-group {
        margin-bottom: 0;
    }

    /* Error State */
    .is-invalid {
        border-color: var(--danger) !important;
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.75rem;
        margin-top: 6px;
    }

    /* Alert Styling */
    .alert-modern {
        background: var(--danger-light);
        border: 1px solid var(--danger);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .alert-modern ul {
        margin: 0;
        padding-left: 1.25rem;
    }

    .alert-modern li {
        color: var(--danger);
        font-size: 0.875rem;
    }

    /* Submit Button */
    .btn-submit {
        background: var(--success);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        cursor: pointer;
    }

    .btn-submit:hover {
        background: #16a34a;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
    }

    /* Submit Button Container */
    .submit-container {
        display: flex;
        justify-content: flex-end;
        padding: 1rem 0;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .quotation-page {
            padding-bottom: 100px;
        }

        .quotation-header-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .quotation-header-card h1 {
            justify-content: center;
            font-size: 1.25rem;
        }

        .quotation-header-card h1 svg {
            width: 24px;
            height: 24px;
        }

        .quotation-header-card p {
            font-size: 0.8rem;
        }

        .btn-back {
            padding: 8px 16px;
            font-size: 0.8rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .modern-card {
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .modern-card-header {
            padding: 0.875rem 1rem;
        }

        .modern-card-header h3 {
            font-size: 0.9rem;
        }

        .modern-card-body {
            padding: 1rem;
        }

        .form-input-modern,
        .form-select-modern {
            padding: 10px 14px;
            font-size: 0.875rem;
        }

        .form-textarea-modern {
            min-height: 100px;
        }

        /* Fixed submit button on mobile */
        .submit-container {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 1rem;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            z-index: 100;
            justify-content: center;
        }

        .btn-submit {
            width: 100%;
            justify-content: center;
            padding: 14px 24px;
        }

        /* Cart table mobile styles */
        .modern-card-body .table-responsive {
            margin: 0 -1rem;
            width: calc(100% + 2rem);
        }

        .modern-card-body .table {
            font-size: 0.75rem;
        }

        .modern-card-body .table th,
        .modern-card-body .table td {
            padding: 0.5rem 0.4rem;
            white-space: nowrap;
        }
    }
</style>

<div class="quotation-page">
    <div class="container-xl">
        <!-- Header -->
        <div class="quotation-header-card">
            <div>
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                    {{ __('New Quotation') }}
                </h1>
                <p>{{ __('Create a new quotation for your customer') }}</p>
            </div>
            <a href="{{ route('quotations.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                {{ __('Back to List') }}
            </a>
        </div>

        @include('partials.session')

        @if ($errors->any())
        <div class="alert-modern">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('quotations.store') }}" method="POST">
            @csrf

            <!-- Products Card -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <h3>{{ __('Products') }}</h3>
                </div>
                <div class="modern-card-body">
                    <livewire:search-product />
                </div>
            </div>

            <!-- Quotation Details Card -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    <h3>{{ __('Quotation Details') }}</h3>
                </div>
                <div class="modern-card-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label-modern" for="date">
                                {{ __('Date') }}
                                <span class="required">*</span>
                            </label>
                            <input type="date" 
                                   class="form-input-modern @error('date') is-invalid @enderror" 
                                   name="date" 
                                   id="date" 
                                   value="{{ now()->format('Y-m-d') }}">
                            @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-modern" for="customer_id">
                                {{ __('Customer') }}
                                <span class="required">*</span>
                            </label>
                            <select class="form-select-modern @error('customer_id') is-invalid @enderror" 
                                    id="customer_id" 
                                    name="customer_id">
                                <option value="" disabled selected>{{ __('Select a customer') }}</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                                    {{ $customer->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label-modern" for="status">
                                {{ __('Status') }}
                                <span class="required">*</span>
                            </label>
                            <select class="form-select-modern" name="status" id="status" required>
                                @foreach(\App\Enums\QuotationStatus::cases() as $status)
                                <option value="{{ $status->value }}">
                                    {{ $status->label() }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label-modern" for="reference">
                                {{ __('Reference') }}
                            </label>
                            <input type="text" 
                                   id="reference" 
                                   name="reference" 
                                   class="form-input-modern" 
                                   value="QT" 
                                   readonly>
                            @error('reference')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <h3>{{ __('Items') }}</h3>
                </div>
                <div class="modern-card-body" style="padding: 0;">
                    <livewire:product-cart :cartInstance="'quotation'" />
                </div>
            </div>

            <!-- Notes Card -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="17" y1="10" x2="3" y2="10"></line>
                        <line x1="21" y1="6" x2="3" y2="6"></line>
                        <line x1="21" y1="14" x2="3" y2="14"></line>
                        <line x1="17" y1="18" x2="3" y2="18"></line>
                    </svg>
                    <h3>{{ __('Notes') }}</h3>
                </div>
                <div class="modern-card-body">
                    <textarea name="note" 
                              id="note" 
                              class="form-textarea-modern" 
                              placeholder="{{ __('Add any additional notes or terms for this quotation...') }}"></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="submit-container">
                <button type="submit" class="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    {{ __('Create Quotation') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection