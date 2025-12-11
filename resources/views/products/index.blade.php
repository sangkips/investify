@extends('layouts.tabler')

@push('page-styles')
<style>
    /* Products Page Styles - Matching landing page gradient */
    :root {
        --products-primary: #1e1b4b;
        --products-primary-light: #312e81;
        --products-accent: #f97316;
        --products-bg-gradient-start: #fef3e2;
        --products-bg-gradient-end: #e0e7ff;
    }

    .page-wrapper {
        background: linear-gradient(135deg, var(--products-bg-gradient-start) 0%, var(--products-bg-gradient-end) 100%);
        min-height: 100vh;
    }

    .page-body {
        padding: 1.5rem 0;
    }

    /* Refined Card Styling */
    .card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        background: transparent;
        padding: 1.25rem 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--products-primary);
        margin: 0;
    }

    .card-body {
        padding: 1.25rem 1.5rem;
    }

    .card-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        background: transparent;
        padding: 1rem 1.5rem;
    }

    /* Button Styling */
    .btn-success {
        background: var(--products-primary);
        border-color: var(--products-primary);
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-success:hover {
        background: var(--products-primary-light);
        border-color: var(--products-primary-light);
        transform: translateY(-1px);
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        padding: 0.875rem 1rem;
    }

    .table tbody td {
        padding: 0.875rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: #f8fafc;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Form Controls */
    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 0.75rem;
    }

    .form-select:focus, .form-control:focus {
        border-color: var(--products-primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    /* Pagination */
    .pagination {
        gap: 0.25rem;
    }

    .page-link {
        border-radius: 8px;
        border: none;
        color: #64748b;
        padding: 0.5rem 0.75rem;
    }

    .page-link:hover {
        background: #f1f5f9;
        color: var(--products-primary);
    }

    .page-item.active .page-link {
        background: var(--products-primary);
        color: white;
    }

    /* Action Buttons */
    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .btn-icon:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@section('content')
    <div class="page-body">
        @if (!$products)
            <x-empty title="No products found" message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your first Product') }}" button_route="{{ route('products.create') }}" />

            <div style="text-center" style="padding-top:-25px">
                <center>
                    <a href="{{ route('products.import.view') }}" class="">
                        {{ __('Import Products') }}
                    </a>
                </center>
            </div>
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.product-table')
            </div>
        @endif
    </div>
@endsection
