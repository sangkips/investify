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

    /* Saved Product Name */
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
        transform: translateY(-2px);
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

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .products-table th,
        .products-table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }

        .qty-input {
            width: 60px;
            padding: 8px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
        }

        .product-select {
            font-size: 0.8rem;
            padding: 8px 10px;
        }
    }
</style>

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
                <input type="hidden" name="invoiceProducts[{{$index}}][product_id]" value="{{ $invoiceProduct['product_id'] }}">
                <span class="product-name">{{ $invoiceProduct['product_name'] }}</span>
                @else
                <select wire:model.live="invoiceProducts.{{$index}}.product_id" 
                        id="invoiceProducts[{{$index}}][product_id]" 
                        class="product-select @error('invoiceProducts.' . $index . '.product_id') is-invalid @enderror">
                    <option value="">-- {{ __('Choose Product') }} --</option>
                    @foreach ($allProducts as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('invoiceProducts.' . $index)
                <div class="error-text">{{ $message }}</div>
                @enderror
                @endif
            </td>

            <td class="text-center">
                @if($invoiceProduct['is_saved'])
                <span class="price-display">{{ $invoiceProduct['quantity'] }}</span>
                <input type="hidden" name="invoiceProducts[{{$index}}][quantity]" value="{{ $invoiceProduct['quantity'] }}">
                @else
                <input type="number" wire:model="invoiceProducts.{{$index}}.quantity" 
                       id="invoiceProducts[{{$index}}][quantity]" 
                       class="qty-input" min="1" />
                @endif
            </td>

            <td class="text-center">
                @if($invoiceProduct['is_saved'])
                <span class="price-display">{{ $unit_cost = number_format($invoiceProduct['product_price'], 2) }}</span>
                <input type="hidden" name="invoiceProducts[{{$index}}][unitcost]" value="{{ $unit_cost }}">
                @endif
            </td>

            <td class="text-center">
                <span class="total-display">{{ $product_total = $invoiceProduct['product_price'] * $invoiceProduct['quantity'] }}</span>
                <input type="hidden" name="invoiceProducts[{{$index}}][total]" value="{{ $product_total }}">
            </td>

            <td class="text-center">
                <div class="action-buttons">
                    @if($invoiceProduct['is_saved'])
                    <button type="button" wire:click="editProduct({{$index}})" class="action-btn action-btn-edit" title="{{ __('Edit') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </button>
                    @elseif($invoiceProduct['product_id'])
                    <button type="button" wire:click="saveProduct({{$index}})" class="action-btn action-btn-save" title="{{ __('Save') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </button>
                    @endif

                    <button type="button" wire:click="removeProduct({{$index}})" class="action-btn action-btn-delete" title="{{ __('Remove') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach

        <!-- Add Product Row -->
        <tr class="add-product-row">
            <td colspan="4"></td>
            <td class="text-center">
                <button type="button" wire:click="addProduct" class="action-btn action-btn-add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    {{ __('Add') }}
                </button>
            </td>
        </tr>

        <!-- Subtotal Row -->
        <tr class="totals-row">
            <th colspan="4">{{ __('Subtotal') }}</th>
            <td class="text-center total-display">{{ Number::currency($subtotal, 'KES') }}</td>
        </tr>

        <!-- Taxes Row -->
        <tr class="totals-row">
            <th colspan="4">{{ __('Taxes') }}</th>
            <td>
                <div class="tax-input-wrapper">
                    <input wire:model.blur="taxes" type="number" id="taxes" class="tax-input" min="0" max="100">
                    <span>%</span>
                </div>
                @error('taxes')
                <div class="error-text">{{ $message }}</div>
                @enderror
            </td>
        </tr>

        <!-- Grand Total Row -->
        <tr class="totals-row grand-total">
            <th colspan="4">{{ __('Total') }}</th>
            <td class="text-center" style="font-size: 1.1rem;">
                {{ Number::currency($total, 'KES') }}
                <input type="hidden" name="total_amount" value="{{ $total }}">
            </td>
        </tr>
    </tbody>
</table>
</div>