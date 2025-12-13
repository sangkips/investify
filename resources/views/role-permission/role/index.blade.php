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
    .roles-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .roles-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .roles-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .roles-header-content p {
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

    .roles-table {
        width: 100%;
        border-collapse: collapse;
    }

    .roles-table thead {
        background: #f8fafc;
    }

    .roles-table th {
        padding: 1rem 1.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
    }

    .roles-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .roles-table tbody tr:hover {
        background: #fafbfc;
    }

    .roles-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Role Name Badge */
    .role-name-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .role-name-badge.super-admin {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
    }

    .role-name-badge.admin {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .role-name-badge.default {
        background: #e0e7ff;
        color: var(--primary);
    }

    .role-name-badge svg {
        width: 16px;
        height: 16px;
    }

    /* Action Buttons */
    .action-btn {
        padding: 8px 14px;
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

    .action-btn.permissions {
        background: var(--success-light);
        color: #166534;
    }

    .action-btn.permissions:hover {
        background: #bbf7d0;
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

    /* Footer */
    .roles-footer {
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .roles-footer .text-secondary {
        font-size: 0.875rem;
        color: var(--text-light);
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

    .role-card-item {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .role-card-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .role-card-item:last-child {
        margin-bottom: 0;
    }

    .role-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .role-card-actions {
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

        .roles-header {
            padding: 1rem;
        }

        .roles-header-content h1 {
            font-size: 1.25rem;
        }

        .btn-create {
            padding: 10px 20px;
            font-size: 0.85rem;
        }

        .roles-footer {
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
    @if (session('success'))
    <div class="alert alert-success alert-dismissible mb-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="roles-card">
        <!-- Header -->
        <div class="roles-header">
            <div class="roles-header-content">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    {{ __('Roles') }}
                </h1>
                <p>{{ $roles->total() }} {{ __('total roles') }}</p>
            </div>
            @can('create-role')
            <a href="{{ route('roles.create') }}" class="btn-create">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                {{ __('Add Role') }}
            </a>
            @endcan
        </div>

        <!-- Desktop Table View -->
        <div class="desktop-view">
            @if($roles->count() > 0)
            <table class="roles-table">
                <thead>
                    <tr>
                        <th>{{ __('Role Name') }}</th>
                        <th>{{ __('Permissions') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>
                            @php
                                $roleName = strtolower($role->name);
                                $roleClass = match(true) {
                                    str_contains($roleName, 'super-admin') => 'super-admin',
                                    str_contains($roleName, 'admin') => 'admin',
                                    default => 'default'
                                };
                            @endphp
                            <span class="role-name-badge {{ $roleClass }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                                {{ ucfirst($role->name) }}
                            </span>
                        </td>
                        <td>
                            <span style="color: var(--text-light); font-size: 0.85rem;">
                                {{ $role->permissions->count() }} {{ __('permissions') }}
                            </span>
                        </td>
                        <td>
                            @if ($role->name != 'super-admin')
                            <div style="display: flex; gap: 6px;">
                                <a href="{{ route('roles.add-permissions', $role) }}" class="action-btn permissions">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    </svg>
                                    Permissions
                                </a>
                                @can('update-role')
                                <a href="{{ route('roles.edit', $role) }}" class="action-btn edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>
                                @endcan
                                @can('delete-role')
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                                @endcan
                            </div>
                            @else
                            <span style="color: var(--text-light); font-size: 0.85rem; font-style: italic;">{{ __('Protected role') }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3>{{ __('No roles found') }}</h3>
                <p>{{ __('Add your first role to get started.') }}</p>
            </div>
            @endif
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-view">
            @if($roles->count() > 0)
            <div class="mobile-cards-container">
                @foreach ($roles as $role)
                <div class="role-card-item">
                    <div class="role-card-header">
                        @php
                            $roleName = strtolower($role->name);
                            $roleClass = match(true) {
                                str_contains($roleName, 'super-admin') => 'super-admin',
                                str_contains($roleName, 'admin') => 'admin',
                                default => 'default'
                            };
                        @endphp
                        <span class="role-name-badge {{ $roleClass }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                            {{ ucfirst($role->name) }}
                        </span>
                        <span style="color: var(--text-light); font-size: 0.8rem;">
                            {{ $role->permissions->count() }} {{ __('permissions') }}
                        </span>
                    </div>
                    @if ($role->name != 'super-admin')
                    <div class="role-card-actions">
                        <a href="{{ route('roles.add-permissions', $role) }}" class="action-btn permissions">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                        </a>
                        @can('update-role')
                        <a href="{{ route('roles.edit', $role) }}" class="action-btn edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                        @endcan
                        @can('delete-role')
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </form>
                        @endcan
                    </div>
                    @else
                    <span style="color: var(--text-light); font-size: 0.8rem; font-style: italic;">{{ __('Protected role') }}</span>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3>{{ __('No roles found') }}</h3>
                <p>{{ __('Add your first role to get started.') }}</p>
            </div>
            @endif
        </div>

        <!-- Footer -->
        @if($roles->count() > 0)
        <div class="roles-footer desktop-view">
            {{ $roles->links() }}
        </div>
        @endif
    </div>
</div>
@endsection