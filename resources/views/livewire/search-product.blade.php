<div>
<style>
    /* Product Search Styling */
    .product-search-container {
        position: relative;
    }

    .product-search-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.75rem;
    }

    .product-search-label svg {
        width: 16px;
        height: 16px;
        color: #4338ca;
    }

    .product-search-wrapper {
        position: relative;
    }

    .product-search-input {
        width: 100%;
        padding: 14px 48px 14px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        color: #1e1b4b;
        background: white;
        transition: all 0.2s;
        cursor: pointer;
    }

    .product-search-input:hover {
        border-color: #cbd5e1;
    }

    .product-search-input:focus {
        outline: none;
        border-color: #4338ca;
        box-shadow: 0 0 0 4px rgba(67, 56, 202, 0.1);
    }

    .product-search-icon {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        color: #94a3b8;
        pointer-events: none;
        transition: transform 0.2s;
    }

    .product-search-wrapper.open .product-search-icon {
        transform: translateY(-50%) rotate(180deg);
    }

    /* Dropdown */
    .product-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        margin-top: 4px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        max-height: 320px;
        overflow-y: auto;
        display: none;
    }

    .product-dropdown.show {
        display: block;
    }

    .product-dropdown::-webkit-scrollbar {
        width: 6px;
    }

    .product-dropdown::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .product-dropdown::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .product-dropdown-search {
        position: sticky;
        top: 0;
        padding: 12px;
        background: white;
        border-bottom: 1px solid #f1f5f9;
    }

    .product-dropdown-search input {
        width: 100%;
        padding: 10px 14px 10px 36px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.875rem;
        background: #f8fafc;
    }

    .product-dropdown-search input:focus {
        outline: none;
        border-color: #4338ca;
        background: white;
    }

    .product-dropdown-search svg {
        position: absolute;
        left: 22px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #94a3b8;
    }

    .product-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        cursor: pointer;
        transition: background 0.15s;
        border-bottom: 1px solid #f8fafc;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-item:hover {
        background: #f1f5f9;
    }

    .product-item-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .product-item-icon svg {
        width: 20px;
        height: 20px;
        color: #4338ca;
    }

    .product-item-details {
        flex: 1;
        min-width: 0;
    }

    .product-item-name {
        font-weight: 600;
        color: #1e1b4b;
        font-size: 0.9rem;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-item-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.75rem;
    }

    .product-item-code {
        background: #dcfce7;
        color: #16a34a;
        padding: 2px 8px;
        border-radius: 20px;
        font-weight: 600;
    }

    .product-item-stock {
        color: #64748b;
    }

    .product-item-price {
        font-weight: 700;
        color: #4338ca;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    /* Empty state */
    .product-empty {
        padding: 2rem;
        text-align: center;
    }

    .product-empty-icon {
        width: 48px;
        height: 48px;
        background: #fef3c7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
    }

    .product-empty-icon svg {
        width: 24px;
        height: 24px;
        color: #f59e0b;
    }

    .product-empty-text {
        color: #64748b;
        font-size: 0.875rem;
    }
</style>

<div class="product-search-container" x-data="{ open: false, search: '' }" @click.away="open = false">
    <label class="product-search-label">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
        Search & Select Product
    </label>
    
    <div class="product-search-wrapper" :class="{ 'open': open }">
        <input 
            type="text" 
            class="product-search-input" 
            placeholder="Click to search products..."
            readonly
            @click="open = !open"
        >
        <svg class="product-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
        
        <div class="product-dropdown" :class="{ 'show': open }">
            <div class="product-dropdown-search">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                <input 
                    type="text" 
                    placeholder="Type to filter products..." 
                    x-model="search"
                    @click.stop
                >
            </div>
            
            @if($products->isNotEmpty())
                @foreach($products as $product)
                    <div 
                        class="product-item" 
                        x-show="search === '' || '{{ strtolower($product->name . ' ' . $product->code) }}'.includes(search.toLowerCase())"
                        wire:click="$set('selectedProduct', '{{ $product->id }}')"
                        @click="open = false; search = ''"
                    >
                        <div class="product-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"></path><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
                        </div>
                        <div class="product-item-details">
                            <div class="product-item-name">{{ $product->name }}</div>
                            <div class="product-item-meta">
                                <span class="product-item-code">{{ $product->code }}</span>
                                <span class="product-item-stock">Stock: {{ $product->quantity }}</span>
                            </div>
                        </div>
                        <div class="product-item-price">
                            KES {{ number_format($product->selling_price / 1.16, 2) }}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="product-empty">
                    <div class="product-empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                    </div>
                    <div class="product-empty-text">No products available</div>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
