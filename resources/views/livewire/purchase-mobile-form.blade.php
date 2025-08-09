<div>
    <!-- Products Card -->
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="card-title mb-0">{{ __('Products') }}</h6>
            <button type="button" wire:click="addProduct" class="btn btn-success btn-sm">
                <i class="ti ti-plus"></i> {{ __('Add Product') }}
            </button>
        </div>
        <div class="card-body p-0">
            @if(empty($invoiceProducts))
                <div class="text-center py-4 text-muted">
                    <i class="ti ti-package-off" style="font-size: 2rem;"></i>
                    <p class="mb-0 mt-2">{{ __('No products added yet') }}</p>
                    <small>{{ __('Click "Add Product" to get started') }}</small>
                </div>
            @else
                @foreach ($invoiceProducts as $index => $invoiceProduct)
                <div class="border-bottom p-3">
                    @if($invoiceProduct['is_saved'])
                        <!-- Saved Product Display -->
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $invoiceProduct['product_name'] }}</h6>
                                <div class="row g-2 text-muted small">
                                    <div class="col-4">
                                        <span class="d-block">{{ __('Qty') }}</span>
                                        <strong>{{ $invoiceProduct['quantity'] }}</strong>
                                    </div>
                                    <div class="col-4">
                                        <span class="d-block">{{ __('Price') }}</span>
                                        <strong>{{ number_format($invoiceProduct['product_price'], 2) }}</strong>
                                    </div>
                                    <div class="col-4">
                                        <span class="d-block">{{ __('Total') }}</span>
                                        <strong class="text-primary">{{ number_format($invoiceProduct['product_price'] * $invoiceProduct['quantity'], 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-1 ms-2">
                                <button type="button" wire:click="editProduct({{$index}})" class="btn btn-outline-warning btn-sm">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button type="button" wire:click="removeProduct({{$index}})" class="btn btn-outline-danger btn-sm">
                                    <i class="ti ti-trash"></i>
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
                        <div class="mb-3">
                            <label class="form-label">{{ __('Product') }}</label>
                            <select wire:model.live="invoiceProducts.{{$index}}.product_id" 
                                    class="form-select @error('invoiceProducts.' . $index . '.product_id') is-invalid @enderror">
                                <option value="">{{ __('-- Choose Product --') }}</option>
                                @foreach ($allProducts as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('invoiceProducts.' . $index . '.product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">{{ __('Quantity') }}</label>
                            <input type="number" wire:model="invoiceProducts.{{$index}}.quantity" 
                                   class="form-control" min="1" step="1">
                        </div>
                        
                        <div class="d-flex gap-2">
                            @if($invoiceProduct['product_id'])
                            <button type="button" wire:click="saveProduct({{$index}})" class="btn btn-success btn-sm flex-fill">
                                <i class="ti ti-check"></i> {{ __('Save') }}
                            </button>
                            @endif
                            <button type="button" wire:click="removeProduct({{$index}})" class="btn btn-outline-danger btn-sm">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                        
                        @error('invoiceProducts.' . $index)
                        <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    @endif
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Summary Card -->
    @if(!empty($invoiceProducts))
    <div class="card">
        <div class="card-header">
            <h6 class="card-title mb-0">{{ __('Summary') }}</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <span class="text-muted">{{ __('Subtotal') }}</span>
                </div>
                <div class="col-6 text-end">
                    <strong>{{ Number::currency($subtotal, 'KES') }}</strong>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-6">
                    <label for="taxes" class="form-label mb-0">{{ __('Taxes') }}</label>
                </div>
                <div class="col-6">
                    <div class="input-group input-group-sm">
                        <input wire:model.blur="taxes" type="number" id="taxes" 
                               class="form-control text-end @error('taxes') is-invalid @enderror" 
                               min="0" max="100" placeholder="0">
                        <span class="input-group-text">%</span>
                    </div>
                    @error('taxes')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-6">
                    <strong>{{ __('Total') }}</strong>
                </div>
                <div class="col-6 text-end">
                    <strong class="text-primary fs-5">{{ Number::currency($total, 'KES') }}</strong>
                    <input type="hidden" name="total_amount" value="{{ $total }}">
                </div>
            </div>
        </div>
    </div>
    @endif
</div>