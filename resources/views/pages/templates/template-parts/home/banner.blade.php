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

            <div class="col-md-12">
                @include('atoms.forms.tinymcy',[
                'label'=>'Content',
                'model'=>$page,
                'field'=>'data[content]',
                'id'=>'home_data_banner_content'
                ])
            </div>
        </div>
    </div>
</div>

@isset($page)

    @push('scripts')
        <script>
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
            })
        </script>
    @endpush
@else
    <script>
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
        })
    </script>
@endisset
