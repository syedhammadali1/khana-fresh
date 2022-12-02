<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">Blog List</h5>
        </div>
        <hr>
        <div class="row g-2">
            <div class="col-md-12">
                @include('atoms.forms.tinymcy',[
                'label'=>'Main Heading',
                'model'=>$page,
                'field'=>'data[blog_listing][heading]',
                'id'=>'blog_listing_heading',
                'rows'=>10
                ])
            </div>
            <div class="col-md-12">
                @include('atoms.forms.tinymcy',[
                'label'=>'Content',
                'model'=>$page,
                'field'=>'data[blog_listing][content]',
                'rows'=>'5'
                ])
            </div>
            <div class="col-md-12">
                <label for="inputState" class="form-label">Select Blogs*</label>
                <select multiple name="blog_ids[]"
                    class="form-select multiple-select   @error('blog_ids') is-invalid @enderror" id="blog_ids"
                    name="blog_ids" data-placeholder="Select coaches">
                    @foreach (getBlogs()->where('locale_id', request()->locale_id)->values()->all()
    as $coach)
                        <option value="{{ $coach->id }}" >{{ $coach->title }}</option>
                    @endforeach
                </select>
                @error('blog_ids')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-12">
                @include('atoms.anchorLink',[
                'label'=>'Add Link (Explore All Articles)',
                'model'=>$page,
                'field'=>'data[blog_listing][view_all_link]',
                ])
            </div>
        </div>
    </div>
</div>

@isset($page)
    @push('scripts')
        <script>
            tinymce.init({
                selector: '#blog_listing_heading',
                menubar: false,
                height: 350,
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | ' +
                    'removeformat',
            })
        </script>
    @endpush

@else
    <script>
        tinymce.init({
            selector: '#blog_listing_heading',
            menubar: false,
            toolbar: 'undo redo | formatselect | ' +
                'forecolor | alignleft aligncenter ' +
                'alignright alignjustify | ' +
                'removeformat',
        })
    </script>
@endisset
