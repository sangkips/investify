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
    .edit-user-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    /* Header */
    .edit-user-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .edit-user-header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .edit-user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
        flex-shrink: 0;
        border: 2px solid rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }

    .edit-user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .edit-user-info h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
    }

    .edit-user-info p {
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

    .photo-preview-initial {
        font-size: 3rem;
        font-weight: 700;
        color: var(--text-light);
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
    .edit-layout {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 1.5rem;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .edit-user-header {
            padding: 1.25rem;
            flex-direction: column;
            text-align: center;
        }

        .edit-user-header-content {
            flex-direction: column;
        }

        .edit-user-info h1 {
            font-size: 1.25rem;
        }

        .edit-layout {
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

        .section-footer .btn-cancel {
            background: var(--primary);
            color: white;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .photo-preview {
            width: 120px;
            height: 120px;
        }

        .photo-preview-initial {
            font-size: 2.5rem;
        }
    }
</style>

<div class="container-xl">
    @include('partials.session')

    <!-- Header Card -->
    <div class="edit-user-card">
        <div class="edit-user-header">
            <div class="edit-user-header-content">
                <div class="edit-user-avatar">
                    @if($user->photo)
                        <img src="{{ asset('storage/profile/' . $user->photo) }}" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div class="edit-user-info">
                    <h1>{{ __('Edit User') }}</h1>
                    <p>{{ $user->name }} • {{ $user->email }}</p>
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

    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="edit-layout">
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
                                @if($user->photo)
                                    <img id="image-preview" src="{{ asset('storage/profile/' . $user->photo) }}" alt="{{ $user->name }}">
                                @else
                                    <span class="photo-preview-initial" id="image-preview">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                @endif
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
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="@error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }} <span style="color: var(--danger);">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="@error('email') is-invalid @enderror">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Change Password Section -->
    <form action="{{ route('users.updatePassword', $user) }}" method="POST">
        @csrf
        @method('put')

        <div class="section-card" style="margin-top: 1.5rem;">
            <div class="section-header">
                <div class="section-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h3 class="section-title">{{ __('Change Password') }}</h3>
            </div>
            <div class="section-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="password">{{ __('New Password') }}</label>
                        <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror" placeholder="{{ __('Enter new password') }}">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Confirm new password') }}">
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
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    {{ __('Update Password') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
