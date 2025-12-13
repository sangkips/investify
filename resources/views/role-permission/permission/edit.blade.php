@extends('layouts.tabler')

@section('content')
<style>
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
        --accent-hover: #ea580c;
        --danger: #ef4444;
        --text-dark: #1e1b4b;
        --text-light: #64748b;
    }

    .edit-permission-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .edit-permission-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .edit-permission-header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .edit-permission-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .edit-permission-icon svg { width: 24px; height: 24px; }

    .edit-permission-info h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
    }

    .edit-permission-info p {
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
        .edit-permission-header { padding: 1.25rem; flex-direction: column; text-align: center; }
        .edit-permission-header-content { flex-direction: column; }
        .section-footer { flex-direction: column; }
        .section-footer .btn-save, .section-footer .btn-cancel { width: 100%; justify-content: center; }
    }
</style>

<div class="container-xl">
    @include('partials.session')

    <div class="edit-permission-card" style="margin-bottom: 1.5rem;">
        <div class="edit-permission-header">
            <div class="edit-permission-header-content">
                <div class="edit-permission-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <div class="edit-permission-info">
                    <h1>{{ __('Edit Permission') }}</h1>
                    <p>{{ ucwords(str_replace('-', ' ', $permission->name)) }}</p>
                </div>
            </div>
            <a href="{{ route('permissions.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                {{ __('Back') }}
            </a>
        </div>
    </div>

    <form action="{{ route('permissions.update', $permission) }}" method="POST">
        @csrf
        @method('put')
        <div class="section-card">
            <div class="section-header">
                <div class="section-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </div>
                <h3 class="section-title">{{ __('Permission Details') }}</h3>
            </div>
            <div class="section-body">
                <div class="form-group">
                    <label for="name">{{ __('Permission Name') }} <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $permission->name) }}" required>
                </div>
            </div>
            <div class="section-footer">
                <a href="{{ route('permissions.index') }}" class="btn-cancel">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="btn-save">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    {{ __('Update Permission') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection