@extends('layouts.tabler')

@section('content')
<style>
    .page-body {
        background: linear-gradient(135deg, #fef3e2 0%, #e0e7ff 100%);
        min-height: 100vh;
        padding: 2rem 0;
        padding-bottom: 100px;
    }
    
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }
    
    .card-title {
        font-weight: 600;
        color: #1e1b4b;
        margin-bottom: 0;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .card-footer {
        background: transparent;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }
    
    /* Product image styling */
    .product-image-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
    }
    
    .product-image-container img {
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
        border-radius: 8px;
    }
    
    /* Details table styling */
    .details-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .details-table tr {
        border-bottom: 1px solid #f1f5f9;
    }
    
    .details-table tr:last-child {
        border-bottom: none;
    }
    
    .details-table td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
    }
    
    .details-table td:first-child {
        font-weight: 500;
        color: #64748b;
        width: 35%;
        background: #fafbfc;
    }
    
    .details-table td:last-child {
        color: #1e1b4b;
        font-weight: 500;
    }
    
    /* Badge styling */
    .badge-category {
        background: linear-gradient(135deg, #1e1b4b 0%, #3730a3 100%);
        color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
    }
    
    .badge-category:hover {
        opacity: 0.9;
        color: #ffffff;
    }
    
    .badge-unit {
        background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
        color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
    }
    
    .badge-unit:hover {
        opacity: 0.9;
        color: #ffffff;
    }
    
    .badge-alert {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        color: #ffffff;
        padding: 0.35rem 0.75rem;
        border-radius: 15px;
        font-weight: 500;
    }
    
    .badge-tax {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: #ffffff;
        padding: 0.35rem 0.75rem;
        border-radius: 15px;
        font-weight: 500;
    }
    
    /* Price styling */
    .price-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #10b981;
    }
    
    .buying-price {
        color: #6366f1;
    }
    
    /* Barcode container */
    .barcode-container {
        background: #ffffff;
        padding: 0.5rem;
        border-radius: 8px;
        display: inline-block;
    }
    
    /* Hide default card footer - we use sticky buttons instead */
    .card-footer.desktop-buttons {
        display: none;
    }
    
    /* Desktop & Mobile Sticky Buttons */
    .sticky-action-buttons {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #ffffff;
        padding: 1rem 2rem;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }
    
    .sticky-action-buttons .btn-back {
        background: #1e1b4b;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(30, 27, 75, 0.3);
        text-decoration: none;
    }
    
    .sticky-action-buttons .btn-back:hover {
        background: #2d2a5e;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(30, 27, 75, 0.4);
    }
    
    .sticky-action-buttons .btn-edit {
        background: #f59e0b;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        text-decoration: none;
    }
    
    .sticky-action-buttons .btn-edit:hover {
        background: #d97706;
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
        transform: translateY(-2px);
    }
    
    .sticky-action-buttons .btn-delete {
        background: #ef4444;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        cursor: pointer;
    }
    
    .sticky-action-buttons .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
    }
    
    /* Mobile adjustments */
    @media (max-width: 767px) {
        .page-body {
            padding: 1rem 0;
            padding-bottom: 90px;
        }
        
        .sticky-action-buttons {
            padding: 1rem;
            justify-content: stretch;
        }
        
        .sticky-action-buttons .btn-back,
        .sticky-action-buttons .btn-edit,
        .sticky-action-buttons .btn-delete {
            flex: 1;
            justify-content: center;
            text-align: center;
            padding: 0.875rem 1rem;
        }
        
        .details-table td {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
        
        .details-table td:first-child {
            width: 40%;
        }
    }
    
    /* Adjust for sidebar on desktop */
    @media (min-width: 768px) {
        .sticky-action-buttons {
            left: var(--sidebar-width, 260px);
            transition: left 0.3s ease;
            padding-right: calc((100vw - var(--sidebar-width, 260px) - 1140px) / 2 + 2rem);
        }
        
        .sidebar.collapsed ~ .page-wrapper .sticky-action-buttons {
            left: var(--sidebar-collapsed-width, 60px);
            padding-right: calc((100vw - var(--sidebar-collapsed-width, 60px) - 1140px) / 2 + 2rem);
        }
    }
    
    /* For smaller desktop screens */
    @media (min-width: 768px) and (max-width: 1400px) {
        .sticky-action-buttons {
            padding-right: 3rem;
        }
    }
</style>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-3">
                                {{ __('Product Image') }}
                            </h3>

                            <div class="product-image-container">
                                <img src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('assets/img/products/default.png') }}" alt="{{ $product->name }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="card-title">
                                {{ $product->name }}
                            </h3>
                            <a href="{{ route('products.index') }}" class="btn-action">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M18 6l-12 12"></path>
                                    <path d="M6 6l12 12"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <table class="details-table">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Slug</td>
                                        <td>{{ $product->slug }}</td>
                                    </tr>
                                    <tr>
                                        <td>Code</td>
                                        <td><code style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 4px;">{{ $product->code }}</code></td>
                                    </tr>
                                    <tr>
                                        <td>Barcode</td>
                                        <td>
                                            <div class="barcode-container">
                                                {!! $barcode !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>
                                            <a href="{{ route('categories.show', $product->category) }}" class="badge-category">
                                                {{ $product->category->name }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit</td>
                                        <td>
                                            <a href="{{ route('units.show', $product->unit) }}" class="badge-unit">
                                                {{ $product->unit->short_code }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td><strong>{{ $product->quantity }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Quantity Alert</td>
                                        <td>
                                            <span class="badge-alert">
                                                {{ $product->quantity_alert }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Buying Price</td>
                                        <td><span class="price-value buying-price">{{ number_format($product->buying_price, 2) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Selling Price</td>
                                        <td><span class="price-value">{{ number_format($product->selling_price, 2) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td>
                                            <span class="badge-tax">
                                                {{ $product->tax }}%
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tax Type</td>
                                        <td>{{ $product->tax_type->label() }}</td>
                                    </tr>
                                    @if($product->notes)
                                    <tr>
                                        <td>{{ __('Notes') }}</td>
                                        <td>{{ $product->notes }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer text-end desktop-buttons">
                            <!-- Hidden - we use sticky buttons instead -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unified Sticky Action Buttons (Desktop & Mobile) -->
        <div class="sticky-action-buttons">
            <a class="btn-back" href="{{ url()->previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5"></path>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                {{ __('Back') }}
            </a>
            @can('update-product')
            <a class="btn-edit" href="{{ route('products.edit', $product->uuid) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                {{ __('Edit') }}
            </a>
            @endcan
            @can('delete-product')
            <form action="{{ route('products.destroy', $product->uuid) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    {{ __('Delete') }}
                </button>
            </form>
            @endcan
        </div>
    </div>
</div>
@endsection