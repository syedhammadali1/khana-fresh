@php
$field_dot_key = stringToDotArray($field);
@endphp

<button type="button" data-value="{{ old($field_dot_key, getValue($model, $field_dot_key)) }}" data-name="{{ $field }}"
    class="btn btn-primary insert-edit-link-modal">{{ $label }}</button>
<input type="hidden" value="{{ old($field_dot_key, getValue($model, $field_dot_key)) }}" name="{{ $field }}" />
@error($field_dot_key)
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
@error($field_dot_key . '.title')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@error($field_dot_key . '.link')
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
