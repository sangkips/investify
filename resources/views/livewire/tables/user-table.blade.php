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

    /* Filter Bar */
    .filter-bar {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .filter-bar .entries-select {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .filter-bar select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 6px 12px;
        font-size: 0.875rem;
    }

    /* Loading Spinner */
    .loading-overlay {
        padding: 3rem;
        text-align: center;
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
    }

    .users-table th:first-child {
        text-align: left;
    }

    .users-table th a {
        color: var(--text-light);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .users-table th a:hover {
        color: var(--primary);
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
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-details .user-name {
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .user-details .user-email {
        font-size: 0.8rem;
        color: var(--text-light);
        margin: 0;
    }

    /* User Link */
    .user-link {
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s;
    }

    .user-link:hover {
        color: var(--primary-light);
        text-decoration: underline;
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

    /* Pagination styling */
    .pagination {
        display: flex;
        gap: 4px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination .page-link {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
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
    }

    .user-card-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
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
    }

    /* Mobile Search */
    .mobile-search {
        padding: 0 1rem 1rem;
        background: #f8fafc;
    }

    .mobile-search input {
        width: 100%;
        padding: 12px 16px 12px 44px;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.9rem;
        background: white;
        transition: all 0.2s;
    }

    .mobile-search input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    .mobile-search-wrapper {
        position: relative;
    }

    .mobile-search-wrapper svg {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: var(--text-light);
    }

    .mobile-cards-container {
        padding: 1rem;
        background: #f8fafc;
    }

    .mobile-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
    }

    .mobile-pagination-info {
        font-size: 0.8rem;
        color: var(--text-light);
        text-align: center;
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

        .filter-bar {
            display: none;
        }

        .users-footer {
            flex-direction: column;
            text-align: center;
            padding: 1rem;
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
    @include('partials.session')

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
                <p>{{ $users->total() }} {{ __('total users') }}</p>
            </div>
            @can('create-user')
            <a href="{{ route('users.create') }}" class="btn-create">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                {{ __('Add New User') }}
            </a>
            @endcan
        </div>

        <!-- Desktop Filter Bar -->
        <div class="filter-bar">
            <div class="entries-select">
                <span>{{ __('Show') }}</span>
                <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                </select>
                <span>{{ __('entries') }}</span>
            </div>
            <x-search-input placeholder="Search by name, email..." />
        </div>

        <!-- Mobile Search -->
        <div class="mobile-view mobile-search">
            <div class="mobile-search-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search users...') }}">
            </div>
        </div>

        <!-- Loading Spinner -->
        <div wire:loading class="loading-overlay">
            <x-spinner.loading-spinner />
        </div>

        <!-- Desktop Table View -->
        <div wire:loading.remove class="desktop-view table-responsive">
            @if($users->count() > 0)
            <table class="users-table">
                <thead>
                    <tr>
                        <th>
                            <a wire:click.prevent="sortBy('name')" href="#" role="button">
                                {{ __('User') }}
                                @include('inclues._sort-icon', ['field' => 'name'])
                            </a>
                        </th>
                        <th class="text-center">
                            {{ __('Role') }}
                        </th>
                        <th class="text-center">
                            <a wire:click.prevent="sortBy('created_at')" href="#" role="button">
                                {{ __('Joined') }}
                                @include('inclues._sort-icon', ['field' => 'created_at'])
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/uploads/users/' . $user->photo) }}" alt="{{ $user->name }}">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="user-details">
                                    <a href="{{ route('users.show', $user) }}" class="user-name user-link">{{ $user->name }}</a>
                                    <p class="user-email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
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
                        <td class="text-center">{{ $user->created_at->format('d M, Y') }}</td>
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
                <p>{{ __('Try adjusting your search or add a new user.') }}</p>
            </div>
            @endif
        </div>

        <!-- Mobile Card View -->
        <div wire:loading.remove class="mobile-view">
            @if($users->count() > 0)
            <div class="mobile-cards-container">
                @foreach ($users as $user)
                <div class="user-card-item">
                    <div class="user-card-header">
                        <div class="user-card-info">
                            <div class="user-card-avatar">
                                @if($user->photo)
                                    <img src="{{ asset('storage/uploads/users/' . $user->photo) }}" alt="{{ $user->name }}">
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
                    </div>
                    <div class="user-card-footer">
                        <span class="user-card-date">
                            {{ __('Joined') }} {{ $user->created_at->format('d M, Y') }}
                        </span>
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
                </div>
                @endforeach
            </div>

            <!-- Mobile Pagination -->
            <div class="mobile-pagination">
                <p class="mobile-pagination-info m-0">
                    {{ __('Showing') }} {{ $users->firstItem() }} - {{ $users->lastItem() }} {{ __('of') }} {{ $users->total() }}
                </p>
            </div>
            <div class="px-3 pb-3">
                {{ $users->links() }}
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
                <p>{{ __('Try adjusting your search or add a new user.') }}</p>
            </div>
            @endif
        </div>

        <!-- Desktop Footer -->
        @if($users->count() > 0)
        <div class="users-footer desktop-view">
            <p class="m-0 text-secondary">
                {{ __('Showing') }} <strong>{{ $users->firstItem() }}</strong> {{ __('to') }} <strong>{{ $users->lastItem() }}</strong> {{ __('of') }}
                <strong>{{ $users->total() }}</strong> {{ __('entries') }}
            </p>
            <ul class="pagination m-0">
                {{ $users->links() }}
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpush
