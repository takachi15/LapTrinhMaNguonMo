@props(['name', 'label' => null, 'type' => 'text', 'value' => ''])

<div class="form-group">
    <label class="form-label">{{ $label ?? ucfirst($name) }}</label>
    
    <input type="{{ $type }}" 
           name="{{ $name }}" 
           value="{{ old($name, $value) }}" 
           class="form-input">

    @error($name)
        <div class="form-error">{{ $message }}</div>
    @enderror
</div>

<style>
    .form-group {
        margin: 8px 0 4px;
    }
    .form-label {
        display: block;
        margin-bottom: 4px;
    }
    .form-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
    }
    .form-error {
        color: #991B1B;
        margin-top: 4px;
    }
</style>