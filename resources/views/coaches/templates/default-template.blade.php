<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">Content</h5>
        </div>
        <hr>

        <div class="col-md-12">
            <label for="content" class="form-label">Content*</label>
            <textarea type="content" rows="15" name="content" value="{{ old('content') }}"
                class="form-control   @error('content') is-invalid @enderror" id="content">
            {{ old('content') }}
            </textarea>
            @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
