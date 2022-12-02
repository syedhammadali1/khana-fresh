<label for="formFile" class="form-label  @error($name) text-danger @enderror">{{ $label }}</label>
<input class="form-control @error($name) is-invalid @enderror" type="file" id="formFile" name="{{ $name }}"
    onchange="readURL(this);">
<div style="{{ @$style }}" class=" text-center text-md-start" id="blahdiv">
    <img class="mt-3 blah" id="blah" src="{{ @$src }}" />
</div>

@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
