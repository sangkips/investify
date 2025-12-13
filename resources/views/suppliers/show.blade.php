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
    .supplier-view-page {
        min-height: 100vh;
        padding-bottom: 2rem;
    }

    /* Header Card */
    .supplier-header-card {
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

    .supplier-header-card h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .supplier-header-card p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin: 4px 0 0;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    /* Type Badge */
    .type-badge-header {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.05em;
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

    /* Profile Section */
    .profile-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 2rem 1rem;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #e0e7ff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .profile-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 0.5rem;
    }

    .profile-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        background: #e0e7ff;
        color: var(--primary);
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-label svg {
        width: 14px;
        height: 14px;
        opacity: 0.6;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-dark);
    }

    .info-value.empty {
        color: var(--text-light);
        font-style: italic;
    }

    /* Mobile View */
    .mobile-info-cards {
        display: none;
    }

    .mobile-info-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .mobile-info-card:last-child {
        margin-bottom: 0;
    }

    .mobile-info-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .mobile-info-icon svg {
        width: 20px;
        height: 20px;
        color: var(--primary);
    }

    .mobile-info-content {
        flex: 1;
        min-width: 0;
    }

    .mobile-info-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }

    .mobile-info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
        word-break: break-word;
    }

    .mobile-info-value.empty {
        color: var(--text-light);
        font-style: italic;
        font-weight: 400;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 1rem;
    }

    .btn-edit {
        background: var(--accent);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-edit:hover {
        background: var(--accent-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    .btn-delete {
        background: var(--danger);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .supplier-view-page {
            padding-bottom: 100px;
        }

        .supplier-header-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
            border-radius: 12px;
        }

        .supplier-header-card h1 {
            justify-content: center;
            font-size: 1.25rem;
        }

        .supplier-header-card h1 svg {
            width: 24px;
            height: 24px;
        }

        .header-actions {
            justify-content: center;
            width: 100%;
        }

        .btn-back {
            padding: 8px 16px;
            font-size: 0.8rem;
        }

        .modern-card-body {
            padding: 1rem;
        }

        .info-grid {
            display: none;
        }

        .mobile-info-cards {
            display: block;
        }

        .profile-section {
            padding: 1.5rem 1rem;
        }

        .profile-image {
            width: 100px;
            height: 100px;
        }

        .profile-name {
            font-size: 1.1rem;
        }

        /* Fixed Action Buttons on Mobile */
        .action-buttons {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 1rem;
            margin: 0;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            z-index: 100;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-edit, .btn-delete {
            flex: 1;
            justify-content: center;
            padding: 12px 16px;
            font-size: 0.875rem;
        }
    }

    @media (min-width: 769px) {
        .mobile-info-cards {
            display: none !important;
        }

        .info-grid {
            display: grid !important;
        }
    }
</style>

<div class="supplier-view-page">
    <div class="container-xl">
        <!-- Error/Success Messages -->
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible mb-4" role="alert" style="border-radius: 12px; border: none; background: #fee2e2; color: #991b1b;">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert" style="border-radius: 12px; border: none; background: #dcfce7; color: #166534;">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Header -->
        <div class="supplier-header-card">
            <div>
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    {{ $supplier->name }}
                </h1>
                <p>{{ __('Supplier Details') }}</p>
            </div>
            <div class="header-actions">
                <span class="type-badge-header">{{ $supplier->type->label() }}</span>
                <a href="{{ route('suppliers.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    {{ __('Back') }}
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Profile Card -->
            <div class="col-lg-4">
                <div class="modern-card">
                    <div class="profile-section">
                        <img src="{{ $supplier->photo ? asset('storage/' . $supplier->photo) : asset('assets/img/demo/user-placeholder.svg') }}" alt="{{ $supplier->name }}" class="profile-image">
                        <h2 class="profile-name">{{ $supplier->name }}</h2>
                        <span class="profile-type">{{ $supplier->type->label() }}</span>
                    </div>
                </div>
            </div>

            <!-- Details Card -->
            <div class="col-lg-8">
                <!-- Contact Information -->
                <div class="modern-card">
                    <div class="modern-card-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <h3>{{ __('Contact Information') }}</h3>
                    </div>
                    <div class="modern-card-body">
                        <!-- Desktop Grid -->
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    Email Address
                                </span>
                                <span class="info-value {{ !$supplier->email ? 'empty' : '' }}">{{ $supplier->email ?: 'Not provided' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                    Phone Number
                                </span>
                                <span class="info-value {{ !$supplier->phone ? 'empty' : '' }}">{{ $supplier->phone ?: 'Not provided' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    Address
                                </span>
                                <span class="info-value {{ !$supplier->address ? 'empty' : '' }}">{{ $supplier->address ?: 'Not provided' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    Shop Name
                                </span>
                                <span class="info-value {{ !$supplier->shopname ? 'empty' : '' }}">{{ $supplier->shopname ?: 'Not provided' }}</span>
                            </div>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="mobile-info-cards">
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">Email Address</div>
                                    <div class="mobile-info-value {{ !$supplier->email ? 'empty' : '' }}">{{ $supplier->email ?: 'Not provided' }}</div>
                                </div>
                            </div>
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">Phone Number</div>
                                    <div class="mobile-info-value {{ !$supplier->phone ? 'empty' : '' }}">{{ $supplier->phone ?: 'Not provided' }}</div>
                                </div>
                            </div>
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">Address</div>
                                    <div class="mobile-info-value {{ !$supplier->address ? 'empty' : '' }}">{{ $supplier->address ?: 'Not provided' }}</div>
                                </div>
                            </div>
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">Shop Name</div>
                                    <div class="mobile-info-value {{ !$supplier->shopname ? 'empty' : '' }}">{{ $supplier->shopname ?: 'Not provided' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Information -->
                <div class="modern-card">
                    <div class="modern-card-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        <h3>{{ __('Business Information') }}</h3>
                    </div>
                    <div class="modern-card-body">
                        <!-- Desktop Grid -->
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                    KRA PIN
                                </span>
                                <span class="info-value {{ !$supplier->kra_pin ? 'empty' : '' }}">{{ $supplier->kra_pin ?: 'Not provided' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                    Supplier Type
                                </span>
                                <span class="info-value">{{ $supplier->type->label() }}</span>
                            </div>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="mobile-info-cards">
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">KRA PIN</div>
                                    <div class="mobile-info-value {{ !$supplier->kra_pin ? 'empty' : '' }}">{{ $supplier->kra_pin ?: 'Not provided' }}</div>
                                </div>
                            </div>
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">Supplier Type</div>
                                    <div class="mobile-info-value">{{ $supplier->type->label() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Banking Information -->
                <div class="modern-card">
                    <div class="modern-card-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <h3>{{ __('Banking Information') }}</h3>
                    </div>
                    <div class="modern-card-body">
                        <!-- Desktop Grid -->
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    Account Holder
                                </span>
                                <span class="info-value {{ !$supplier->account_holder ? 'empty' : '' }}">{{ $supplier->account_holder ?: 'Not provided' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                    Account Number
                                </span>
                                <span class="info-value {{ !$supplier->account_number ? 'empty' : '' }}">{{ $supplier->account_number ?: 'Not provided' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"></path><path d="M3 10h18"></path><path d="M5 6l7-3 7 3"></path><path d="M4 10v11"></path><path d="M20 10v11"></path><path d="M8 14v3"></path><path d="M12 14v3"></path><path d="M16 14v3"></path></svg>
                                    Bank Name
                                </span>
                                <span class="info-value {{ !$supplier->bank_name ? 'empty' : '' }}">{{ $supplier->bank_name ?: 'Not provided' }}</span>
                            </div>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="mobile-info-cards">
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">Account Holder</div>
                                    <div class="mobile-info-value {{ !$supplier->account_holder ? 'empty' : '' }}">{{ $supplier->account_holder ?: 'Not provided' }}</div>
                                </div>
                            </div>
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">Account Number</div>
                                    <div class="mobile-info-value {{ !$supplier->account_number ? 'empty' : '' }}">{{ $supplier->account_number ?: 'Not provided' }}</div>
                                </div>
                            </div>
                            <div class="mobile-info-card">
                                <div class="mobile-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"></path><path d="M3 10h18"></path><path d="M5 6l7-3 7 3"></path><path d="M4 10v11"></path><path d="M20 10v11"></path><path d="M8 14v3"></path><path d="M12 14v3"></path><path d="M16 14v3"></path></svg>
                                </div>
                                <div class="mobile-info-content">
                                    <div class="mobile-info-label">Bank Name</div>
                                    <div class="mobile-info-value {{ !$supplier->bank_name ? 'empty' : '' }}">{{ $supplier->bank_name ?: 'Not provided' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            @can('manage-suppliers')
            <a href="{{ route('suppliers.edit', $supplier->uuid) }}" class="btn-edit">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                {{ __('Edit Supplier') }}
            </a>
            <form action="{{ route('suppliers.destroy', $supplier->uuid) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete supplier {{ $supplier->name }}? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    {{ __('Delete Supplier') }}
                </button>
            </form>
            @endcan
        </div>
    </div>
</div>
@endsection