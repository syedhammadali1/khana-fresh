
@php
    $field_name_dot = stringToDotArray($field);
@endphp
<div class="image-upload-body">
    <input type="hidden" name="{{ $field }}" value="{{ old($field_name_dot, $image_id) }}"
        class="form-control">
    <label for="image">{{ $label ?? '' }}</label>
    <input type="file" class="form-control media-upload-image @error($field_name_dot) is-invalid @enderror"
        data-bind="{{ $field }}" id="image">
    @error($field_name_dot)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    {{-- @isset($image)
        <div class="preview-image-body">
            <span class="upload-image-remove" data-image-id="{{$image_id}}"><i class="anticon anticon-close-circle"></i></span>
            <img src="{{ $image }}" class="img-thumbnail mt-2 "style="background: #f9fbfd; width: 200px; height: 200px;object-fit: contain; " />
        </div>
    @endisset --}}

    @if (old($field_name_dot, $image_id))
        @php $media = getMediaById(old($field_name_dot,$image_id)) @endphp
        @if ($media)
            <div class="preview-image-body">
                <span class="upload-image-remove" data-image-id="{{ $media->id }}"><i
                        class="anticon anticon-close-circle"></i></span>
                <img src="{{ $media->getUrl() }}" class="img-thumbnail mt-2"
                    style="background: #f9fbfd; width: 200px; height: 200px;object-fit: contain; " />
            </div>
        @endif
    @endif
</div>
