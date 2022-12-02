@if (isset($type) && $type == 'checkbox')
    <div class="form-check my-3 @isset($classlabel) {{ $classlabel }} @endisset"
        style="user-select: auto;">
        <input class="form-check-input d-none" type="hidden" name="{{ $name }}" value="0"
            style="user-select: auto;">
        <input class="form-check-input" type="checkbox" name="{{ $name }}" {{ $value == 1 ? 'checked' : '' }}
            value="1" style="user-select: auto;">
        <label class="form-check-label" for="formCheck1" style="user-select: auto;">
            {{ $label }}
        </label>
    </div>
@else
    <label for="{{ $name }}"
        class="form-label @error($name) text-danger @enderror  @isset($classlabel) {{ $classlabel }} @endisset ">{{ $label }}
        @isset($required)
            *
        @endisset
    </label>
    <input name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
        class="form-control @error($name) is-invalid @enderror @isset($classinput) {{ $classinput }} @endisset"
        @isset($type) type="{{ $type }}" @else type="text" @endisset
        @isset($required) required @endisset
        @isset($disabled) disabled @endisset
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        @isset($others) {{ $others }} @endisset>
@endif

@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
