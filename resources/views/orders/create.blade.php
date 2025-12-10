@extends('layouts.tabler')

@push('page-styles')
<style>
    /* Create Order Page - Landing Page Color Scheme */
    :root {
        --dash-primary: #1e1b4b;
        --dash-primary-light: #312e81;
        --dash-accent: #f97316;
        --dash-accent-light: #fdba74;
        --dash-success: #22c55e;
        --dash-success-light: #bbf7d0;
        --dash-bg-gradient-start: #fef3e2;
        --dash-bg-gradient-end: #e0e7ff;
    }

    .page-body {
        background: linear-gradient(135deg, var(--dash-bg-gradient-start) 0%, var(--dash-bg-gradient-end) 100%);
        min-height: calc(100vh - 60px);
        padding: 1.5rem 0;
    }

    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        color: var(--dash-primary);
        font-size: 1rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-footer {
        background: #fafbfc;
        border-top: 1px solid #f1f5f9;
        padding: 1rem 1.5rem;
    }

    .card-title {
        color: var(--dash-primary);
        font-weight: 600;
    }

    /* Table Styling */
    .table {
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
        padding: 0.75rem;
    }

    .table tbody td {
        padding: 0.75rem;
        vertical-align: middle;
        color: #334155;
        font-size: 0.875rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fafbfc;
    }

    /* Form Inputs */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 0.625rem 0.875rem;
        transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--dash-primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    /* Buttons */
    .btn-success {
        background: var(--dash-success);
        border-color: var(--dash-success);
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
    }

    .btn-success:hover {
        background: #16a34a;
        border-color: #16a34a;
    }

    .add-list {
        background: var(--dash-primary);
        border-color: var(--dash-primary);
    }

    .add-list:hover {
        background: var(--dash-primary-light);
        border-color: var(--dash-primary-light);
    }

    .btn-outline-primary {
        color: var(--dash-primary);
        border-color: var(--dash-primary);
        border-radius: 8px;
    }

    .btn-outline-primary:hover {
        background: var(--dash-primary);
        border-color: var(--dash-primary);
        color: #ffffff;
    }

    .btn-outline-danger {
        border-radius: 8px;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Labels */
    .small, label {
        color: #64748b;
        font-weight: 500;
    }

    /* Input Group */
    .input-group {
        gap: 0.5rem;
    }

    .input-group .form-control {
        border-radius: 8px !important;
    }

    /* Summary Row Styling */
    .table tbody tr:last-child td,
    .table tbody tr:nth-last-child(2) td,
    .table tbody tr:nth-last-child(3) td,
    .table tbody tr:nth-last-child(4) td {
        font-weight: 500;
    }

    .text-end {
        color: #64748b;
    }

    /* Live Search Styles */
    .search-wrapper .position-relative {
        display: flex;
        align-items: center;
    }

    .search-wrapper input {
        padding-right: 40px;
    }

    .clear-search-btn {
        position: absolute;
        right: 10px;
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s;
    }

    .clear-search-btn:hover {
        background: #f1f5f9;
        color: #64748b;
    }

    .search-status {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 4px;
        min-height: 18px;
    }

    .search-status.searching {
        color: var(--dash-accent);
    }

    /* Highlight matching text */
    .highlight-match {
        background: #fef3c7;
        padding: 0 2px;
        border-radius: 2px;
    }

    /* Product row animation */
    #productTableBody tr {
        transition: opacity 0.15s ease;
    }

    .product-hidden {
        display: none !important;
    }
