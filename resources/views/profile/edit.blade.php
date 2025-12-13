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

    /* Main Profile Card */
    .profile-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    /* Profile Header */
    .profile-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .profile-header-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 2.5rem;
        flex-shrink: 0;
        border: 4px solid rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
        margin: 0 0 8px;
    }

    .profile-info p {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .profile-info p svg {
        width: 16px;
        height: 16px;
        opacity: 0.8;
    }

    .btn-dashboard {
        background: rgba(255, 255, 255, 0.2);
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
        backdrop-filter: blur(10px);
    }

    .btn-dashboard:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }

    .btn-dashboard svg {
        width: 18px;
        height: 18px;
    }

    /* Tab Navigation */
    .profile-tabs {
        display: flex;
        gap: 0;
        padding: 0 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        background: white;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .profile-tabs::-webkit-scrollbar {
        display: none;
    }

    .profile-tab {
        padding: 1rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-light);
        text-decoration: none;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .profile-tab svg {
        width: 18px;
        height: 18px;
    }

    .profile-tab:hover {
        color: var(--primary);
    }

    .profile-tab.active {
        color: var(--primary);
        border-bottom-color: var(--accent);
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
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .section-icon svg {
        width: 22px;
        height: 22px;
    }

    .section-title {
        font-size: 1.1rem;
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
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
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
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.2s;
        background: white;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(30, 27, 75, 0.1);
    }

    .form-group input.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.8rem;
        margin-top: 0.5rem;
        display: block;
    }

    /* Photo Upload */
    .photo-upload-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .photo-preview {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        overflow: hidden;
        border: 4px solid #e2e8f0;
        transition: all 0.2s;
    }

    .photo-preview:hover {
        border-color: var(--primary);
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-preview-initial {
        font-size: 4rem;
        font-weight: 700;
        color: var(--text-light);
    }

    .photo-hint {
        font-size: 0.85rem;
        color: var(--text-light);
        margin-bottom: 1rem;
    }

    .photo-input {
        width: 100%;
        max-width: 280px;
    }

    /* Buttons */
    .btn-save {
        background: var(--accent);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
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
        width: 18px;
        height: 18px;
    }

    /* Profile Layout */
    .profile-layout {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 1.5rem;
        padding: 1.5rem;
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
        .profile-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 1.5rem;
            flex-direction: column;
            text-align: center;
        }

        .profile-header-content {
            flex-direction: column;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }

        .profile-info h1 {
            font-size: 1.35rem;
        }

        .profile-info p {
            justify-content: center;
            font-size: 0.875rem;
        }

        .btn-dashboard {
            width: 100%;
            justify-content: center;
        }

        .profile-tabs {
            padding: 0 1rem;
        }

        .profile-tab {
            padding: 0.875rem 1rem;
            font-size: 0.8rem;
        }

        .profile-tab svg {
            display: none;
        }

        .profile-layout {
            padding: 1rem;
            gap: 1rem;
        }

        .section-body {
            padding: 1.25rem;
        }

        .section-footer {
            flex-direction: column;
        }

        .section-footer .btn-save {
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

        .photo-preview-initial {
            font-size: 3rem;
        }

        .photo-input {
            max-width: 100%;
        }
    }
</style>

<div class="container-xl">
    @include('partials.session')

    <!-- Profile Card -->
    <div class="profile-card">
        <!-- Header -->
        <div class="profile-header">
            <div class="profile-header-content">
                <div class="profile-avatar">
                    @if($user->photo)
                        <img src="{{ asset('storage/profile/' . $user->photo) }}" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div class="profile-info">
                    <h1>{{ $user->name }}</h1>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        {{ $user->email }}
                    </p>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                </svg>
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Tabs -->
        <div class="profile-tabs">
            <a href="{{ route('profile.edit') }}" class="profile-tab active">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                {{ __('Profile') }}
            </a>
            <a href="{{ route('profile.settings') }}" class="profile-tab">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                {{ __('Security') }}
            </a>
            <a href="{{ route('profile.store.settings') }}" class="profile-tab">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                {{ __('Store') }}
            </a>
        </div>

        <!-- Content -->
        <div class="profile-layout">
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
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="username" value="{{ $user->username }}">
                        <div class="section-body">
                            <div class="photo-upload-container">
                                <div class="photo-preview">
                                    @if($user->photo)
                                        <img id="image-preview" src="{{ asset('storage/profile/' . $user->photo) }}" alt="{{ $user->name }}">
                                    @else
                                        <span class="photo-preview-initial" id="initial-preview">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <p class="photo-hint">{{ __('JPG or PNG, max 1 MB') }}</p>
                                <input class="form-control photo-input @error('photo') is-invalid @enderror" type="file" id="image" name="photo" accept="image/*" onchange="previewImage();">
                                @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="section-footer">
                            <button type="submit" class="btn-save">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                {{ __('Upload Photo') }}
                            </button>
                        </div>
                    </form>
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
                        <h3 class="section-title">{{ __('Account Details') }}</h3>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="section-body">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="username">{{ __('Username') }} <span style="color: var(--danger);">*</span></label>
                                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required class="@error('username') is-invalid @enderror">
                                    @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ __('Full Name') }} <span style="color: var(--danger);">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="@error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="grid-column: 1 / -1;">
                                    <label for="email">{{ __('Email Address') }} <span style="color: var(--danger);">*</span></label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="@error('email') is-invalid @enderror">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="section-footer">
                            <button type="submit" class="btn-save">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script>
function previewImage() {
    const file = document.getElementById('image').files[0];
    const preview = document.getElementById('image-preview');
    const initialPreview = document.getElementById('initial-preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Remove initial if exists
            if (initialPreview) {
                initialPreview.remove();
            }
            
            // Check if preview exists, if not create it
            let img = preview;
            if (!img || img.tagName !== 'IMG') {
                img = document.createElement('img');
                img.id = 'image-preview';
                document.querySelector('.photo-preview').innerHTML = '';
                document.querySelector('.photo-preview').appendChild(img);
            }
            
            img.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush