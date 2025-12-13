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

    /* Main Card */
    .create-user-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    /* Header */
    .create-user-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .create-user-header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .create-user-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .create-user-icon svg {
        width: 24px;
        height: 24px;
    }

    .create-user-info h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
    }

    .create-user-info p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.2);
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
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .btn-back svg {
        width: 16px;
        height: 16px;
    }

    /* Section Card */
    .section-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .section-card:last-child {
        margin-bottom: 0;
    }

    .section-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .section-icon svg {
        width: 20px;
        height: 20px;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .section-body {
        padding: 1.5rem;
    }

    .section-footer {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* Form Styles */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.25rem;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        transition: all 0.2s;
        background: white;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    .form-group input.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    /* Photo Upload */
    .photo-upload-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .photo-preview {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        overflow: hidden;
        border: 3px solid #e2e8f0;
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-hint {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 1rem;
    }

    .photo-input {
        width: 100%;
    }

    /* Buttons */
    .btn-save {
        background: var(--accent);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-save:hover {
        background: var(--accent-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    .btn-save svg {
        width: 16px;
        height: 16px;
    }

    .btn-cancel {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background: var(--primary-light);
        color: white;
        transform: translateY(-2px);
    }

    .btn-cancel svg {
        width: 16px;
        height: 16px;
    }

    /* Layout */
    .create-layout {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 1.5rem;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .create-user-header {
            padding: 1.25rem;
            flex-direction: column;
            text-align: center;
        }

        .create-user-header-content {
            flex-direction: column;
        }

        .create-user-info h1 {
            font-size: 1.25rem;
        }

        .create-layout {
            grid-template-columns: 1fr;
        }

        .section-body {
            padding: 1.25rem;
        }

        .section-footer {
            flex-direction: column;
        }

        .section-footer .btn-save,
        .section-footer .btn-cancel {
            width: 100%;
            justify-content: center;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .photo-preview {
            width: 120px;
            height: 120px;
        }
    }
</style>

<div class="container-xl">
    @include('partials.session')

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Header Card -->
        <div class="create-user-card">
            <div class="create-user-header">
                <div class="create-user-header-content">
                    <div class="create-user-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                    </div>
                    <div class="create-user-info">
                        <h1>{{ __('Create New User') }}</h1>
                        <p>{{ __('Add a new user to the system') }}</p>
                    </div>
                </div>
                <a href="{{ route('users.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    {{ __('Back to Users') }}
                </a>
            </div>
        </div>

        <div class="create-layout">
            <!-- Photo Section -->
            <div>
                <div class="section-card">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <h3 class="section-title">{{ __('Profile Photo') }}</h3>
                    </div>
                    <div class="section-body">
                        <div class="photo-upload-container">
                            <div class="photo-preview">
                                <img id="image-preview" src="{{ asset('assets/img/demo/user-placeholder.svg') }}" alt="User Photo">
                            </div>
                            <p class="photo-hint">{{ __('JPG or PNG, max 1 MB') }}</p>
                            <input class="form-control photo-input @error('photo') is-invalid @enderror" type="file" id="image" name="photo" accept="image/*" onchange="previewImage();">
                            @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div>
                <div class="section-card">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h3 class="section-title">{{ __('User Details') }}</h3>
                    </div>
                    <div class="section-body">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name">{{ __('Full Name') }} <span style="color: var(--danger);">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="@error('name') is-invalid @enderror" placeholder="{{ __('Enter full name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }} <span style="color: var(--danger);">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="@error('email') is-invalid @enderror" placeholder="{{ __('Enter email address') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }} <span style="color: var(--danger);">*</span></label>
                                <input type="password" id="password" name="password" required class="@error('password') is-invalid @enderror" placeholder="{{ __('Enter password') }}">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Confirm Password') }} <span style="color: var(--danger);">*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="{{ __('Confirm password') }}">
                            </div>
                        </div>
                    </div>
                    <div class="section-footer">
                        <a href="{{ route('users.index') }}" class="btn-cancel">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn-save">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            {{ __('Create User') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
