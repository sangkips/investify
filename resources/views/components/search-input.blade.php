@props(['placeholder' => 'Search...', 'model' => 'search'])

<div class="search-input-wrapper">
    <svg class="search-input-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
    </svg>
    <input 
        type="text" 
        wire:model.live.debounce.300ms="{{ $model }}" 
        class="search-input-field" 
        placeholder="{{ $placeholder }}"
        aria-label="{{ $placeholder }}"
    >
    <button type="button" wire:click="$set('{{ $model }}', '')" class="search-input-clear" title="Clear search">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>

<style>
    .search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 400px;
    }

    .search-input-icon {
        position: absolute;
        left: 16px;
        color: #94a3b8;
        pointer-events: none;
    }

    .search-input-field {
        width: 100%;
        padding: 12px 44px 12px 48px;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.95rem;
        color: #334155;
        background: #f8fafc;
        transition: all 0.2s ease;
        outline: none;
    }

    .search-input-field::placeholder {
        color: #94a3b8;
    }

    .search-input-field:focus {
        border-color: #1e1b4b;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    .search-input-clear {
        position: absolute;
        right: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border: none;
        background: #e2e8f0;
        border-radius: 50%;
        cursor: pointer;
        color: #64748b;
        transition: all 0.2s ease;
    }

    .search-input-clear:hover {
        background: #cbd5e1;
        color: #334155;
    }
</style>
