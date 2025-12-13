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
    .permissions-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .permissions-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .permissions-header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .permissions-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .permissions-icon svg {
        width: 24px;
        height: 24px;
    }

    .permissions-info h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
    }

    .permissions-info p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        margin-top: 8px;
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
        backdrop-filter: blur(10px);
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .btn-back svg {
        width: 16px;
        height: 16px;
    }

    /* Section Card */
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
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .section-header-left {
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

    .section-icon svg {
        width: 20px;
        height: 20px;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .section-subtitle {
        font-size: 0.8rem;
        color: var(--text-light);
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

    /* Permission Grid */
    .permission-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 0.75rem;
    }

    .permission-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .permission-item:hover {
        background: #f1f5f9;
        border-color: var(--primary-light);
    }

    .permission-item.selected {
        background: var(--success-light);
        border-color: var(--success);
    }

    .permission-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--success);
        cursor: pointer;
    }

    .permission-item label {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-dark);
        cursor: pointer;
        margin: 0;
        flex: 1;
    }

    /* Select All */
    .select-all-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .select-all-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .select-all-btn:hover {
        background: var(--primary-light);
    }

    .deselect-all-btn {
        background: #f1f5f9;
        color: var(--text-light);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .deselect-all-btn:hover {
        background: #e2e8f0;
        color: var(--text-dark);
    }

    /* Buttons */
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
        width: 16px;
        height: 16px;
    }

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

    .btn-cancel:hover {
        background: var(--primary-light);
        color: white;
        transform: translateY(-2px);
    }

    .btn-cancel svg {
        width: 16px;
        height: 16px;
    }

    /* Permission Count */
    .permission-count {
        font-size: 0.85rem;
        color: var(--text-light);
        padding: 6px 12px;
        background: white;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .permission-count strong {
        color: var(--success);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .permissions-header {
            padding: 1.25rem;
            flex-direction: column;
            text-align: center;
        }

        .permissions-header-content {
            flex-direction: column;
        }

        .permissions-info h1 {
            font-size: 1.25rem;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .section-body {
            padding: 1rem;
        }

        .permission-grid {
            grid-template-columns: 1fr;
        }

        .section-footer {
            flex-direction: column;
        }

        .section-footer .btn-save,
        .section-footer .btn-cancel {
            width: 100%;
            justify-content: center;
        }

        .select-all-container {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container-xl">
    @include('partials.session')

    <!-- Header Card -->
    <div class="permissions-card" style="margin-bottom: 1.5rem;">
        <div class="permissions-header">
            <div class="permissions-header-content">
                <div class="permissions-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <div class="permissions-info">
                    <h1>{{ __('Manage Permissions') }}</h1>
                    <p>{{ __('Assign permissions to role') }}</p>
                    <span class="role-badge">{{ ucfirst($role->name) }}</span>
                </div>
            </div>
            <a href="{{ route('roles.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                {{ __('Back to Roles') }}
            </a>
        </div>
    </div>

    <form action="{{ route('roles.give-permissions', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="section-card">
            <div class="section-header">
                <div class="section-header-left">
                    <div class="section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h3 class="section-title">{{ __('Available Permissions') }}</h3>
                        <p class="section-subtitle">{{ __('Select permissions for this role') }}</p>
                    </div>
                </div>
                <div class="select-all-container">
                    <button type="button" class="select-all-btn" onclick="selectAll()">Select All</button>
                    <button type="button" class="deselect-all-btn" onclick="deselectAll()">Deselect All</button>
                    <span class="permission-count"><strong id="selected-count">{{ count($rolePermissions) }}</strong> / {{ $permissions->count() }} selected</span>
                </div>
            </div>
            <div class="section-body">
                <div class="permission-grid">
                    @foreach($permissions as $permission)
                    <div class="permission-item {{ in_array($permission->id, $rolePermissions) ? 'selected' : '' }}" onclick="togglePermission(this)">
                        <input type="checkbox" 
                               name="permission[]" 
                               value="{{ $permission->name }}" 
                               id="permission_{{ $permission->id }}"
                               {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                               onchange="updateCount(); updateItemStyle(this)">
                        <label for="permission_{{ $permission->id }}">{{ ucwords(str_replace('-', ' ', $permission->name)) }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="section-footer">
                <a href="{{ route('roles.index') }}" class="btn-cancel">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="btn-save">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    {{ __('Save Permissions') }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function togglePermission(item) {
    const checkbox = item.querySelector('input[type="checkbox"]');
    checkbox.checked = !checkbox.checked;
    updateItemStyle(checkbox);
    updateCount();
}

function updateItemStyle(checkbox) {
    const item = checkbox.closest('.permission-item');
    if (checkbox.checked) {
        item.classList.add('selected');
    } else {
        item.classList.remove('selected');
    }
}

function updateCount() {
    const checked = document.querySelectorAll('.permission-item input:checked').length;
    document.getElementById('selected-count').textContent = checked;
}

function selectAll() {
    document.querySelectorAll('.permission-item input').forEach(checkbox => {
        checkbox.checked = true;
        updateItemStyle(checkbox);
    });
    updateCount();
}

function deselectAll() {
    document.querySelectorAll('.permission-item input').forEach(checkbox => {
        checkbox.checked = false;
        updateItemStyle(checkbox);
    });
    updateCount();
}
</script>
@endsection
