 <label for="{{ $name }}" class="form-label pt-3">{{ $label }}</label>
 <select class="form-select @error($name) is-invalid @enderror" name="{{ $name }}">
     <option value="">Select {{ $label }}</option>
     @foreach ($data as $item)
         <option value="{{ $item->id }}" {{ $value == $item->id ? 'selected' : '' }}>
             {{ $item->name }}
         </option>
     @endforeach
 </select>
 @error($name)
     <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
     </span>
 @enderror
