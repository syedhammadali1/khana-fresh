@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Blog</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Add Blog</h5>
                        </div>
                        <hr>

                        @include('atoms.forms.input', [
                            'name' => 'title',
                            'label' => 'Title',
                            'value' => old('title'),
                            'required' => true,
                            'placeholder' => 'Enter Title',
                        ])

                        <label for="description" class="form-label pt-3">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                            id="description" id="" cols="10" rows="7">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @include('atoms.forms.select', [
                            'name' => 'blog_category_id',
                            'data' => $blog_categories,
                            'label' => 'Category',
                            'value' => old('blog_category_id'),
                        ])

                        <div class="row">
                            <div class="col-12 col-md-6 ">
                                @include('atoms.forms.file', [
                                    'name' => 'file',
                                    'label' => 'Image',
                                    'style' => 'display: none',
                                ])
                            </div>
                            <div class="col-12 col-md-6 mt-md-4">
                                @include('atoms.forms.input', [
                                    'name' => 'featured',
                                    'label' => 'Featured',
                                    'value' => old('featured'),
                                    'type' => 'checkbox',
                                ])
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary col-md-12">Save</button>
                </div>
            </div>
        </div>
    </form>





@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js"
        referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
            selector: 'textarea#description'
        });
    </script>
  
@endpush
