@extends('layouts.tabler')

@section('content')
<style>
    /* Variables matching landing page */
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --accent-hover: #ea580c;
        --danger: #ef4444;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
    }

    .create-permission-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .create-permission-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .create-permission-header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .create-permission-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .create-permission-icon svg { width: 24px; height: 24px; }

    .create-permission-info h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
    }

    .create-permission-info p {
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
    }

    .btn-back:hover { background: rgba(255, 255, 255, 0.3); color: white; }
    .btn-back svg { width: 16px; height: 16px; }

    .section-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
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

    .section-icon svg { width: 20px; height: 20px; }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .section-body { padding: 1.5rem; }

    .section-footer {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .form-group label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

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
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .btn-save:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
    }

    .btn-save svg { width: 16px; height: 16px; }

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

    .btn-cancel:hover { background: var(--primary-light); color: white; }
    .btn-cancel svg { width: 16px; height: 16px; }

    @media (max-width: 768px) {
        .create-permission-header { padding: 1.25rem; flex-direction: column; text-align: center; }
        .create-permission-header-content { flex-direction: column; }
        .section-footer { flex-direction: column; }
        .section-footer .btn-save, .section-footer .btn-cancel { width: 100%; justify-content: center; }
    }
</style>

<div class="container-xl">
    @include('partials.session')

    @if ($errors->any())
    <div style="background: #fee2e2; border: 1px solid #fecaca; border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
        <ul style="margin: 0; padding-left: 1.25rem;">
            @foreach ($errors->all() as $error)
            <li style="color: var(--danger); font-size: 0.9rem;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="create-permission-card" style="margin-bottom: 1.5rem;">
        <div class="create-permission-header">
            <div class="create-permission-header-content">
                <div class="create-permission-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <div class="create-permission-info">
                    <h1>{{ __('Create Permission') }}</h1>
                    <p>{{ __('Add a new permission to the system') }}</p>
                </div>
            </div>
            <a href="{{ route('permissions.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                {{ __('Back') }}
            </a>
        </div>
    </div>

    <form action="{{ url('permissions') }}" method="POST">
        @csrf
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <h3 class="section-title">{{ __('Permission Details') }}</h3>
            </div>
            <div class="section-body">
                <div class="form-group">
                    <label for="name">{{ __('Permission Name') }} <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="{{ __('e.g., view-reports, manage-users') }}">
                </div>
            </div>
            <div class="section-footer">
                <a href="{{ route('permissions.index') }}" class="btn-cancel">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="btn-save">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    {{ __('Create Permission') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection