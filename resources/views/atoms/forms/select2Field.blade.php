@php
$field_dot_key = stringToDotArray($field);
@endphp

<label for="{{ $field_dot_key }}" class="form-label">{{ $label }}</label>
<select
    class="form-select @isset($class) {{ $class }} @endisset @error($field_dot_key) is-invalid @enderror"
    name="{{ $field }}">
    @foreach ($data as $item)
        <option value="{{ $item[$option_key] }}">
            {{ $item[$option_value] }}
        </option>
    @endforeach
</select>
@error($field_dot_key)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
