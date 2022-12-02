<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">Testimonials</h5>
        </div>
        <hr>
        <div class="row g-2">
            <div class="col-md-12">
                @include('atoms.forms.tinymcy',[
                'label'=>'Main Heading',
                'model'=>$page,
                'field'=>'data[testimonials_listing][heading]',
                'id'=>'testimonials_listing_heading'
                ])
            </div>
            <div class="col-md-12">
                <label for="inputState" class="form-label">Select Testimonials*</label>
                <select multiple name="testimonial_ids[]"
                    class="form-select multiple-select   @error('testimonial_ids') is-invalid @enderror"
                    id="testimonial_ids" name="testimonial_ids" data-placeholder="Select Testimonials">
                    @foreach (getTestimonials()->where('locale_id', request()->locale_id)->values()->all()
    as $testimonial)
                        <option value="{{ $testimonial->id }}">
                            {{ Str::limit($testimonial->content, 20, ' (...)') }}</option>
                    @endforeach
                </select>
                @error('testimonial_ids')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-12">
                @include('atoms.anchorLink',[
                'label'=>'Add Link (View All Testimonials)',
                'model'=>$page,
                'field'=>'data[testimonials_listing][view_all_link]',
                ])
            </div>
        </div>
    </div>
</div>

@isset($page)
    @push('scripts')
        <script>
            tinymce.init({
                selector: '#testimonials_listing_heading',
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
            selector: '#testimonials_listing_heading',
            menubar: false,
            toolbar: 'undo redo | ' +
                'forecolor | alignleft aligncenter ' +
                'alignright alignjustify | ' +
                'removeformat',
        })
    </script>
@endisset
