<select id="inputState" class="form-select  @error('status') is-invalid @enderror" name="status">
    <option value="">Select Status</option>
    <option value="active" @if (old('status', isset($data) && $data->status) == 'active') selected @endif>Active</option>
    <option value="inactive" @if (old('status', isset($data) && $data->status) == 'inactive') selected @endif>Inactive</option>
</select>
@error('status')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
