@php
$field_dot_key = stringToDotArray($field);
@endphp

<label for="{{ $field_dot_key }}" class="form-label">{{ $label }}</label>
<input type="text" name="{{ $field }}" class="form-control   @error($field_dot_key) is-invalid @enderror"
    value="{{ old($field_dot_key, getValue($model, $field_dot_key)) }}">
@error($field_dot_key)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
