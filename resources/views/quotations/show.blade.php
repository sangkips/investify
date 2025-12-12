@extends('layouts.tabler')

@section('content')
<style>
    /* Variables matching landing page */
    :root {
        --primary: #1e1b4b;
        --primary-light: #312e81;
        --accent: #f97316;
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
    .quotation-view-page {
        min-height: 100vh;
        padding-bottom: 2rem;
    }

    /* Header Card */
    .quotation-header-card {
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

    .quotation-header-card h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .quotation-header-card p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin: 4px 0 0;
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

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        gap: 6px;
    }

    .status-pending {
        background: var(--warning-light);
        color: #b45309;
    }

    .status-completed {
        background: var(--success-light);
        color: #16a34a;
    }

    .status-cancelled {
        background: var(--danger-light);
        color: var(--danger);
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

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
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
    }

    .info-value {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Products Table */
    .products-table-wrapper {
        overflow-x: auto;
        margin: 0 -1.5rem;
        padding: 0 1.5rem;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table thead {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    }

    .products-table th {
        padding: 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: rgba(255, 255, 255, 0.9);
        text-align: left;
        white-space: nowrap;
    }

    .products-table th:first-child {
        border-radius: 12px 0 0 0;
    }

    .products-table th:last-child {
        border-radius: 0 12px 0 0;
    }

    .products-table td {
        padding: 1rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .products-table tbody tr:nth-child(even) {
        background: #f8fafc;
    }

    .products-table tbody tr:hover {
        background: #e0e7ff;
    }

    .product-image {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
        background: #f1f5f9;
    }

    .product-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    .product-code {
        display: inline-block;
        background: #dcfce7;
        color: #16a34a;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .stock-badge {
        display: inline-block;
        background: #e0e7ff;
        color: #4338ca;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .qty-badge {
        display: inline-block;
        background: #fef3c7;
        color: #b45309;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .price-cell {
        font-weight: 600;
        color: var(--text-dark);
    }

    .subtotal-cell {
        font-weight: 700;
        color: #16a34a;
    }

    /* Summary Section */
    .summary-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-row.grand-total {
        background: var(--primary);
        color: white;
        margin: 0.75rem -1.5rem -1.5rem;
        padding: 1rem 1.5rem;
        border-radius: 0 0 12px 12px;
    }

    .summary-label {
        font-weight: 500;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .summary-row.grand-total .summary-label {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
    }

    .summary-value {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
    }

    .summary-row.grand-total .summary-value {
        color: white;
        font-size: 1.2rem;
    }

    /* Actions */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        justify-content: flex-end;
    }

    .btn-complete {
        background: var(--success);
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
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .btn-complete:hover {
        background: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
    }

    /* Mobile Product Cards */
    .mobile-products {
        display: none;
    }

    .mobile-product-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.75rem;
    }

    .mobile-product-header {
        display: flex;
        gap: 12px;
        margin-bottom: 0.75rem;
    }

    .mobile-product-header img {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
        background: #f1f5f9;
    }

    .mobile-product-info {
        flex: 1;
    }

    .mobile-product-name {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .mobile-product-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    .mobile-detail {
        display: flex;
        flex-direction: column;
    }

    .mobile-detail-label {
        font-size: 0.7rem;
        color: var(--text-light);
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .mobile-detail-value {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.9rem;
    }

    .mobile-detail-value.highlight {
        color: #16a34a;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .quotation-header-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
            border-radius: 12px;
        }

        .quotation-header-card h1 {
            justify-content: center;
            font-size: 1.25rem;
        }

        .quotation-header-card h1 svg {
            width: 24px;
            height: 24px;
        }

        .btn-back {
            padding: 8px 16px;
            font-size: 0.8rem;
        }

        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .modern-card-body {
            padding: 1rem;
        }

        .products-table-wrapper {
            display: none;
        }

        .mobile-products {
            display: block;
        }

        .summary-section {
            padding: 1rem;
        }

        .summary-row.grand-total {
            margin: 0.75rem -1rem -1rem;
            padding: 1rem;
        }

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
        }

        .btn-complete {
            width: 100%;
            justify-content: center;
        }

        .quotation-view-page {
            padding-bottom: 100px;
        }
    }

    /* Print Styles */
    @media print {
        /* Remove browser header/footer by setting page margins */
        @page {
            margin: 10mm;
        }

        body {
            background: white !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Hide navbar, sidebar, and hamburger menu */
        .navbar-expand-md,
        .aside,
        .btn-back,
        .btn-print,
        .action-buttons,
        .quotation-header-card,
        .navbar-toggler,
        .sidebar-toggle,
        #sidebarToggle,
        [class*="hamburger"],
        .menu-toggle,
        button[aria-label="Toggle navigation"] {
            display: none !important;
        }

        /* Hide Created By field */
        .print-hide {
            display: none !important;
        }

        .quotation-view-page {
            padding: 0 !important;
        }

        .quotation-header-card {
            background: var(--primary) !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            border-radius: 0 !important;
            margin-bottom: 1rem !important;
        }

        .modern-card {
            box-shadow: none !important;
            border: 1px solid #ccc !important;
            margin-bottom: 1rem !important;
        }

        .products-table thead {
            background: #1e1b4b !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .products-table th {
            color: white !important;
        }

        .summary-row.grand-total {
            background: #1e1b4b !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .summary-row.grand-total .summary-label,
        .summary-row.grand-total .summary-value {
            color: white !important;
        }

        .mobile-products {
            display: none !important;
        }

        .products-table-wrapper {
            display: block !important;
        }

        .status-badge {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }

    /* Print Button */
    .btn-print {
        background: #4338ca;
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
        box-shadow: 0 4px 15px rgba(67, 56, 202, 0.3);
    }

    .btn-print:hover {
        background: #3730a3;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 56, 202, 0.4);
    }
</style>

<div class="quotation-view-page">
    <div class="container-xl">
        <!-- Header -->
        <div class="quotation-header-card">
            <div>
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    {{ __('Quotation') }} #{{ $quotation->reference }}
                </h1>
                <p>{{ $quotation->date->format('F d, Y') }}</p>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                @if ($quotation->status->value == 1)
                    <span class="status-badge status-completed">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Completed
                    </span>
                @elseif ($quotation->status->value == 0)
                    <span class="status-badge status-pending">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        Pending
                    </span>
                @else
                    <span class="status-badge status-cancelled">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        Cancelled
                    </span>
                @endif
                <a href="{{ route('quotations.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>

        <!-- Quotation Info Card -->
        <div class="modern-card">
            <div class="modern-card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <h3>{{ __('Customer Information') }}</h3>
            </div>
            <div class="modern-card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Customer Name</span>
                        <span class="info-value">{{ $quotation->customer_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Reference</span>
                        <span class="info-value">{{ $quotation->reference }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date</span>
                        <span class="info-value">{{ $quotation->date->format('d M, Y') }}</span>
                    </div>
                    <div class="info-item print-hide">
                        <span class="info-label">Created By</span>
                        <span class="info-value">{{ $quotation->user->name }}</span>
                    </div>
                </div>
                @if($quotation->note)
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e2e8f0;">
                        <span class="info-label">Notes</span>
                        <p style="color: var(--text-dark); margin: 0.5rem 0 0;">{{ $quotation->note }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Products Card -->
        <div class="modern-card">
            <div class="modern-card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <h3>{{ __('Products') }} ({{ count($quotation_details) }} items)</h3>
            </div>
            <div class="modern-card-body">
                <!-- Desktop Table -->
                <div class="products-table-wrapper">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Code</th>
                                <th>Stock</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotation_details as $item)
                            <tr>
                                <td>
                                    <span class="product-name">{{ $item->product->name }}</span>
                                </td>
                                <td><span class="product-code">{{ $item->product->code }}</span></td>
                                <td><span class="stock-badge">{{ $item->product->quantity }}</span></td>
                                <td><span class="qty-badge">{{ $item->quantity }}</span></td>
                                <td class="price-cell">{{ format_currency($item->price / 1.16) }}</td>
                                <td class="subtotal-cell">{{ format_currency($item->sub_total / 1.16) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="mobile-products">
                    @foreach ($quotation_details as $item)
                    <div class="mobile-product-card">
                        <div class="mobile-product-header">
                            <div class="mobile-product-info">
                                <div class="mobile-product-name">{{ $item->product->name }}</div>
                                <span class="product-code">{{ $item->product->code }}</span>
                            </div>
                        </div>
                        <div class="mobile-product-details">
                            <div class="mobile-detail">
                                <span class="mobile-detail-label">Price</span>
                                <span class="mobile-detail-value">{{ format_currency($item->price / 1.16) }}</span>
                            </div>
                            <div class="mobile-detail">
                                <span class="mobile-detail-label">Qty</span>
                                <span class="mobile-detail-value">{{ $item->quantity }}</span>
                            </div>
                            <div class="mobile-detail">
                                <span class="mobile-detail-label">Stock</span>
                                <span class="mobile-detail-value">{{ $item->product->quantity }}</span>
                            </div>
                            <div class="mobile-detail">
                                <span class="mobile-detail-label">Sub Total</span>
                                <span class="mobile-detail-value highlight">{{ format_currency($item->sub_total / 1.16) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Summary Section -->
                <div class="summary-section">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value">
                            @php
                                $subtotal = $quotation_details->sum('sub_total');
                            @endphp
                            {{ format_currency($subtotal / 1.16) }}
                        </span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Discount ({{ $quotation->discount_percentage }}%)</span>
                        <span class="summary-value">{{ format_currency($quotation->discount_amount) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">VAT (16% Incl.)</span>
                        <span class="summary-value">{{ format_currency($quotation->tax_amount) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Shipping</span>
                        <span class="summary-value">{{ format_currency($quotation->shipping_amount) }}</span>
                    </div>
                    <div class="summary-row grand-total">
                        <span class="summary-label">Grand Total</span>
                        <span class="summary-value">{{ format_currency($quotation->total_amount) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        @if ($quotation->status->value == 0)
        <div class="action-buttons">
            <a href="{{ route('quotations.edit', $quotation->uuid) }}" class="btn-edit" style="background: #f97316; color: white; border: none; padding: 12px 28px; border-radius: 50px; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 10px; cursor: pointer; transition: all 0.2s; text-decoration: none; box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                {{ __('Edit Quotation') }}
            </a>
            <form action="{{ route('quotations.complete', $quotation->uuid) }}" method="POST">
                @csrf
                <button type="submit" class="btn-complete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    {{ __('Complete Quotation') }}
                </button>
            </form>
        </div>
        @else
        <!-- Print Button for completed quotations -->
        <div class="action-buttons">
            <button type="button" class="btn-print" onclick="printQuotation()">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                {{ __('Print Quotation') }}
            </button>
        </div>

        <script>
            function printQuotation() {
                // Set document title to customer name + date for PDF filename
                var originalTitle = document.title;
                document.title = '{{ $quotation->customer_name }}_{{ $quotation->date->format("Y-m-d") }}';
                
                window.print();
                
                // Restore original title after print dialog
                setTimeout(function() {
                    document.title = originalTitle;
                }, 1000);
            }
        </script>
        @endif
    </div>
</div>
@endsection