</style>
@endpush

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
        <div class="col-lg-5">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">
                        List Product
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="search-wrapper mb-3">
                                <div class="position-relative">
                                    <input type="text" 
                                           id="liveSearch" 
                                           class="form-control" 
                                           placeholder="Search products..."
                                           autocomplete="off">
                                    <button type="button" 
                                            id="clearSearch" 
                                            class="clear-search-btn" 
                                            style="display: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div id="searchStatus" class="search-status"></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                        @forelse ($products as $product)
                                        <tr class="product-row" data-name="{{ strtolower($product->name) }}" data-code="{{ strtolower($product->code ?? '') }}">
                                            <td class="text-center product-name">
                                                {{ $product->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $product->quantity }}
                                            </td>
                                            <td class="text-center">
                                                {{ $product->unit->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($product->selling_price, 2) }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form action="{{ route('pos.addCartItem', $product) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                                        <input type="hidden" name="selling_price" value="{{ $product->selling_price }}">

                                                        <button type="submit" class="btn btn-icon btn-outline-primary">
                                                            <x-icon.cart />
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr id="noProductsRow">
                                            <th colspan="5" class="text-center">
                                                No products found.
                                            </th>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="mt-3">
                                    {{ $products->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('New Order') }}
                            </h3>
                        </div>
                        <div class="card-actions btn-actions">
                            @can('create-order')
                            <x-action.close route="{{ route('orders.index') }}" />
                            @endcan
                        </div>
                    </div>
                    <form action="{{ route('invoice.create') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row gx-3 mb-3">
                                @include('partials.session')
                                <div class="col-md-4">
                                    <label for="purchase_date" class="small my-1">
                                        {{ __('Date') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input name="purchase_date" id="purchase_date" type="date" class="form-control example-date-input @error('purchase_date') is-invalid @enderror" value="{{ old('purchase_date') ?? now()->format('Y-m-d') }}" required>

                                    @error('purchase_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="small mb-1" for="customer_id">
                                        {{ __('Customer') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                                        <option selected="" disabled="">
                                            Select a customer:
                                        </option>

                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" @selected( old('customer_id')==$customer->id)>
                                            {{ $customer->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('customer_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="small mb-1" for="reference">
                                        {{ __('Reference') }}
                                    </label>

                                    <input type="text" class="form-control" id="reference" name="reference" value="ORD" readonly>

                                    @error('reference')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('Product') }}</th>
                                            <th scope="col" class="text-center">{{ __('Quantity') }}</th>
                                            <th scope="col" class="text-center">{{ __('Price') }}</th>
                                            <th scope="col" class="text-center">{{ __('SubTotal') }}</th>
                                            <th scope="col" class="text-center">
                                                {{ __('Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($carts as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td style="min-width: 170px;">
                                                <form></form>
                                                <form action="{{ route('pos.updateCartItem', $item->rowId) }}" method="POST">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="qty" required value="{{ old('qty', $item->qty) }}">
                                                        <input type="hidden" class="form-control" name="product_id" value="{{ $item->id }}">

                                                        <div class="input-group-append text-center">
                                                            <button type="submit" class="btn btn-icon btn-success border-none" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sumbit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M5 12l5 5l10 -10" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                {{ $item->price }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->subtotal }}
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('pos.deleteCartItem', $item->rowId) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-outline-danger " onclick="return confirm('Are you sure you want to delete this record?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <td colspan="5" class="text-center">
                                            {{ __('Add Products') }}
                                        </td>
                                        @endforelse

                                        <tr>
                                            <td colspan="4" class="text-end">
                                                Total Product
                                            </td>
                                            <td class="text-center">
                                                {{ Cart::count() }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end">Subtotal</td>
                                            <td class="text-center">
                                                {{ Cart::subtotal() }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end">Tax</td>
                                            <td class="text-center">
                                                {{ Cart::tax() }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end">Total</td>
                                            <td class="text-center">
                                            {{ Cart::total() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success add-list mx-1 {{ Cart::count() > 0 ? '' : 'disabled' }}">
                                {{ __('Create Invoice') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>

</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('liveSearch');
    const clearBtn = document.getElementById('clearSearch');
    const searchStatus = document.getElementById('searchStatus');
    const productTableBody = document.getElementById('productTableBody');
    const paginationDiv = document.querySelector('.mt-3');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    let debounceTimer;
    let originalContent = productTableBody.innerHTML;
    let isSearchActive = false;
    
    // Debounce function
    function debounce(func, delay) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(func, delay);
    }
    
    // Escape HTML to prevent XSS
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Highlight matching text
    function highlightMatch(text, searchTerm) {
        if (!searchTerm) return escapeHtml(text);
        const regex = new RegExp(`(${searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return escapeHtml(text).replace(regex, '<span class="highlight-match">$1</span>');
    }
    
    // Create product row HTML
    function createProductRow(product, searchTerm) {
        return `
            <tr class="product-row" data-name="${product.name.toLowerCase()}" data-code="${(product.code || '').toLowerCase()}">
                <td class="text-center product-name">
                    ${highlightMatch(product.name, searchTerm)}
                </td>
                <td class="text-center">
                    ${product.quantity}
                </td>
                <td class="text-center">
                    ${escapeHtml(product.unit_name)}
                </td>
                <td class="text-center">
                    ${product.selling_price}
                </td>
                <td>
                    <div class="d-flex">
                        <form action="/pos/add-cart-item/${product.slug}" method="POST">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="id" value="${product.id}">
                            <input type="hidden" name="name" value="${escapeHtml(product.name)}">
                            <input type="hidden" name="selling_price" value="${product.selling_price_raw}">
                            <button type="submit" class="btn btn-icon btn-outline-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="6" cy="19" r="2" />
                                    <circle cx="17" cy="19" r="2" />
                                    <path d="M17 17h-11v-14h-2" />
                                    <path d="M6 5l14 1l-1 7h-13" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        `;
    }
    
    // Main AJAX search function
    async function performSearch() {
        const searchTerm = searchInput.value.trim();
        
        // Show/hide clear button
        if (searchTerm.length > 0) {
            clearBtn.style.display = 'flex';
        } else {
            clearBtn.style.display = 'none';
        }
        
        // If search is empty, restore original content
        if (searchTerm === '') {
            if (isSearchActive) {
                productTableBody.innerHTML = originalContent;
                if (paginationDiv) paginationDiv.style.display = '';
                isSearchActive = false;
            }
            searchStatus.textContent = '';
            searchStatus.classList.remove('searching');
            return;
        }
        
        // Show searching status
        searchStatus.textContent = 'Searching...';
        searchStatus.classList.add('searching');
        
        try {
            const response = await fetch(`/orders/search-products?q=${encodeURIComponent(searchTerm)}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) throw new Error('Search failed');
            
            const data = await response.json();
            isSearchActive = true;
            
            // Hide pagination during search
            if (paginationDiv) paginationDiv.style.display = 'none';
            
            if (data.products.length === 0) {
                productTableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No products found matching "<strong>${escapeHtml(searchTerm)}</strong>"
                        </td>
                    </tr>
                `;
                searchStatus.textContent = 'No products found';
            } else {
                // Build rows for all matching products
                let rowsHtml = '';
                data.products.forEach(product => {
                    rowsHtml += createProductRow(product, searchTerm);
                });
                productTableBody.innerHTML = rowsHtml;
                searchStatus.textContent = `Found ${data.count} product${data.count !== 1 ? 's' : ''} matching "${searchTerm}"`;
            }
        } catch (error) {
            console.error('Search error:', error);
            searchStatus.textContent = 'Search failed. Please try again.';
            searchStatus.classList.remove('searching');
        }
    }
    
    // Event listeners
    searchInput.addEventListener('input', function() {
        debounce(performSearch, 250); // 250ms delay for AJAX
    });
    
    // Clear button click
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        performSearch();
        searchInput.focus();
    });
    
    // Handle Escape key to clear
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            searchInput.value = '';
            performSearch();
        }
    });
});
</script>
@endpushonce