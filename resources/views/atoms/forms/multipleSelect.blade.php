 <label for="{{ $name }}" class="form-label pt-3">{{ $label }}</label>
 <select multiple class="form-select @error($name) is-invalid @enderror" name="{{ $name }}[]"
     id="{{ $name }}">
     @foreach ($data as $item)
         <option value="{{ $item->id }}" {{ collect($value)->contains($item->id) ? 'selected' : '' }}>
             {{ $item->name }}
         </option>
     @endforeach
 </select>
 @error($name)
     <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
     </span>
 @enderror


 @isset($withInputList)
     <div id="list{{ $name }}" class="row pt-2">
     </div>
     @error($withInputList)
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
         </span>
     @enderror

     <script>
         var name = {!! json_encode($name) !!};
         var listname = {!! json_encode($withInputList) !!};
         $('#' + name).blur(function() {
             $('#list' + name).html('');
             $('option:selected', $(this)).each(function() {
                 var markup = '<div class="col-3 text-center mt-2">' + $(this).html() +
                     '</div> <div class="col-9 mt-2"> <input class="form-control" type="text" name="' +
                     listname + '[]" placeholder="Enter Ammout" required ></div>';
                 $('#list' + name).append(markup);
             });
         });

         $(window).on("load", function() {
             var oldval = {!! json_encode($valueInputList) !!};
             var key = 0;
             $('#list' + name).html('');
             $("#" + name + " :selected").each(function() {
                 var markup = '<div class="col-3 text-center mt-2">' + $(this).html() +
                     '</div> <div class="col-9 mt-2"> <input class="form-control" type="text" name="' +
                     listname + '[]" placeholder="Enter Ammout" required value="' +
                     oldval[key] + '" ></div>';
                 $('#list' + name).append(markup);
                 key++;
             });
         });
     </script>
 @endisset
