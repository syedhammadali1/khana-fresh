<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">Page Banner</h5>
        </div>
        <hr>
        <div class="row">

            <div class="col-md-6">
                @include('atoms.forms.textField',[
                'label'=>'Main Heading',
                'model'=>$page,
                'field'=>'data[main_heading]',
                ])
            </div>

            <div class="col-md-6">
                @include('atoms.forms.textField',[
                'label'=>'Highlight Main Heading',
                'model'=>$page,
                'field'=>'data[highlight_main_heading]',
                ])
            </div>

            <div class="col-md-12 mt-2">
                <label for="content" class="form-label">Content*</label>
                <textarea rows="5" name="data[content]"
                    class="form-control   @error('data.content') is-invalid @enderror" id="home_data_banner_content">
                {{ old('data.content', getValue($page, 'data.content')) }}
            </textarea>
                @error('data.content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- <div class="col-6">
            @include('atoms.mediaUpload',[
            'image_id'=>getValue($page, 'data.banner_image'),
            'field_name'=>"data[banner_image]",
            'field_name_dot'=>'data.banner_image',
            'field_label'=>'Banner Image'
            ])
        </div>
        <div>
            @include('atoms.anchorLink',[
            'value'=>getValue($page, 'data.link'),
            'field_name'=>'data[link]',
            'field_name_dot'=>'data.link',
            "label"=>'Link'
            ])
        </div> --}}
    </div>
</div>
<script>
    @isset($page)

        window.onload = () => {
        tinymce.init({
        selector: '#home_data_banner_content',
        menubar: false,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor forecolor | alignleft aligncenter ' +
        'alignright alignjustify | ' +
        'removeformat',
        });
        };

    @else
        tinymce.init({
        selector: '#home_data_banner_content',
        menubar: false,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor forecolor | alignleft aligncenter ' +
        'alignright alignjustify | ' +
        'removeformat',
        });
    @endisset
</script>
