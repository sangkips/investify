<div>
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

    /* Desktop Table - Hidden on Mobile */
    .desktop-table {
        display: block;
    }

    /* Mobile Cards - Hidden on Desktop */
    .mobile-cards {
        display: none;
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

    /* Product Select */
    .product-select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        color: var(--text-dark);
        background: #f8fafc;
        transition: all 0.2s;
    }

    .product-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background: white;
    }

    /* Quantity Input */
    .qty-input {
        width: 80px;
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        color: var(--text-dark);
        background: #f8fafc;
        text-align: center;
        transition: all 0.2s;
    }

    .qty-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background: white;
    }

    /* Product Name */
    .product-name {
        font-weight: 500;
        color: var(--text-dark);
    }

    /* Price Display */
    .price-display {
        font-weight: 600;
        color: var(--text-dark);
    }

    .total-display {
        font-weight: 600;
        color: var(--success);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .action-btn-save {
        background: var(--success-light);
        color: var(--success);
    }

    .action-btn-save:hover {
        background: var(--success);
        color: white;
    }

    .action-btn-edit {
        background: var(--warning-light);
        color: var(--warning);
    }

    .action-btn-edit:hover {
        background: var(--warning);
        color: white;
    }

    .action-btn-delete {
        background: var(--danger-light);
        color: var(--danger);
    }

    .action-btn-delete:hover {
        background: var(--danger);
        color: white;
    }

    .action-btn-add {
        background: var(--accent);
        color: white;
        width: auto;
        padding: 10px 16px;
        font-size: 0.8rem;
        font-weight: 600;
        gap: 6px;
    }

    .action-btn-add:hover {
        background: var(--accent-hover);
    }

    /* Totals Section */
    .totals-row td, .totals-row th {
        padding: 1rem 1.25rem;
        background: #f8fafc;
    }

    .totals-row th {
        text-align: right;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
        text-transform: none;
        letter-spacing: normal;
    }

    .totals-row td {
        text-align: center;
        font-weight: 600;
    }

    .totals-row.grand-total th,
    .totals-row.grand-total td {
        background: var(--primary);
        color: white;
    }

    /* Tax Input */
    .tax-input-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .tax-input {
        width: 70px;
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9rem;
        text-align: center;
        background: white;
    }

    .tax-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(30, 27, 75, 0.1);
    }

    /* Error Message */
    .error-text {
        color: var(--danger);
        font-size: 0.75rem;
        margin-top: 4px;
    }

    /* Add Product Row */
    .add-product-row td {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }

    /* Update Button */
    .btn-update {
        background: var(--accent);
        color: white;
        border: none;
        padding: 14px 24px;
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

    .btn-update:hover {
        background: var(--accent-hover);
    }

    /* Approve Button */
    .btn-approve {
        background: var(--success);
        color: white;
        border: none;
        padding: 14px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .btn-approve:hover {
        background: #16a34a;
    }

    /* ========== MOBILE STYLES ========== */
    @media (max-width: 768px) {
        .desktop-table {
            display: none;
        }

        .mobile-cards {
            display: block;
        }

        /* Mobile Product Card */
        .mobile-product-card {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            margin: 0.5rem 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
        }

        .mobile-product-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .mobile-product-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-dark);
            flex: 1;
        }

        .mobile-product-actions {
            display: flex;
            gap: 6px;
        }

        .mobile-product-actions .action-btn {
            width: 32px;
            height: 32px;
        }

        .mobile-product-details {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }

        .mobile-detail-item {
            text-align: center;
            flex: 1;
        }

        .mobile-detail-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: var(--text-light);
            margin-bottom: 2px;
        }

        .mobile-detail-value {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .mobile-detail-value.total {
            color: var(--success);
        }

        /* Mobile Edit Form */
        .mobile-edit-form {
            padding: 1rem;
        }

        .mobile-form-group {
            margin-bottom: 1rem;
        }

        .mobile-form-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-light);
            margin-bottom: 6px;
        }

        .mobile-form-group select,
        .mobile-form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            background: #f8fafc;
        }

        .mobile-form-actions {
            display: flex;
            gap: 8px;
            margin-top: 1rem;
        }

        .mobile-form-actions .action-btn {
            flex: 1;
            height: 44px;
            font-size: 0.85rem;
            gap: 6px;
        }

        /* Mobile Add Button */
        .mobile-add-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: calc(100% - 2rem);
            margin: 1rem;
            padding: 12px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
        }

        /* Mobile Summary */
        .mobile-summary {
            background: white;
            margin: 0.5rem 1rem;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
        }

        .mobile-summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .mobile-summary-row:last-child {
            border-bottom: none;
        }

        .mobile-summary-row.grand-total {
            background: var(--primary);
            color: white;
        }

        .mobile-summary-label {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .mobile-summary-value {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .mobile-summary-row.grand-total .mobile-summary-label,
        .mobile-summary-row.grand-total .mobile-summary-value {
            color: white;
        }

        .mobile-tax-input {
            width: 60px;
            padding: 6px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 0.85rem;
            text-align: center;
        }

        /* Sticky Footer for Mobile */
        .mobile-sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 1rem;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
            display: flex;
            gap: 10px;
            z-index: 100;
        }

        .mobile-sticky-footer .btn-update,
        .mobile-sticky-footer .btn-approve {
            flex: 1;
            justify-content: center;
            padding: 14px 16px;
            font-size: 0.85rem;
        }

        /* Add padding at bottom to account for sticky footer */
        .mobile-cards {
            padding-bottom: 100px;
        }

        /* Desktop footer hidden on mobile */
        .desktop-footer {
            display: none !important;
        }
    }

    /* Desktop Footer */
    @media (min-width: 769px) {
        .mobile-sticky-footer {
            display: none;
        }
    }
