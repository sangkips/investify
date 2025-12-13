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
    .user-profile-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .user-profile-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .user-profile-header-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .user-profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 2rem;
        flex-shrink: 0;
        border: 3px solid rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }

    .user-profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-profile-info h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
        margin: 0 0 8px;
    }

    .user-profile-info .user-email {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0 0 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .user-profile-info .user-email svg {
        width: 16px;
        height: 16px;
        opacity: 0.8;
    }

    /* Role Badge */
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
    }

    /* Action Buttons */
    .user-profile-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .action-btn {
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .action-btn svg {
        width: 16px;
        height: 16px;
    }

    .action-btn.back {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
    }

    .action-btn.back:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .action-btn.edit {
        background: var(--accent);
        color: white;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .action-btn.edit:hover {
        background: var(--accent-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    .action-btn.delete {
        background: var(--danger);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .action-btn.delete:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    /* Details Section */
    .user-details-section {
        padding: 2rem;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .detail-card {
        background: #f8fafc;
        border-radius: 16px;
        padding: 1.25rem;
        border: 1px solid #e2e8f0;
    }

    .detail-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0.75rem;
    }

    .detail-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .detail-card-icon svg {
        width: 20px;
        height: 20px;
    }

    .detail-card-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
    }

    .detail-card-value {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
        word-break: break-word;
    }

    .detail-card-value.verified {
        color: var(--success);
    }

    .detail-card-value.not-verified {
        color: var(--text-light);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .user-profile-header {
            padding: 1.5rem;
            flex-direction: column;
            align-items: stretch;
        }

        .user-profile-header-content {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .user-profile-avatar {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
        }

        .user-profile-info h1 {
            font-size: 1.5rem;
        }

        .user-profile-info .user-email {
            justify-content: center;
        }

        .user-profile-actions {
            justify-content: center;
            margin-top: 1rem;
        }

        .action-btn {
            padding: 10px 16px;
            font-size: 0.8rem;
        }

        .user-details-section {
            padding: 1.5rem;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-xl">
    @include('partials.session')

    <div class="user-profile-card">
        <!-- Header -->
        <div class="user-profile-header">
            <div class="user-profile-header-content">
                <div class="user-profile-avatar">
                    @if($user->photo)
                        <img src="{{ asset('storage/profile/' . $user->photo) }}" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div class="user-profile-info">
                    <h1>{{ $user->name }}</h1>
                    <p class="user-email">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        {{ $user->email }}
                    </p>
                    @if($user->roles->count() > 0)
                        <span class="role-badge">{{ ucfirst($user->roles->first()->name) }}</span>
                    @else
                        <span class="role-badge">{{ __('No Role') }}</span>
                    @endif
                </div>
            </div>

            <div class="user-profile-actions">
                <a href="{{ route('users.index') }}" class="action-btn back">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    {{ __('Back') }}
                </a>
                <a href="{{ route('users.edit', $user) }}" class="action-btn edit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    {{ __('Edit') }}
                </a>
                @if(!$user->hasRole('super-admin') && $user->id !== auth()->id())
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        {{ __('Delete') }}
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- Details Section -->
        <div class="user-details-section">
            <div class="details-grid">
                <!-- Name -->
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <span class="detail-card-label">{{ __('Full Name') }}</span>
                    </div>
                    <p class="detail-card-value">{{ $user->name }}</p>
                </div>

                <!-- Email -->
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <span class="detail-card-label">{{ __('Email Address') }}</span>
                    </div>
                    <p class="detail-card-value">{{ $user->email }}</p>
                </div>

                <!-- Email Verification -->
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <span class="detail-card-label">{{ __('Email Verification') }}</span>
                    </div>
                    @if($user->email_verified_at)
                        <p class="detail-card-value verified">
                            {{ __('Verified on') }} {{ $user->email_verified_at->format('d M, Y') }}
                        </p>
                    @else
                        <p class="detail-card-value not-verified">{{ __('Not Verified') }}</p>
                    @endif
                </div>

                <!-- Joined Date -->
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <span class="detail-card-label">{{ __('Joined Date') }}</span>
                    </div>
                    <p class="detail-card-value">{{ $user->created_at->format('d M, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
