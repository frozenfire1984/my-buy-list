@props([
    'label' => '',
    'name',
    'value' => '',
    'wrapper_class' => '',
    'id' => null,
])

@php
    $id = $id ?? str_replace(['[', ']'], '', $name);
@endphp

<div class="form-item {{ $wrapper_class }}">
    @if($label)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif
    <textarea {{ $attributes->merge(['class' => 'app-textarea']) }} name="{{ $name }}" id="{{ $id }}">{{ $value }}</textarea>
    
    @error($name)
    <div class="form-err">{{ $message }}</div>
    @enderror
</div>



