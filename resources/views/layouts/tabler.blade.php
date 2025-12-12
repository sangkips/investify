<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .form-control:focus {
            box-shadow: none;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid #e6e7e9;
            transition: all 0.3s ease;
            z-index: 1030;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .sidebar-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar.collapsed .dropdown-icon {
            display: none;
        }

        .sidebar.collapsed .sidebar-submenu {
            display: none !important;
        }

        .sidebar.collapsed .sidebar-user-info {
            display: none;
        }

        .sidebar-header {
            padding: 1rem;
            display: flex;
            justify-content: flex-end;
            border-bottom: 1px solid #e6e7e9;
        }

        .sidebar-collapse-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .sidebar-collapse-btn:hover {
            background: #f1f3f5;
        }

        .sidebar.collapsed .sidebar-collapse-btn svg {
            transform: rotate(180deg);
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1rem 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-item {
            margin: 0.25rem 0.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #626976;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s;
            position: relative;
            white-space: nowrap;
        }

        .sidebar-link:hover {
            background: #f1f3f5;
            color: #1e293b;
        }

        .sidebar-item.active .sidebar-link {
            background: #1e1b4b;
            color: #ffffff;
        }

        .sidebar-link .icon {
            min-width: 24px;
            margin-right: 0.75rem;
        }

        .sidebar-link .dropdown-icon {
            margin-left: auto;
            transition: transform 0.2s;
        }

        .sidebar-link[aria-expanded="true"] .dropdown-icon {
            transform: rotate(180deg);
        }

        .sidebar-submenu {
            list-style: none;
            padding: 0;
            margin: 0.5rem 0 0 0;
        }

        .sidebar-submenu li {
            margin: 0;
        }

        .sidebar-submenu a {
            display: block;
            padding: 0.5rem 1rem 0.5rem 3.5rem;
            color: #626976;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 0.875rem;
        }

        .sidebar-submenu a:hover {
            background: #f1f3f5;
            color: #1e293b;
        }

        .sidebar-footer {
            border-top: 1px solid #e6e7e9;
            padding: 1rem;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .sidebar-user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-user-info {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0.5rem 1rem;
            background: none;
            border: 1px solid #e6e7e9;
            border-radius: 6px;
            color: #626976;
            cursor: pointer;
            transition: all 0.2s;
        }

        .sidebar-logout-btn:hover {
            background: #f1f3f5;
            border-color: #d0d4d9;
        }

        .sidebar-logout-btn .icon {
            margin-right: 0.5rem;
        }

        /* Page Layout Adjustments */
        .page-wrapper.with-sidebar {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed ~ .page-wrapper.with-sidebar,
        .sidebar.collapsed ~ header {
            margin-left: var(--sidebar-collapsed-width);
        }

        .navbar {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            position: sticky;
            top: 0;
            z-index: 1020;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .sidebar.collapsed ~ .navbar {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Mobile Sidebar Toggle */
        .sidebar-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1031;
            background: #ffffff;
            border: 1px solid #e6e7e9;
            border-radius: 6px;
            padding: 0.5rem;
            cursor: pointer;
        }

        /* Mobile Responsive */
        @media (max-width: 767px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .page-wrapper.with-sidebar,
            .navbar {
                margin-left: 0 !important;
            }

            /* Add padding for hamburger menu */
            .navbar .container-fluid {
                padding-left: 60px;
            }

            .navbar .navbar-brand {
                margin-left: 0;
            }
        }

        @media (min-width: 768px) {
            .sidebar-toggle {
                display: none;
            }
        }

    </style>

    {{-- - Page Styles - --}}
    @stack('page-styles')
    @livewireStyles
</head>

<body>
    <script>
        // Force light theme - remove any dark theme settings
        localStorage.removeItem('tablerTheme');
        document.body.removeAttribute('data-bs-theme');
    </script>

    <div class="page">
        <!-- Sidebar Toggle Button (Mobile) -->
        <button class="sidebar-toggle d-md-none" id="sidebarToggle" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="4" y1="6" x2="20" y2="6"/>
                <line x1="4" y1="12" x2="20" y2="12"/>
                <line x1="4" y1="18" x2="20" y2="18"/>
            </svg>
        </button>

        <!-- Left Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <button class="sidebar-collapse-btn" id="sidebarCollapseBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <polyline points="15 6 9 12 15 18"/>
                    </svg>
                </button>
            </div>
            
            <nav class="sidebar-nav">
                <ul class="sidebar-menu">
                    @can('view-dashboard')
                    <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                            <span class="sidebar-text">{{ __('Home') }}</span>
                        </a>
                    </li>
                    @endcan

                    @can('manage-products')
                    <li class="sidebar-item {{ request()->is('products*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('products.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                <path d="M2 13.5v5.5l5 3" />
                                <path d="M7 16.545l5 -3.03" />
                                <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                <path d="M12 19l5 3" />
                                <path d="M17 16.5l5 -3" />
                                <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                <path d="M7 5.03v5.455" />
                                <path d="M12 8l5 -3" />
                            </svg>
                            <span class="sidebar-text">{{ __('Products') }}</span>
                        </a>
                    </li>
                    @endcan

                    @canany(['manage-orders', 'view-reports'])
                    <li class="sidebar-item {{ request()->is('orders*') ? 'active' : '' }}">
                        <a class="sidebar-link has-dropdown" href="#" data-bs-toggle="collapse" data-bs-target="#ordersMenu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package-export" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12v9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M15 18h7" />
                                <path d="M19 15l3 3l-3 3" />
                            </svg>
                            <span class="sidebar-text">{{ __('Orders') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </a>
                        <ul class="sidebar-submenu collapse" id="ordersMenu">
                            @can('manage-orders')
                            <li><a href="{{ route('orders.index') }}">{{ __('All') }}</a></li>
                            <li><a href="{{ route('orders.complete') }}">{{ __('Completed') }}</a></li>
                            <li><a href="{{ route('orders.pending') }}">{{ __('Pending') }}</a></li>
                            <li><a href="{{ route('due.index') }}">{{ __('Due') }}</a></li>
                            @endcan
                            @can('view-reports')
                            <li><a href="{{ route('orders.salesReport') }}">{{ __('Daily Sales Report') }}</a></li>
                            <li><a href="{{ route('orders.exportSalesReportAsPDF') }}">{{ __('Monthly Breakdown Report') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    @canany(['manage-purchases', 'view-reports'])
                    <li class="sidebar-item {{ request()->is('purchases*') ? 'active' : '' }}">
                        <a class="sidebar-link has-dropdown" href="#" data-bs-toggle="collapse" data-bs-target="#purchasesMenu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12v9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M22 18h-7" />
                                <path d="M18 15l-3 3l3 3" />
                            </svg>
                            <span class="sidebar-text">{{ __('Purchases') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </a>
                        <ul class="sidebar-submenu collapse" id="purchasesMenu">
                            @can('manage-purchases')
                            <li><a href="{{ route('purchases.index') }}">{{ __('All') }}</a></li>
                            <!-- <li><a href="{{ route('purchases.approvedPurchases') }}">{{ __('Approval') }}</a></li> -->
                            @endcan
                            @can('view-reports')
                            <li><a href="{{ route('purchases.purchaseReport') }}">{{ __('Daily Purchase Report') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    @can('manage-quotations')
                    <li class="sidebar-item {{ request()->is('quotations*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('quotations.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            </svg>
                            <span class="sidebar-text">{{ __('Quotations') }}</span>
                        </a>
                    </li>
                    @endcan

                    @canany(['manage-suppliers', 'manage-customers', 'manage-categories', 'manage-units'])
                    <li class="sidebar-item {{ request()->is('suppliers*', 'customers*', 'categories*', 'units*') ? 'active' : '' }}">
                        <a class="sidebar-link has-dropdown" href="#" data-bs-toggle="collapse" data-bs-target="#pagesMenu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layers-subtract" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                            </svg>
                            <span class="sidebar-text">{{ __('Pages') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </a>
                        <ul class="sidebar-submenu collapse" id="pagesMenu">
                            @can('manage-suppliers')
                            <li><a href="{{ route('suppliers.index') }}">{{ __('Suppliers') }}</a></li>
                            @endcan
                            @can('manage-customers')
                            <li><a href="{{ route('customers.index') }}">{{ __('Customers') }}</a></li>
                            @endcan
                            @can('manage-categories')
                            <li><a href="{{ route('categories.index') }}">{{ __('Categories') }}</a></li>
                            @endcan
                            @can('manage-units')
                            <li><a href="{{ route('units.index') }}">{{ __('Units') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    @can('manage-users')
                    <li class="sidebar-item {{ request()->is('users*', 'roles*', 'permissions*', 'user-roles*') ? 'active' : '' }}">
                        <a class="sidebar-link has-dropdown" href="#" data-bs-toggle="collapse" data-bs-target="#managementMenu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                            </svg>
                            <span class="sidebar-text">{{ __('Management') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </a>
                        <ul class="sidebar-submenu collapse" id="managementMenu">
                            <li><a href="{{ route('users.roles') }}">{{ __('User Roles') }}</a></li>
                            <li><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a></li>
                            <li><a href="{{ route('permissions.index') }}">{{ __('Permissions') }}</a></li>
                            <li><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="sidebar-user-avatar">
                        <img src="{{ Auth::user()->photo ? asset('storage/profile/' . Auth::user()->photo) : asset('assets/img/illustrations/profiles/admin.jpg') }}" alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                    </div>
                </div>
                <div class="sidebar-logout">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="sidebar-logout-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M9 12h12l-3 -3" />
                                <path d="M18 15l3 -3" />
                            </svg>
                            <span class="sidebar-text">{{ __('Logout') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Top Navbar -->
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" height="40" style="max-height: 40px;">
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="page-wrapper with-sidebar">
            <div>
                @yield('content')
            </div>

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="flex">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ now()->year }}
                                    All rights reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Libs JS -->
    @stack('page-libraries')
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    {{-- - Page Scripts - --}}
    @stack('page-scripts')

    <!-- Sidebar JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            // Load sidebar state from localStorage
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebarCollapsed) {
                sidebar.classList.add('collapsed');
            }
            
            // Sidebar collapse toggle (desktop)
            if (sidebarCollapseBtn) {
                sidebarCollapseBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                });
            }
            
            // Sidebar toggle (mobile)
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768) {
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });
            
            // ===== Auto-dismiss alerts after 5 seconds =====
            const autoDismissAlerts = function() {
                document.querySelectorAll('.alert:not(.alert-permanent)').forEach(function(alert) {
                    // Skip if already processed
                    if (alert.dataset.autoDismissProcessed) return;
                    alert.dataset.autoDismissProcessed = 'true';
                    
                    // Add transition styles
                    alert.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                    
                    // Auto dismiss after 5 seconds
                    setTimeout(function() {
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateY(-10px)';
                        
                        // Remove element after fade animation
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    }, 5000);
                });
            };
            
            // Run on page load
            autoDismissAlerts();
            
            // Also run when Livewire updates the DOM (for Livewire components)
            if (typeof Livewire !== 'undefined') {
                Livewire.hook('message.processed', function() {
                    autoDismissAlerts();
                });
            }
        });
    </script>

    @livewireScripts
</body>

</html>