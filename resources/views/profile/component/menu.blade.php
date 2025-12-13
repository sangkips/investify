{{-- This component is now deprecated - tabs are built into individual profile pages for better control --}}
{{-- Keeping for backwards compatibility if needed elsewhere --}}
<nav class="profile-nav">
    <a class="profile-nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
        </svg>
        {{ __('Profile') }}
    </a>
    <a class="profile-nav-link {{ request()->routeIs('profile.settings') ? 'active' : '' }}" href="{{ route('profile.settings') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
        {{ __('Security') }}
    </a>
    <a class="profile-nav-link {{ request()->routeIs('profile.store.settings') ? 'active' : '' }}" href="{{ route('profile.store.settings') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        {{ __('Store') }}
    </a>
</nav>
<style>
    .profile-nav {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .profile-nav-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        color: #64748b;
        text-decoration: none;
        background: #f1f5f9;
        transition: all 0.2s;
    }
    .profile-nav-link:hover {
        background: #e2e8f0;
        color: #1e1b4b;
    }
    .profile-nav-link.active {
        background: #1e1b4b;
        color: white;
    }
    .profile-nav-link svg {
        opacity: 0.8;
    }
</style>