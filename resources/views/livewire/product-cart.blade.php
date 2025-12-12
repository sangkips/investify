<div>
<style>
    /* Cart Styling */
    .cart-container {
        padding: 1rem;
    }

    /* Desktop Table */
    .cart-table-desktop {
        display: block;
    }

    .cart-table-mobile {
        display: none;
    }

    /* Modern Cart Table */
    .cart-table-wrapper {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: white;
    }

    .cart-table-wrapper::-webkit-scrollbar {
        width: 6px;
    }

    .cart-table-wrapper::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .cart-table-wrapper::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .cart-table-wrapper::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .cart-items-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .cart-items-table thead {
        position: sticky;
        top: 0;
        z-index: 10;
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
    }

    .cart-items-table th {
        padding: 0.875rem 1rem;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        white-space: nowrap;
    }

    .cart-items-table th:first-child {
        text-align: left;
        border-radius: 12px 0 0 0;
    }

    .cart-items-table th:last-child {
        border-radius: 0 12px 0 0;
    }

    .cart-items-table td {
        padding: 0.75rem 1rem;
        color: #1e1b4b;
        border-bottom: 1px solid #f1f5f9;
        text-align: center;
        vertical-align: middle;
    }

    .cart-items-table td:first-child {
        text-align: left;
    }

    .cart-items-table tbody tr {
        transition: background 0.15s;
    }

    .cart-items-table tbody tr:nth-child(even) {
        background: #f8fafc;
    }

    .cart-items-table tbody tr:hover {
        background: #e0e7ff;
    }

    .cart-items-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Product Cell */
    .product-name {
        font-weight: 600;
        color: #1e1b4b;
        font-size: 0.875rem;
        margin-bottom: 4px;
    }

    .product-code {
        display: inline-block;
        font-size: 0.65rem;
        background: #dcfce7;
        color: #16a34a;
        padding: 2px 8px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* Price Cell */
    .price-cell {
        font-weight: 600;
        color: #1e1b4b;
    }

    /* Stock Badge */
    .stock-badge {
        display: inline-block;
        background: #e0e7ff;
        color: #4338ca;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Quantity Input */
    .qty-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .qty-input {
        width: 60px;
        padding: 6px 8px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.875rem;
        text-align: center;
        background: white;
    }

    .qty-input:focus {
        outline: none;
        border-color: #4338ca;
        box-shadow: 0 0 0 2px rgba(67, 56, 202, 0.1);
    }

    .qty-btn {
        width: 28px;
        height: 28px;
        border: none;
        border-radius: 6px;
        background: #4338ca;
        color: white;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s;
    }

    .qty-btn:hover {
        background: #3730a3;
        transform: scale(1.05);
    }

    /* Subtotal */
    .subtotal-cell {
        font-weight: 700;
        color: #16a34a;
    }

    /* Delete Button */
    .delete-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 8px;
        background: #fee2e2;
        color: #ef4444;
        cursor: pointer;
        transition: all 0.15s;
    }

    .delete-btn:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.05);
    }

    /* Empty State */
    .cart-empty-state {
        padding: 3rem 2rem;
        text-align: center;
    }

    .cart-empty-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1rem;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-empty-icon svg {
        width: 28px;
        height: 28px;
        color: #94a3b8;
    }

    .cart-empty-text {
        color: #64748b;
        font-size: 0.9rem;
    }

    /* Summary Section */
    .cart-summary {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
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
        background: #1e1b4b;
        color: white;
        margin: 0.5rem -1rem -1rem;
        padding: 1rem;
        border-radius: 0 0 12px 12px;
    }

    .summary-label {
        font-weight: 500;
        color: #64748b;
        font-size: 0.875rem;
    }

    .summary-row.grand-total .summary-label {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
    }

    .summary-value {
        font-weight: 600;
        color: #1e1b4b;
        font-size: 0.9rem;
    }

    .summary-row.grand-total .summary-value {
        color: white;
        font-size: 1.1rem;
    }

    /* Input Fields */
    .cart-inputs {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .cart-input-group label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    .cart-input-group input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        background: white;
        transition: all 0.2s;
    }

    .cart-input-group input:focus {
        outline: none;
        border-color: #1e1b4b;
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }

    /* Mobile Cart Cards */
    .cart-item-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.75rem;
    }

    .cart-item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
    }

    .cart-item-name {
        font-weight: 600;
        color: #1e1b4b;
        font-size: 0.9rem;
    }

    .cart-item-code {
        font-size: 0.7rem;
        background: #dcfce7;
        color: #22c55e;
        padding: 2px 8px;
        border-radius: 20px;
        display: inline-block;
        margin-top: 4px;
    }

    .cart-item-delete {
        background: #fee2e2;
        color: #ef4444;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .cart-item-delete:hover {
        background: #ef4444;
        color: white;
    }

    .cart-item-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    .cart-item-detail {
        display: flex;
        flex-direction: column;
    }

    .cart-item-detail-label {
        font-size: 0.7rem;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .cart-item-detail-value {
        font-weight: 600;
        color: #1e1b4b;
        font-size: 0.85rem;
    }

    .cart-item-detail-value.highlight {
        color: #22c55e;
    }

    /* Empty State */
    .cart-empty {
        text-align: center;
        padding: 2rem;
        color: #ef4444;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .cart-table-desktop {
            display: none;
        }

        .cart-table-mobile {
            display: block;
        }

        .cart-container {
            padding: 1rem;
        }

        .cart-inputs {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .summary-row {
            padding: 0.625rem 0;
        }

        .summary-label,
        .summary-value {
            font-size: 0.85rem;
        }

        .cart-input-group input {
            padding: 12px 14px;
        }
    }
</style>

    <div>
        @if (session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    <span>{{ session('message') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        @endif

        <!-- Desktop Table View -->
        <div class="cart-table-desktop">
            <div class="cart-table-wrapper position-relative">
                <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.7);z-index: 99;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <table class="cart-items-table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Stock</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if($cart_items->isNotEmpty())
                            @foreach($cart_items as $cart_item)
                                <tr>
                                    <td>
                                        <div class="product-name">{{ $cart_item->name }}</div>
                                        <span class="product-code">{{ $cart_item->options->code }}</span>
                                        @include('livewire.includes.product-cart-modal')
                                    </td>

                                    <td>
                                        <span class="price-cell">{{ format_currency($cart_item->price / 1.16) }}</span>
                                    </td>

                                    <td>
                                        <span class="stock-badge">{{ $cart_item->options->stock }}</span>
                                    </td>

                                    <td>
                                        @include('livewire.includes.product-cart-quantity')
                                    </td>

                                    <td>
                                        <span class="subtotal-cell">{{ format_currency($cart_item->options->sub_total / 1.16) }}</span>
                                    </td>

                                    <td>
                                        <button type="button" wire:click="removeItem('{{ $cart_item->rowId }}')" class="delete-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <div class="cart-empty-state">
                                        <div class="cart-empty-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                        </div>
                                        <div class="cart-empty-text">Please search & select products to add them here</div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="cart-table-mobile">
            <div class="cart-container">
                @if($cart_items->isNotEmpty())
                    @foreach($cart_items as $cart_item)
                        <div class="cart-item-card">
                            <div class="cart-item-header">
                                <div>
                                    <div class="cart-item-name">{{ $cart_item->name }}</div>
                                    <span class="cart-item-code">{{ $cart_item->options->code }}</span>
                                </div>
                                <button type="button" wire:click="removeItem('{{ $cart_item->rowId }}')" class="cart-item-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                            <div class="cart-item-details">
                                <div class="cart-item-detail">
                                    <span class="cart-item-detail-label">Price</span>
                                    <span class="cart-item-detail-value">{{ format_currency($cart_item->price) }}</span>
                                </div>
                                <div class="cart-item-detail">
                                    <span class="cart-item-detail-label">Qty</span>
                                    <span class="cart-item-detail-value">{{ $cart_item->qty }}</span>
                                </div>
                                <div class="cart-item-detail">
                                    <span class="cart-item-detail-label">Stock</span>
                                    <span class="cart-item-detail-value">{{ $cart_item->options->stock }}</span>
                                </div>
                                <div class="cart-item-detail">
                                    <span class="cart-item-detail-label">Sub Total</span>
                                    <span class="cart-item-detail-value highlight">{{ format_currency($cart_item->options->sub_total / 1.16) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="cart-empty">
                        <span>Please search & select products!</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="cart-container">
        <!-- Summary Section -->
        @php
            // Get the cart subtotal (sum of all item sub_totals) - this is VAT inclusive
            // Note: sub_total already includes qty for each item
            $subtotal = 0;
            foreach(Cart::instance($cart_instance)->content() as $item) {
                $subtotal += $item->options->sub_total;
            }
            
            // Ensure shipping is numeric
            $shipping_amount = (float) preg_replace('/[^0-9.]/', '', $shipping ?? 0);
            
            // Calculate discount amount (percentage of subtotal)
            $discount_percentage = (float) ($global_discount ?? 0);
            $discount_amount = $subtotal * ($discount_percentage / 100);
            
            // Subtotal after discount
            $subtotal_after_discount = $subtotal - $discount_amount;
            
            // VAT is already included in prices (16%) - extract it for display
            // VAT amount = subtotal_after_discount - (subtotal_after_discount / 1.16)
            $vat_amount = $subtotal_after_discount - ($subtotal_after_discount / 1.16);
            
            // Grand total = subtotal - discount + shipping (no additional tax since it's already included)
            $grand_total = $subtotal_after_discount + $shipping_amount;
            
            // Store discount amount in session for use elsewhere
            Session::put('cart_discount_amount', $discount_amount);
        @endphp

        <div class="cart-summary">
            <div class="summary-row">
                <span class="summary-label">Subtotal (VAT Incl.)</span>
                <span class="summary-value">{{ format_currency($subtotal) }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Discount ({{ $global_discount }}%)</span>
                <span class="summary-value">(-) {{ format_currency($discount_amount) }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">VAT (16% Incl.)</span>
                <span class="summary-value">{{ format_currency($vat_amount) }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Shipping</span>
                <input type="hidden" value="{{ $shipping_amount }}" name="shipping_amount">
                <span class="summary-value">(+) {{ format_currency($shipping_amount) }}</span>
            </div>
            <div class="summary-row grand-total">
                <span class="summary-label">Grand Total</span>
                <span class="summary-value">(=) {{ format_currency($grand_total) }}</span>
            </div>
        </div>

        <input type="hidden" name="total_amount" value="{{ $grand_total }}">
        <input type="hidden" name="tax_percentage" value="16">

        <!-- Input Fields -->
        <div class="cart-inputs">

            <div class="cart-input-group">
                <label for="discount_percentage">Discount (%)</label>
                <input wire:model.blur="global_discount" type="number" name="discount_percentage" id="discount_percentage" min="0" max="100" value="{{ $global_discount }}" required>
            </div>

            <div class="cart-input-group">
                <label for="shipping_amount">Shipping</label>
                <input wire:model.blur="shipping" type="number" name="shipping_amount" id="shipping_amount" min="0" value="0" required step="0.01">
            </div>
        </div>
    </div>
</div>
