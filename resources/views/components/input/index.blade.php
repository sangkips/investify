@props([
'label' => null ?? ucfirst($name),
'type' => null ?? 'text',
'name',
'id' => null ?? $name,
'placeholder' => null,
'autocomplete' => null ?? 'off',
'readonly' => false,
'disabled' => false,
'required' => false,
'value' => null ?? old($name),
'min' => null
])
<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes->merge(['class' => 'form-control']) }} @if($min !==null) min="{{ $min }}" @endif>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror

</div>