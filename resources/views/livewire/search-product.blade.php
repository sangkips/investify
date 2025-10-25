<div>
    <label for="productDropdown" class="form-label">Select Product</label>
    <select wire:model.live="selectedProduct" 
            id="productDropdown" 
            class="form-select">
        <option value="">Choose a product...</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}">
                {{ $product->name }} ({{ $product->code }}) - KES {{ number_format($product->selling_price, 2) }}
            </option>
        @endforeach
    </select>
    
    @if($products->isEmpty())
        <div class="alert alert-warning mt-2 mb-0">
            No products available
        </div>
    
    @endif
</div>
