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

    /* Card Styling */
    .users-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .users-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .users-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .users-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .btn-create {
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
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-create:hover {
        background: var(--accent-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    /* Desktop Table Styling */
    .desktop-view {
        display: block;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
    }

    .users-table thead {
        background: #f8fafc;
    }

    .users-table th {
        padding: 1rem 1.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
    }

    .users-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .users-table tbody tr:hover {
        background: #fafbfc;
    }

    .users-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* User Info */
    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        flex-shrink: 0;
        overflow: hidden;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-details .user-name {
        font-weight: 600;
        color: var(--primary);
        margin: 0;
        text-decoration: none;
    }

    .user-details .user-name:hover {
        text-decoration: underline;
    }

    .user-details .user-email {
        font-size: 0.8rem;
        color: var(--text-light);
        margin: 0;
    }

    /* Role Badge */
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .role-badge.admin {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
    }

    .role-badge.manager {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .role-badge.sales {
        background: var(--success-light);
        color: #166534;
    }

    .role-badge.inventory {
        background: var(--warning-light);
        color: #92400e;
    }

    .role-badge.viewer {
        background: #f1f5f9;
        color: var(--text-light);
    }

    .role-badge.no-role {
        background: #f1f5f9;
        color: var(--text-light);
    }

    /* Action Buttons */
    .action-btn {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .action-btn svg {
        width: 14px;
        height: 14px;
    }

    .action-btn.view {
        background: #e0e7ff;
        color: var(--primary);
    }

    .action-btn.view:hover {
        background: #c7d2fe;
    }

    .action-btn.edit {
        background: var(--warning-light);
        color: #92400e;
    }

    .action-btn.edit:hover {
        background: #fde68a;
    }

    .action-btn.delete {
        background: var(--danger-light);
        color: var(--danger);
    }

    .action-btn.delete:hover {
        background: #fecaca;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon svg {
        width: 40px;
        height: 40px;
        color: var(--text-light);
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 8px;
    }

    .empty-state p {
        color: var(--text-light);
        font-size: 0.9rem;
        margin: 0;
    }

    /* Footer */
    .users-footer {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .users-footer .text-secondary {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* Mobile View */
    .mobile-view {
        display: none;
    }

    .user-card-item {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .user-card-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .user-card-item:last-child {
        margin-bottom: 0;
    }

    .user-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .user-card-info {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
    }

    .user-card-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        flex-shrink: 0;
        overflow: hidden;
    }

    .user-card-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-card-details h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        margin: 0 0 4px;
    }

    .user-card-details p {
        font-size: 0.85rem;
        color: var(--text-light);
        margin: 0;
    }

    .user-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.75rem;
        margin-top: 0.75rem;
        border-top: 1px solid #f1f5f9;
    }

    .user-card-date {
        font-size: 0.75rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .user-card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .mobile-cards-container {
        padding: 1rem;
        background: #f8fafc;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .desktop-view {
            display: none;
        }

        .mobile-view {
            display: block;
        }

        .users-header {
            padding: 1rem;
        }

        .users-header-content h1 {
            font-size: 1.25rem;
        }

        .btn-create {
            padding: 10px 20px;
            font-size: 0.85rem;
        }

        .users-footer {
            display: none;
        }
    }

    @media (min-width: 769px) {
        .mobile-view {
            display: none !important;
        }

        .desktop-view {
            display: block !important;
        }
    }
</style>

<div class="container-xl">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="users-card">
        <!-- Header -->
        <div class="users-header">
            <div class="users-header-content">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    {{ __('Users') }}
                </h1>
                <p>{{ count($users) }} {{ __('total users') }}</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn-create">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                {{ __('Add User') }}
            </a>
        </div>

        <!-- Desktop Table View -->
        <div class="desktop-view">
            @if(count($users) > 0)
            <table class="users-table">
                <thead>
                    <tr>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Joined') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/profile/' . $user->photo) }}" alt="{{ $user->name }}">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="user-details">
                                    <a href="{{ route('users.show', $user) }}" class="user-name">{{ $user->name }}</a>
                                    <p class="user-email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($user->roles->count() > 0)
                                @php
                                    $roleName = strtolower($user->roles->first()->name);
                                    $roleClass = match(true) {
                                        str_contains($roleName, 'admin') => 'admin',
                                        str_contains($roleName, 'manager') => 'manager',
                                        str_contains($roleName, 'sales') => 'sales',
                                        str_contains($roleName, 'inventory') => 'inventory',
                                        str_contains($roleName, 'viewer') => 'viewer',
                                        default => 'no-role'
                                    };
                                @endphp
                                <span class="role-badge {{ $roleClass }}">{{ ucfirst($user->roles->first()->name) }}</span>
                            @else
                                <span class="role-badge no-role">{{ __('No Role') }}</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d M, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h3>{{ __('No users found') }}</h3>
                <p>{{ __('Add your first user to get started.') }}</p>
            </div>
            @endif
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-view">
            @if(count($users) > 0)
            <div class="mobile-cards-container">
                @foreach ($users as $user)
                <div class="user-card-item">
                    <div class="user-card-header">
                        <div class="user-card-info">
                            <div class="user-card-avatar">
                                @if($user->photo)
                                    <img src="{{ asset('storage/profile/' . $user->photo) }}" alt="{{ $user->name }}">
                                @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            <div class="user-card-details">
                                <a href="{{ route('users.show', $user) }}" style="text-decoration: none;">
                                    <h4>{{ $user->name }}</h4>
                                </a>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        @if($user->roles->count() > 0)
                            @php
                                $roleName = strtolower($user->roles->first()->name);
                                $roleClass = match(true) {
                                    str_contains($roleName, 'admin') => 'admin',
                                    str_contains($roleName, 'manager') => 'manager',
                                    str_contains($roleName, 'sales') => 'sales',
                                    str_contains($roleName, 'inventory') => 'inventory',
                                    str_contains($roleName, 'viewer') => 'viewer',
                                    default => 'no-role'
                                };
                            @endphp
                            <span class="role-badge {{ $roleClass }}">{{ ucfirst($user->roles->first()->name) }}</span>
                        @else
                            <span class="role-badge no-role">{{ __('No Role') }}</span>
                        @endif
                    </div>
                    <div class="user-card-footer">
                        <span class="user-card-date">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            {{ __('Joined') }} {{ $user->created_at->format('d M, Y') }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h3>{{ __('No users found') }}</h3>
                <p>{{ __('Add your first user to get started.') }}</p>
            </div>
            @endif
        </div>

        <!-- Footer -->
        @if(count($users) > 0)
        <div class="users-footer desktop-view">
            <p class="m-0 text-secondary">
                {{ __('Showing') }} <strong>{{ count($users) }}</strong> {{ __('users') }}
            </p>
        </div>
        @endif
    </div>
</div>
@endsection