</style>

<!-- Products Section Header -->
<div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 1.5rem; background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
    <h3 style="font-size: 0.9rem; font-weight: 600; color: var(--text-dark); margin: 0; display: flex; align-items: center; gap: 8px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
        {{ __('Products') }}
    </h3>
    <span style="font-size: 0.75rem; color: var(--text-light); background: #e2e8f0; padding: 4px 10px; border-radius: 20px;">{{ __('Edit Mode') }}</span>
</div>

<!-- ========== DESKTOP TABLE VIEW ========== -->
<div class="desktop-table">
    <table class="products-table">
        <thead>
            <tr>
                <th>{{ __('Product') }}</th>
                <th>{{ __('Quantity') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Total') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($invoiceProducts as $index => $invoiceProduct)
            <tr>
                <td>
                    @if($invoiceProduct['is_saved'])
                    <span class="product-name">{{ $invoiceProduct['product_name'] }}</span>
                    @else
                    <select wire:model.live="invoiceProducts.{{$index}}.product_id" class="product-select">
                        <option value="">-- {{ __('Choose Product') }} --</option>
                        @foreach ($allProducts as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @endif
                </td>
                <td class="text-center">
                    @if($invoiceProduct['is_saved'])
                    <span class="price-display">{{ $invoiceProduct['quantity'] }}</span>
                    @else
                    <input type="number" wire:model="invoiceProducts.{{$index}}.quantity" class="qty-input" min="1" />
                    @endif
                </td>
                <td class="text-center">
                    @if($invoiceProduct['is_saved'])
                    <span class="price-display">{{ Number::currency($invoiceProduct['product_price'], 'KES') }}</span>
                    @endif
                </td>
                <td class="text-center">
                    <span class="total-display">{{ Number::currency($invoiceProduct['product_price'] * $invoiceProduct['quantity'], 'KES') }}</span>
                </td>
                <td class="text-center">
                    <div class="action-buttons">
                        @if($invoiceProduct['is_saved'])
                        <button type="button" wire:click="editProduct({{$index}})" class="action-btn action-btn-edit" title="{{ __('Edit') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </button>
                        @elseif($invoiceProduct['product_id'])
                        <button type="button" wire:click="saveProduct({{$index}})" class="action-btn action-btn-save" title="{{ __('Save') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </button>
                        @endif
                        <button type="button" wire:click="removeProduct({{$index}})" class="action-btn action-btn-delete" title="{{ __('Remove') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach

            <tr class="add-product-row">
                <td colspan="4"></td>
                <td class="text-center">
                    <button type="button" wire:click="addProduct" class="action-btn action-btn-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        {{ __('Add') }}
                    </button>
                </td>
            </tr>

            <tr class="totals-row">
                <th colspan="4">{{ __('Subtotal') }}</th>
                <td class="text-center total-display">{{ Number::currency($subtotal, 'KES') }}</td>
            </tr>

            <tr class="totals-row">
                <th colspan="4">{{ __('Taxes') }}</th>
                <td>
                    <div class="tax-input-wrapper">
                        <input wire:model.blur="taxes" type="number" class="tax-input" min="0" max="100" step="0.01">
                        <span>%</span>
                    </div>
                </td>
            </tr>

            <tr class="totals-row grand-total">
                <th colspan="4">{{ __('Total') }}</th>
                <td class="text-center" style="font-size: 1.1rem;">{{ Number::currency($total, 'KES') }}</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- ========== MOBILE CARD VIEW ========== -->
<div class="mobile-cards">
    @forelse ($invoiceProducts as $index => $invoiceProduct)
        @if($invoiceProduct['is_saved'])
        <!-- Saved Product Card -->
        <div class="mobile-product-card">
            <div class="mobile-product-header">
                <span class="mobile-product-name">{{ $invoiceProduct['product_name'] }}</span>
                <div class="mobile-product-actions">
                    <button type="button" wire:click="editProduct({{$index}})" class="action-btn action-btn-edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </button>
                    <button type="button" wire:click="removeProduct({{$index}})" class="action-btn action-btn-delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    </button>
                </div>
            </div>
            <div class="mobile-product-details">
                <div class="mobile-detail-item">
                    <div class="mobile-detail-label">{{ __('Qty') }}</div>
                    <div class="mobile-detail-value">{{ $invoiceProduct['quantity'] }}</div>
                </div>
                <div class="mobile-detail-item">
                    <div class="mobile-detail-label">{{ __('Price') }}</div>
                    <div class="mobile-detail-value">{{ Number::currency($invoiceProduct['product_price'], 'KES') }}</div>
                </div>
                <div class="mobile-detail-item">
                    <div class="mobile-detail-label">{{ __('Total') }}</div>
                    <div class="mobile-detail-value total">{{ Number::currency($invoiceProduct['product_price'] * $invoiceProduct['quantity'], 'KES') }}</div>
                </div>
            </div>
        </div>
        @else
        <!-- Edit Form Card -->
        <div class="mobile-product-card">
            <div class="mobile-edit-form">
                <div class="mobile-form-group">
                    <label>{{ __('Product') }}</label>
                    <select wire:model.live="invoiceProducts.{{$index}}.product_id">
                        <option value="">-- {{ __('Choose Product') }} --</option>
                        @foreach ($allProducts as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mobile-form-group">
                    <label>{{ __('Quantity') }}</label>
                    <input type="number" wire:model="invoiceProducts.{{$index}}.quantity" min="1">
                </div>
                <div class="mobile-form-actions">
                    @if($invoiceProduct['product_id'])
                    <button type="button" wire:click="saveProduct({{$index}})" class="action-btn action-btn-save">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        {{ __('Save') }}
                    </button>
                    @endif
                    <button type="button" wire:click="removeProduct({{$index}})" class="action-btn action-btn-delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        @endif
    @empty
        <div style="text-align: center; padding: 2rem; color: var(--text-light);">
            <p>{{ __('No products added yet') }}</p>
        </div>
    @endforelse

    <!-- Add Product Button -->
    <button type="button" wire:click="addProduct" class="mobile-add-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        {{ __('Add Product') }}
    </button>

    <!-- Mobile Summary -->
    <div class="mobile-summary">
        <div class="mobile-summary-row">
            <span class="mobile-summary-label">{{ __('Subtotal') }}</span>
            <span class="mobile-summary-value">{{ Number::currency($subtotal, 'KES') }}</span>
        </div>
        <div class="mobile-summary-row">
            <span class="mobile-summary-label">{{ __('Taxes') }}</span>
            <div style="display: flex; align-items: center; gap: 4px;">
                <input wire:model.blur="taxes" type="number" class="mobile-tax-input" min="0" max="100" step="0.01">
                <span>%</span>
            </div>
        </div>
        <div class="mobile-summary-row grand-total">
            <span class="mobile-summary-label">{{ __('Total') }}</span>
            <span class="mobile-summary-value" style="font-size: 1.1rem;">{{ Number::currency($total, 'KES') }}</span>
        </div>
    </div>
</div>

<!-- Desktop Footer -->
<div class="desktop-footer" style="padding: 1.5rem; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 12px;">
    <button type="button" wire:click="updatePurchase" class="btn-update">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
        {{ __('Save Changes') }}
    </button>
    <button type="button" wire:click="approvePurchase" wire:confirm="Are you sure you want to approve this purchase?" class="btn-approve">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
        {{ __('Approve Purchase') }}
    </button>
</div>

<!-- Mobile Sticky Footer -->
<div class="mobile-sticky-footer">
    <button type="button" wire:click="updatePurchase" class="btn-update">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path></svg>
        {{ __('Save') }}
    </button>
    <button type="button" wire:click="approvePurchase" wire:confirm="Are you sure you want to approve this purchase?" class="btn-approve">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
        {{ __('Approve') }}
    </button>
</div>
</div>
