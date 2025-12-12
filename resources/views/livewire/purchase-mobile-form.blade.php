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

    /* Products Card */
    .products-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
        margin-bottom: 1rem;
    }

    .products-card-header {
        background: #f8fafc;
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .products-card-header h2 {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add-product {
        background: var(--accent);
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-add-product:hover {
        background: var(--accent-hover);
    }

    /* Empty State */
    .empty-products {
        text-align: center;
        padding: 2.5rem 1.5rem;
    }

    .empty-products-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1rem;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-products-icon svg {
        width: 28px;
        height: 28px;
        color: var(--text-light);
    }

    .empty-products h3 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0 0 4px;
    }

    .empty-products p {
        font-size: 0.8rem;
        color: var(--text-light);
        margin: 0;
    }

    /* Product Item */
    .product-item {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    /* Saved Product */
    .saved-product {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .saved-product-info {
        flex: 1;
    }

    .saved-product-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .saved-product-details {
        display: flex;
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
    }

    .detail-value {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .detail-value.total {
        color: var(--success);
    }

    .saved-product-actions {
        display: flex;
        gap: 6px;
        margin-left: 12px;
    }

    /* Edit Form */
    .edit-form-group {
        margin-bottom: 1rem;
    }

    .edit-form-group:last-child {
        margin-bottom: 0;
    }

    .edit-form-group label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-light);
        margin-bottom: 6px;
    }

    .edit-form-group select,
    .edit-form-group input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        color: var(--text-dark);
        background: #f8fafc;
        transition: all 0.2s;
    }

    .edit-form-group select:focus,
    .edit-form-group input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        background: white;
    }

    .edit-form-actions {
        display: flex;
        gap: 8px;
        margin-top: 1rem;
    }

    /* Action Buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .action-btn-save {
        background: var(--success-light);
        color: var(--success);
        flex: 1;
        width: auto;
        gap: 6px;
        font-size: 0.8rem;
        font-weight: 600;
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

    /* Summary Card */
    .summary-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .summary-card-header {
        background: #f8fafc;
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .summary-card-header h2 {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .summary-card-body {
        padding: 1rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
    }

    .summary-row.border-top {
        border-top: 1px solid #e2e8f0;
        margin-top: 0.5rem;
        padding-top: 1rem;
    }

    .summary-label {
        font-size: 0.85rem;
        color: var(--text-light);
    }

    .summary-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .summary-row.total .summary-label {
        font-weight: 600;
        color: var(--text-dark);
    }

    .summary-row.total .summary-value {
        font-size: 1.1rem;
        color: var(--success);
    }

    /* Tax Input */
    .tax-input-wrapper {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .tax-input {
        width: 70px;
        padding: 8px 10px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.85rem;
        text-align: right;
        background: #f8fafc;
    }

    .tax-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(30, 27, 75, 0.1);
        background: white;
    }

    .error-text {
        color: var(--danger);
        font-size: 0.75rem;
        margin-top: 4px;
    }
</style>

<!-- Products Card -->
<div class="products-card">
    <div class="products-card-header">
        <h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            {{ __('Products') }}
        </h2>
        <button type="button" wire:click="addProduct" class="btn-add-product">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            {{ __('Add') }}
        </button>
    </div>
    
    <div class="products-card-body">
        @if(empty($invoiceProducts))
        <div class="empty-products">
            <div class="empty-products-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
            </div>
            <h3>{{ __('No products added yet') }}</h3>
            <p>{{ __('Tap "Add" to get started') }}</p>
        </div>
        @else
            @foreach ($invoiceProducts as $index => $invoiceProduct)
            <div class="product-item">
                @if($invoiceProduct['is_saved'])
                <!-- Saved Product Display -->
                <div class="saved-product">
                    <div class="saved-product-info">
                        <div class="saved-product-name">{{ $invoiceProduct['product_name'] }}</div>
                        <div class="saved-product-details">
                            <div class="detail-item">
                                <span class="detail-label">{{ __('Qty') }}</span>
                                <span class="detail-value">{{ $invoiceProduct['quantity'] }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">{{ __('Price') }}</span>
                                <span class="detail-value">{{ number_format($invoiceProduct['product_price'], 2) }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">{{ __('Total') }}</span>
                                <span class="detail-value total">{{ number_format($invoiceProduct['product_price'] * $invoiceProduct['quantity'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="saved-product-actions">
                        <button type="button" wire:click="editProduct({{$index}})" class="action-btn action-btn-edit" title="{{ __('Edit') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </button>
                        <button type="button" wire:click="removeProduct({{$index}})" class="action-btn action-btn-delete" title="{{ __('Remove') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </div>
                
                <!-- Hidden inputs for saved products -->
                <input type="hidden" name="invoiceProducts[{{$index}}][product_id]" value="{{ $invoiceProduct['product_id'] }}">
                <input type="hidden" name="invoiceProducts[{{$index}}][quantity]" value="{{ $invoiceProduct['quantity'] }}">
                <input type="hidden" name="invoiceProducts[{{$index}}][unitcost]" value="{{ $invoiceProduct['product_price'] }}">
                <input type="hidden" name="invoiceProducts[{{$index}}][total]" value="{{ $invoiceProduct['product_price'] * $invoiceProduct['quantity'] }}">
                @else
                <!-- Product Edit Form -->
                <div class="edit-form-group">
                    <label>{{ __('Product') }}</label>
                    <select wire:model.live="invoiceProducts.{{$index}}.product_id" 
                            class="@error('invoiceProducts.' . $index . '.product_id') is-invalid @enderror">
                        <option value="">{{ __('-- Choose Product --') }}</option>
                        @foreach ($allProducts as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('invoiceProducts.' . $index . '.product_id')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="edit-form-group">
                    <label>{{ __('Quantity') }}</label>
                    <input type="number" wire:model="invoiceProducts.{{$index}}.quantity" min="1" step="1">
                </div>
                
                <div class="edit-form-actions">
                    @if($invoiceProduct['product_id'])
                    <button type="button" wire:click="saveProduct({{$index}})" class="action-btn action-btn-save">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        {{ __('Save') }}
                    </button>
                    @endif
                    <button type="button" wire:click="removeProduct({{$index}})" class="action-btn action-btn-delete" title="{{ __('Remove') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    </button>
                </div>
                
                @error('invoiceProducts.' . $index)
                <div class="error-text" style="margin-top: 8px;">{{ $message }}</div>
                @enderror
                @endif
            </div>
            @endforeach
        @endif
    </div>
</div>

<!-- Summary Card -->
@if(!empty($invoiceProducts))
<div class="summary-card">
    <div class="summary-card-header">
        <h2>{{ __('Summary') }}</h2>
    </div>
    <div class="summary-card-body">
        <div class="summary-row">
            <span class="summary-label">{{ __('Subtotal') }}</span>
            <span class="summary-value">{{ Number::currency($subtotal, 'KES') }}</span>
        </div>
        
        <div class="summary-row">
            <span class="summary-label">{{ __('Taxes') }}</span>
            <div class="tax-input-wrapper">
                <input wire:model.blur="taxes" type="number" class="tax-input @error('taxes') is-invalid @enderror" min="0" max="100" placeholder="0">
                <span>%</span>
            </div>
        </div>
        @error('taxes')
        <div class="error-text" style="text-align: right;">{{ $message }}</div>
        @enderror
        
        <div class="summary-row total border-top">
            <span class="summary-label">{{ __('Total') }}</span>
            <span class="summary-value">{{ Number::currency($total, 'KES') }}</span>
            <input type="hidden" name="total_amount" value="{{ $total }}">
        </div>
    </div>
</div>
@endif
</div>