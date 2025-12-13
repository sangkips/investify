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
    .roles-page {
        min-height: 100vh;
        padding-bottom: 2rem;
    }

    /* Header Card */
    .roles-header-card {
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

    .roles-header-card h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .roles-header-card p {
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

    /* Success Alert */
    .success-alert {
        background: var(--success-light);
        color: #166534;
        border: none;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
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

    .user-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    .user-email {
        color: var(--text-light);
        font-size: 0.85rem;
    }

    /* Role Badge */
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
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
    .action-btns {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-assign {
        background: var(--primary);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-assign:hover {
        background: var(--primary-light);
        color: white;
    }

    .btn-remove {
        background: var(--danger-light);
        color: #dc2626;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-remove:hover {
        background: #fecaca;
    }

    /* Role Description Cards */
    .role-desc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .role-desc-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.25rem;
        border: 1px solid #e2e8f0;
    }

    .role-desc-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .role-desc-card p {
        font-size: 0.85rem;
        color: var(--text-light);
        margin: 0;
        line-height: 1.5;
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .user-card-item:last-child {
        margin-bottom: 0;
    }

    .user-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }

    .user-card-info h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 4px;
    }

    .user-card-info p {
        font-size: 0.85rem;
        color: var(--text-light);
        margin: 0;
    }

    .user-card-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        padding-top: 0.75rem;
        border-top: 1px solid #f1f5f9;
    }

    /* Footer */
    .pagination-wrapper {
        padding: 1rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        gap: 0.75rem;
    }

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

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .desktop-view {
            display: none;
        }

        .mobile-view {
            display: block;
        }

        .roles-header-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
            border-radius: 12px;
        }

        .roles-header-card h1 {
            justify-content: center;
            font-size: 1.25rem;
        }

        .modern-card-body {
            padding: 1rem;
        }

        .role-desc-grid {
            grid-template-columns: 1fr;
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

<div class="roles-page">
    <div class="container-xl">
        <!-- Success Message -->
        @if(session('success'))
        <div class="success-alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Header -->
        <div class="roles-header-card">
            <div>
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    {{ __('User Roles') }}
                </h1>
                <p>{{ __('Manage user roles and permissions') }}</p>
            </div>
        </div>

        <!-- Users Table Card -->
        <div class="modern-card">
            <div class="modern-card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <h3>{{ __('Users and Their Roles') }}</h3>
            </div>

            <!-- Desktop Table View -->
            <div class="desktop-view table-responsive">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Role') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="user-name">{{ $user->name }}</div>
                                <div class="user-email">{{ $user->email }}</div>
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
                            <td>
                                <div class="action-btns">
                                    <div class="dropdown">
                                        <button type="button" class="btn-assign dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ __('Assign Role') }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach($roles as $role)
                                            <li>
                                                <form action="{{ route('users.assign-role', $user) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="role" value="{{ $role->name }}">
                                                    <button type="submit" class="dropdown-item">{{ ucfirst($role->name) }}</button>
                                                </form>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if($user->roles->count() > 0)
                                    <form action="{{ route('users.remove-role', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove" onclick="return confirm('Are you sure you want to remove this role?')">
                                            {{ __('Remove') }}
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="mobile-view">
                <div class="modern-card-body">
                    @foreach($users as $user)
                    <div class="user-card-item">
                        <div class="user-card-header">
                            <div class="user-card-info">
                                <h4>{{ $user->name }}</h4>
                                <p>{{ $user->email }}</p>
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
                        <div class="user-card-actions">
                            <div class="dropdown">
                                <button type="button" class="btn-assign dropdown-toggle" data-bs-toggle="dropdown">
                                    {{ __('Assign Role') }}
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($roles as $role)
                                    <li>
                                        <form action="{{ route('users.assign-role', $user) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="role" value="{{ $role->name }}">
                                            <button type="submit" class="dropdown-item">{{ ucfirst($role->name) }}</button>
                                        </form>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @if($user->roles->count() > 0)
                            <form action="{{ route('users.remove-role', $user) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove" onclick="return confirm('Are you sure you want to remove this role?')">
                                    {{ __('Remove') }}
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $users->links() }}
            </div>
        </div>

        <!-- Role Descriptions Card -->
        <div class="modern-card">
            <div class="modern-card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <h3>{{ __('Role Descriptions') }}</h3>
            </div>
            <div class="modern-card-body">
                <div class="role-desc-grid">
                    <div class="role-desc-card">
                        <h4>
                            <span class="role-badge admin" style="padding: 4px 10px; font-size: 0.7rem;">Admin</span>
                        </h4>
                        <p>{{ __('Full access to all features including user management.') }}</p>
                    </div>
                    <div class="role-desc-card">
                        <h4>
                            <span class="role-badge manager" style="padding: 4px 10px; font-size: 0.7rem;">Manager</span>
                        </h4>
                        <p>{{ __('Can manage products, orders, purchases, quotations, customers, suppliers, and view reports.') }}</p>
                    </div>
                    <div class="role-desc-card">
                        <h4>
                            <span class="role-badge sales" style="padding: 4px 10px; font-size: 0.7rem;">Sales</span>
                        </h4>
                        <p>{{ __('Can manage orders, quotations, and customers. Has access to dashboard.') }}</p>
                    </div>
                    <div class="role-desc-card">
                        <h4>
                            <span class="role-badge inventory" style="padding: 4px 10px; font-size: 0.7rem;">Inventory</span>
                        </h4>
                        <p>{{ __('Can manage products, purchases, suppliers, categories, and units. Has access to dashboard.') }}</p>
                    </div>
                    <div class="role-desc-card">
                        <h4>
                            <span class="role-badge viewer" style="padding: 4px 10px; font-size: 0.7rem;">Viewer</span>
                        </h4>
                        <p>{{ __('Read-only access to dashboard and reports.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection