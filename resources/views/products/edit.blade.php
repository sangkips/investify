@extends('layouts.tabler')

@section('content')
<style>
    .page-body {
        background: linear-gradient(135deg, #fef3e2 0%, #e0e7ff 100%);
        min-height: 100vh;
        padding: 2rem 0;
        padding-bottom: 100px; /* Space for sticky buttons */
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
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .card-footer {
        background: transparent;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }
    
    .form-label {
        font-weight: 500;
        color: #334155;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 0.625rem 1rem;
        transition: all 0.2s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #1e1b4b;
        box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
    }
    
    /* Image upload area */
    .image-upload-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 150px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .image-upload-container:hover {
        border-color: #1e1b4b;
        background: linear-gradient(135deg, #fef3e2 0%, #e0e7ff 100%);
    }
    
    .image-upload-container .upload-icon {
        width: 48px;
        height: 48px;
        color: #94a3b8;
        margin-bottom: 0.75rem;
    }
    
    .image-upload-container .upload-text {
        color: #64748b;
        font-size: 0.875rem;
        text-align: center;
    }
    
    .img-account-profile {
        width: 100%;
        max-height: 200px;
        object-fit: contain;
        border-radius: 12px;
        background: #f8fafc;
    }
    
    .image-preview-wrapper {
        display: block;
        margin-bottom: 1rem;
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
    
    .sticky-action-buttons .btn-save {
        background: #f59e0b;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    
    .sticky-action-buttons .btn-save:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
    }
    
    .sticky-action-buttons .btn-cancel {
        background: #dc2626;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        color: #ffffff;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
    
    .sticky-action-buttons .btn-cancel:hover {
        background: #b91c1c;
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4);
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
        
        .sticky-action-buttons .btn-save,
        .sticky-action-buttons .btn-cancel {
            flex: 1;
            justify-content: center;
            text-align: center;
            padding: 0.875rem 1rem;
        }
        
        .image-upload-container {
            min-height: 120px;
            padding: 1rem;
        }
        
        .image-upload-container .upload-icon {
            width: 36px;
            height: 36px;
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
        <x-alert />

        <div class="row row-cards">
            <form action="{{ route('products.update', $product->uuid) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Product Image') }}
                                </h3>

                                <!-- Image preview -->
                                <div class="image-preview-wrapper mb-3" id="image-preview-wrapper">
                                    <img class="img-account-profile" src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('assets/img/products/default.png') }}" alt="Product preview" id="image-preview" />
                                </div>

                                <input type="file" accept="image/*" id="image" name="product_image" class="form-control @error('product_image') is-invalid @enderror" onchange="previewImage();" style="display: none;">
                                
                                <button type="button" class="btn btn-outline-secondary w-100" onclick="document.getElementById('image').click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    Change Image
                                </button>

                                @error('product_image')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h3 class="card-title">
                                        {{ __('Edit Product') }}
                                    </h3>
                                </div>

                                <div class="card-actions">
                                    <a href="{{ route('products.index') }}" class="btn-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M18 6l-12 12"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">
                                                {{ __('Name') }}
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Product name" value="{{ old('name', $product->name) }}">

                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">
                                                Product category
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                                <option selected="" disabled="">Select a category:</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if (old('category_id', $product->category_id) == $category->id) selected="selected" @endif>
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="unit_id">
                                                {{ __('Unit') }}
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select name="unit_id" id="unit_id" class="form-select @error('unit_id') is-invalid @enderror">
                                                <option selected="" disabled="">
                                                    Select a unit:
                                                </option>

                                                @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}" @if (old('unit_id', $product->unit_id) == $unit->id) selected="selected" @endif>
                                                    {{ $unit->name }}
                                                </option>
                                                @endforeach
                                            </select>

                                            @error('unit_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="buying_price">
                                                Buying price
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text" id="buying_price" name="buying_price" class="form-control @error('buying_price') is-invalid @enderror" placeholder="0" value="{{ old('buying_price', $product->buying_price) }}">

                                            @error('buying_price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="selling_price" class="form-label">
                                                Selling price
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text" id="selling_price" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" placeholder="0" value="{{ old('selling_price', $product->selling_price) }}">

                                            @error('selling_price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">
                                                {{ __('Quantity') }}
                                            </label>

                                            <input class="form-control" name="quantity" type="text" readonly value="{{ old('quantity', $product->quantity) }}" style="color: var(--tblr-secondary); background-color: #f1f5f9; opacity: 1;" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="quantity_alert" class="form-label">
                                                {{ __('Quantity Alert') }}
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="number" id="quantity_alert" name="quantity_alert" class="form-control @error('quantity_alert') is-invalid @enderror" min="0" placeholder="0" value="{{ old('quantity_alert', $product->quantity_alert) }}">

                                            @error('quantity_alert')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="tax" class="form-label">
                                                {{ __('Tax %') }}
                                            </label>

                                            <input type="number" id="tax" name="tax" class="form-control @error('tax') is-invalid @enderror" min="0" placeholder="0" value="{{ old('tax', $product->tax) }}">

                                            @error('tax')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="tax_type">
                                                {{ __('Tax Type') }}
                                            </label>

                                            <select name="tax_type" id="tax_type" class="form-select @error('tax_type') is-invalid @enderror">
                                                @foreach (\App\Enums\TaxType::cases() as $taxType)
                                                <option value="{{ $taxType->value }}" @selected(old('tax_type', $product->tax_type) == $taxType->value)>
                                                    {{ $taxType->label() }}
                                                </option>
                                                @endforeach
                                            </select>

                                            @error('tax_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">
                                                {{ __('Notes') }}
                                            </label>

                                            <textarea name="notes" id="notes" rows="5" class="form-control @error('notes') is-invalid @enderror" placeholder="Product notes">{{ old('notes', $product->notes) }}</textarea>

                                            @error('notes')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end desktop-buttons">
                                <!-- Hidden - we use sticky buttons instead -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unified Sticky Action Buttons (Desktop & Mobile) -->
                <div class="sticky-action-buttons">
                    <a class="btn-cancel" href="{{ url()->previous() }}">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn-save">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        {{ __('Update Product') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
<script>
    // Enhanced image preview function
    function previewImage() {
        const input = document.getElementById('image');
        const preview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush