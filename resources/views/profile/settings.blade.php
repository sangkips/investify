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

    .section-icon.danger {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
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
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .form-stack {
        display: flex;
        flex-direction: column;
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

    .btn-danger {
        background: var(--danger);
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
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    .btn-danger svg {
        width: 18px;
        height: 18px;
    }

    /* Content Layout */
    .settings-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        padding: 1.5rem;
    }

    /* Warning Box */
    .warning-box {
        background: var(--danger-light);
        border: 1px solid var(--danger);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .warning-box svg {
        color: var(--danger);
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .warning-box p {
        color: #991b1b;
        font-size: 0.9rem;
        margin: 0;
        line-height: 1.5;
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
        .settings-layout {
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

        .settings-layout {
            padding: 1rem;
            gap: 1rem;
        }

        .section-body {
            padding: 1.25rem;
        }

        .section-footer {
            flex-direction: column;
        }

        .section-footer .btn-save,
        .section-footer .btn-danger {
            width: 100%;
            justify-content: center;
        }

        .form-grid {
            grid-template-columns: 1fr;
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
            <a href="{{ route('profile.edit') }}" class="profile-tab">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                {{ __('Profile') }}
            </a>
            <a href="{{ route('profile.settings') }}" class="profile-tab active">
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
        <div class="settings-layout">
            <!-- Password Section -->
            <div>
                <div class="section-card">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        <h3 class="section-title">{{ __('Change Password') }}</h3>
                    </div>
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="section-body">
                            <div class="form-stack">
                                <div class="form-group">
                                    <label for="current_password">{{ __('Current Password') }} <span style="color: var(--danger);">*</span></label>
                                    <input type="password" id="current_password" name="current_password" required class="@error('current_password') is-invalid @enderror">
                                    @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('New Password') }} <span style="color: var(--danger);">*</span></label>
                                    <input type="password" id="password" name="password" required class="@error('password') is-invalid @enderror">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">{{ __('Confirm New Password') }} <span style="color: var(--danger);">*</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        <div class="section-footer">
                            <button type="submit" class="btn-save">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                {{ __('Update Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div>
                <div class="section-card">
                    <div class="section-header">
                        <div class="section-icon danger">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                        </div>
                        <h3 class="section-title">{{ __('Danger Zone') }}</h3>
                    </div>
                    <div class="section-body">
                        <div class="warning-box">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <p>{{ __('Deleting your account is permanent and cannot be undone. All your data will be permanently removed.') }}</p>
                        </div>
                    </div>
                    <div class="section-footer">
                        <button type="button" class="btn-danger" onclick="confirm('{{ __('Are you sure you want to delete your account? This action cannot be undone.') }}') && document.getElementById('delete-account-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </div>
                <form id="delete-account-form" action="{{ route('profile.destroy') }}" method="POST" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
