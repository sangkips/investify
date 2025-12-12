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
        --text-dark: #1e1b4b;
        --text-light: #64748b;
        --bg-gradient-start: #fef3e2;
        --bg-gradient-end: #e0e7ff;
    }

    .purchase-page {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
        padding: 1.5rem;
    }

    /* Card Styling */
    .purchase-card {
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header */
    .purchase-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .purchase-header-content h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .purchase-header-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.15);
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
        background: rgba(255, 255, 255, 0.25);
        color: white;
        transform: translateY(-2px);
    }

    /* Status Badge in Header */
    .header-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-approved {
        background: var(--success);
        color: white;
    }

    .status-pending {
        background: var(--warning);
        color: white;
    }

    /* Info Section */
    .info-section {
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-dark);
        padding: 10px 14px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    /* Products Section */
    .products-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .products-section-header h3 {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Products Table */
    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table thead {
        background: #f8fafc;
    }

    .products-table th {
        padding: 1rem 1.25rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        border-bottom: 1px solid #e2e8f0;
        text-align: center;
    }

    .products-table th:first-child {
        text-align: left;
    }

    .products-table td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .products-table tbody tr:hover {
        background: #fafbfc;
    }

    .products-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Product Image */
    .product-image {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
    }

    /* Product Name */
    .product-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    /* Badge */
    .code-badge {
        display: inline-flex;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #e0e7ff;
        color: var(--primary);
    }

    .stock-badge {
        display: inline-flex;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--success-light);
        color: var(--success);
    }

    .qty-badge {
        display: inline-flex;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #dbeafe;
        color: #2563eb;
    }

    /* Price */
    .price-value {
        font-weight: 600;
        color: var(--text-dark);
    }

    .total-value {
        font-weight: 700;
        color: var(--success);
    }

    /* Summary Rows */
    .summary-row td {
        background: #f8fafc;
        padding: 0.75rem 1.25rem;
    }

    .summary-row td:first-child {
        text-align: right;
        font-weight: 600;
        color: var(--text-dark);
    }

    .summary-row.grand-total td {
        background: var(--primary);
        color: white;
    }

    .summary-row.grand-total td:first-child {
        color: white;
    }

    /* Footer */
    .purchase-footer {
        padding: 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
    }

    .btn-approve {
        background: var(--success);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .btn-approve:hover {
        background: #16a34a;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .purchase-page {
            padding: 0;
        }

        .purchase-card {
            border-radius: 0;
        }

        .purchase-header {
            flex-direction: column;
            text-align: center;
        }

        .header-actions {
            flex-direction: column;
            width: 100%;
        }

        .btn-back {
            justify-content: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .products-table th,
        .products-table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }

        .product-image {
            width: 40px;
            height: 40px;
        }

        .purchase-footer {
            justify-content: center;
        }

        .btn-approve {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="purchase-page">
    <div class="purchase-card">
        <!-- Header -->
        <div class="purchase-header">
            <div class="purchase-header-content">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    {{ $purchase->purchase_no }}
                </h1>
                <p>{{ __('Purchase Order Details') }}</p>
            </div>
            <div class="header-actions">
                <span class="header-status {{ $purchase->status === \App\Enums\PurchaseStatus::APPROVED ? 'status-approved' : 'status-pending' }}">
                    <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                    {{ $purchase->status === \App\Enums\PurchaseStatus::APPROVED ? __('Approved') : __('Pending') }}
                </span>
                <a href="{{ route('purchases.index') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>

        <!-- Supplier Info Section -->
        <div class="info-section">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">{{ __('Supplier Name') }}</span>
                    <div class="info-value">{{ $purchase->supplier->name }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ __('Email') }}</span>
                    <div class="info-value">{{ $purchase->supplier->email }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ __('Phone') }}</span>
                    <div class="info-value">{{ $purchase->supplier->phone }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ __('Order Date') }}</span>
                    <div class="info-value">{{ $purchase->date->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ __('Created By') }}</span>
                    <div class="info-value">{{ $purchase->createdBy->name ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ __('Address') }}</span>
                    <div class="info-value">{{ $purchase->supplier->address }}</div>
                </div>
            </div>
        </div>

        @if ($purchase->status === \App\Enums\PurchaseStatus::PENDING)
        <!-- Editable Products Section for Pending Purchases -->
        @livewire('edit-purchase-form', ['purchase' => $purchase])
        @else
        <!-- Read-only Products Section for Approved Purchases -->
        <!-- Products Section Header -->
        <div class="products-section-header">
            <h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                {{ __('Products') }} ({{ count($purchase->details) }})
            </h3>
        </div>

        <!-- Products Table -->
        <div class="table-responsive">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Code') }}</th>
                        <th>{{ __('Stock') }}</th>
                        <th>{{ __('Qty') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase->details as $item)
                    <tr>
                        <td class="product-name">{{ $item->product->name }}</td>
                        <td class="text-center">
                            <span class="code-badge">{{ $item->product->code }}</span>
                        </td>
                        <td class="text-center">
                            <span class="stock-badge">{{ $item->product->quantity }}</span>
                        </td>
                        <td class="text-center">
                            <span class="qty-badge">{{ $item->quantity }}</span>
                        </td>
                        <td class="text-center price-value">{{ Number::currency($item->unitcost ?? 0, 'KES') }}</td>
                        <td class="text-center total-value">{{ Number::currency($item->total ?? 0, 'KES') }}</td>
                    </tr>
                    @endforeach

                    <!-- Tax Percentage Row -->
                    <tr class="summary-row">
                        <td colspan="5" style="text-align: right;">{{ __('Tax Percentage') }}</td>
                        <td class="text-center">{{ number_format($purchase->tax_percentage ?? 0, 2) }}%</td>
                    </tr>

                    <!-- Tax Amount Row -->
                    <tr class="summary-row">
                        <td colspan="5" style="text-align: right;">{{ __('Tax Amount') }}</td>
                        <td class="text-center">{{ Number::currency($purchase->tax_amount ?? 0, 'KES') }}</td>
                    </tr>

                    <!-- Grand Total Row -->
                    <tr class="summary-row grand-total">
                        <td colspan="5" style="text-align: right; font-size: 1rem;">{{ __('Total Amount') }}</td>
                        <td class="text-center" style="font-size: 1.1rem; font-weight: 700;">{{ Number::currency($purchase->total_amount ?? 0, 'KES') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection