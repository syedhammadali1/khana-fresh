<div class="card">
    <div class="card-body">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">
                Take The Happiness Quiz Now!
            </h5>
        </div>
        <hr>
        <div class="row g-2">
            <div class="col-md-12">
                @include('atoms.forms.tinymcy',[
                'label'=>'Main Heading',
                'model'=>$page,
                'field'=>'data[quiz_test][heading]',
                'id'=>'quiz_test_heading',
                'rows'=>10
                ])
            </div>
            <div class="col-md-6">
                @include('atoms.forms.tinymcy',[
                'label'=>'Left Content',
                'model'=>$page,
                'field'=>'data[quiz_test][left_content]',
                'rows'=>'5'
                ])
            </div>
            <div class="col-md-6">
                @include('atoms.forms.tinymcy',[
                'label'=>'Right Content',
                'model'=>$page,
                'field'=>'data[quiz_test][right_content]',
                'rows'=>'5'
                ])
            </div>
            <div class="col-md-12">
                @include('atoms.anchorLink',[
                'label'=>'Add Link (Start The Test)',
                'model'=>$page,
                'field'=>'data[quiz_test][link]',
                ])
            </div>
        </div>
    </div>
</div>

@isset($page)
    @push('scripts')
        <script>
            tinymce.init({
                selector: '#quiz_test_heading',
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
            selector: '#quiz_test_heading',
            menubar: false,
            toolbar: 'undo redo | formatselect | ' +
                'forecolor | alignleft aligncenter ' +
                'alignright alignjustify | ' +
                'removeformat',
        })
    </script>
@endisset
