<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">Coach Directory</h5>
        </div>
        <hr>
        <div class="row g-2">
            <div class="col-md-12">
                @include('atoms.forms.tinymcy',[
                'label'=>'Main Heading',
                'model'=>$page,
                'field'=>'data[coaches_listing][heading]',
                'id'=>'coaches_listing_heading'
                ])
            </div>
            <div class="col-md-12">
                @include('atoms.forms.tinymcy',[
                'label'=>'Content',
                'model'=>$page,
                'field'=>'data[coaches_listing][content]',
                'rows'=>'5'
                ])
            </div>
            <div class="col-md-12">
                <label for="inputState" class="form-label">Select Coaches*</label>
                <select multiple name="coach_ids[]"
                    class="form-select multiple-select   @error('coach_ids') is-invalid @enderror" id="coach_ids"
                    name="coach_ids" data-placeholder="Select coaches">
                    @foreach (getCoaches()->where('locale_id', request()->locale_id)->values()->all()
    as $coach)
                        <option value="{{ $coach->id }}" >{{ $coach->full_name }}</option>
                    @endforeach
                </select>
                @error('coach_ids')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-12">
                @include('atoms.anchorLink',[
                'label'=>'Add Link (View All Coaches Profiles)',
                'model'=>$page,
                'field'=>'data[coaches][view_all_link]',
                ])
            </div>
        </div>
    </div>
</div>

@isset($page)
    @push('scripts')
        <script>
            tinymce.init({
                selector: '#coaches_listing_heading',
                menubar: false,
                height: 150,
                toolbar: 'undo redo | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | ' +
                    'removeformat',
            })
        </script>
    @endpush

@else
    <script>
        tinymce.init({
            selector: '#coaches_listing_heading',
            menubar: false,
            toolbar: 'undo redo | ' +
                'forecolor | alignleft aligncenter ' +
                'alignright alignjustify | ' +
                'removeformat',
        })
    </script>
@endisset
