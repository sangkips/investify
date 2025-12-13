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
    .supplier-create-page {
        min-height: 100vh;
        padding-bottom: 2rem;
    }

    /* Header Card */
    .supplier-header-card {
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

    .supplier-header-card h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .supplier-header-card p {
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
        margin-bottom: 1.5rem;
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

    /* Profile Section */
    .profile-upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 2rem 1rem;
    }

    .profile-image-preview {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #e0e7ff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
        background: #f8fafc;
    }

    .upload-hint {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 1rem;
    }

    .upload-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .upload-btn:hover {
        background: var(--primary-light);
    }

    .file-input {
        display: none;
    }

    /* Form Styles */
    .form-section {
        margin-bottom: 1.5rem;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section-title {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section-title svg {
        width: 16px;
        height: 16px;
        opacity: 0.7;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .form-grid-full {
        grid-column: span 2;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-label.required::after {
        content: ' *';
        color: var(--danger);
    }

    .form-control, .form-select {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        transition: all 0.2s;
        width: 100%;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        outline: none;
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
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
        .supplier-create-page {
            padding-bottom: 100px;
        }

        .supplier-header-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
            border-radius: 12px;
        }

        .supplier-header-card h1 {
            justify-content: center;
            font-size: 1.25rem;
        }

        .supplier-header-card h1 svg {
            width: 24px;
            height: 24px;
        }

        .modern-card-body {
            padding: 1rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-grid-full {
            grid-column: span 1;
        }

        .profile-upload-section {
            padding: 1.5rem 1rem;
        }

        .profile-image-preview {
            width: 120px;
            height: 120px;
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

<div class="supplier-create-page">
    <div class="container-xl">
        <!-- Header -->
        <div class="supplier-header-card">
            <div>
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    {{ __('Add New Supplier') }}
                </h1>
                <p>{{ __('Create a new supplier account') }}</p>
            </div>
        </div>

        <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <!-- Profile Image Card -->
                <div class="col-lg-4">
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <h3>{{ __('Profile Image') }}</h3>
                        </div>
                        <div class="profile-upload-section">
                            <img class="profile-image-preview" src="{{ asset('assets/img/demo/user-placeholder.svg') }}" alt="" id="image-preview" />
                            <p class="upload-hint">JPG or PNG no larger than 1 MB</p>
                            <label for="image" class="upload-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                {{ __('Upload Photo') }}
                            </label>
                            <input class="file-input @error('photo') is-invalid @enderror" type="file" id="image" name="photo" accept="image/*" onchange="previewImage();">
                            @error('photo')
                            <div class="invalid-feedback d-block mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Details Card -->
                <div class="col-lg-8">
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <h3>{{ __('Supplier Details') }}</h3>
                        </div>
                        <div class="modern-card-body">
                            <!-- Basic Information -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    Basic Information
                                </div>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="name" class="form-label required">{{ __('Name') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label required">{{ __('Email Address') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label required">{{ __('Phone Number') }}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="shopname" class="form-label required">{{ __('Shop Name') }}</label>
                                        <input type="text" class="form-control @error('shopname') is-invalid @enderror" id="shopname" name="shopname" value="{{ old('shopname') }}" required>
                                        @error('shopname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kra_pin" class="form-label required">{{ __('KRA PIN') }}</label>
                                        <input type="text" class="form-control @error('kra_pin') is-invalid @enderror" id="kra_pin" name="kra_pin" value="{{ old('kra_pin') }}" required>
                                        @error('kra_pin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="form-label required">{{ __('Supplier Type') }}</label>
                                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="" disabled selected>{{ __('Select a type') }}</option>
                                            @foreach(\App\Enums\SupplierType::cases() as $supplierType)
                                            <option value="{{ $supplierType->value }}" @selected(old('type') == $supplierType->value)>
                                                {{ $supplierType->label() }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group form-grid-full">
                                        <label for="address" class="form-label required">{{ __('Address') }}</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Banking Information -->
                            <div class="form-section">
                                <div class="form-section-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    Banking Information (Optional)
                                </div>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="bank_name" class="form-label">{{ __('Bank Name') }}</label>
                                        <select class="form-select @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name">
                                            <option value="">{{ __('Select a bank') }}</option>
                                            @php
                                                $banks = ['KCB', 'NCBA', 'Equity', 'Absa', 'Family', 'National', 'Cooperative', 'Stanbic', 'DTB', 'I&M', 'Standard Chartered'];
                                            @endphp
                                            @foreach($banks as $bank)
                                            <option value="{{ $bank }}" @selected(old('bank_name') == $bank)>{{ $bank }}</option>
                                            @endforeach
                                        </select>
                                        @error('bank_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="account_holder" class="form-label">{{ __('Account Holder') }}</label>
                                        <input type="text" class="form-control @error('account_holder') is-invalid @enderror" id="account_holder" name="account_holder" value="{{ old('account_holder') }}">
                                        @error('account_holder')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group form-grid-full">
                                        <label for="account_number" class="form-label">{{ __('Account Number') }}</label>
                                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ old('account_number') }}">
                                        @error('account_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('suppliers.index') }}" class="btn-cancel">
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
                                {{ __('Create Supplier') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce