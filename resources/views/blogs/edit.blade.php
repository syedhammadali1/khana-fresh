@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Edit Blog</h5>
                        </div>
                        <hr>
                        @include('atoms.forms.input', [
                            'name' => 'title',
                            'label' => 'Title',
                            'value' => $blog->title,
                            'required' => true,
                            'placeholder' => 'Enter Title',
                        ])

                        <label for="description" class="form-label pt-3">Description</label>
                        <textarea name="description"  class="form-control @error('description') is-invalid @enderror"
                            id="description" id="" cols="10" rows="7">{{ $blog->description }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @include('atoms.forms.select', [
                            'name' => 'blog_category_id',
                            'data' => $blog_categories,
                            'label' => 'Category',
                            'value' => $blog->blog_category_id,
                        ])

                        <div class="row">
                            <div class="col-12 col-md-6 ">
                                @if ($blog->getFirstMediaUrl('image') == '')
                                    @include('atoms.forms.file', [
                                        'name' => 'file',
                                        'label' => 'Image',
                                        'style' => 'display: none',
                                    ])
                                @else
                                    @include('atoms.forms.file', [
                                        'name' => 'file',
                                        'label' => 'Image',
                                        'src' => $blog->getFirstMediaUrl('image'),
                                    ])
                                @endif
                            </div>
                            <div class="col-12 col-md-6 mt-md-4">
                                @include('atoms.forms.input', [
                                    'name' => 'featured',
                                    'label' => 'Featured',
                                    'value' => $blog->featured,
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
