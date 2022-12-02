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
    <form class="row g-3" action="{{ route('faqs.store') }}" method="POST">
        @csrf
        <input type="hidden" name="locale_parent_id" value="{{ request()->locale_parent_id }}">
        <input type="hidden" name="locale_id" value="{{ request()->locale_id }}">
        <input type="hidden" name="page_id" data-id="page_id" id="page_id" value="{{ $faq->id }}">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Edit Page</h5>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            <label for="question" class="form-label">Title*</label>
                            <input type="text" name="question" value="{{ old('question', $faq->question) }}"
                                class="form-control   @error('question') is-invalid @enderror" id="question">
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            {{-- <div class="slug-body d-flex align-items-center align-content-center">
                                <a class="" href="{{ route('dashboard') }}">
                                    {{ route('dashboard') }}/
                                </a>
                                <div class="slug-create">
                                    <input name="slug" type="text" />
                                    <button class="slug-generate-save">Save</button>
                                </div>
                                <div class="slug-edit">
                                    <button class="slug-generate-edit">Edit</button>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Answer</h5>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <label for="answer" class="form-label">Answer*</label>
                            <textarea type="answer" rows="15" name="answer"
                                class="form-control   @error('answer') is-invalid @enderror" id="content">
                                        {{ old('answer', $faq->answer) }}
                                        </textarea>
                            @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Publish</h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Create At</label>
                                <input type="text" class="form-control" readonly disabled
                                    value="{{ now()->toDayDateTimeString() }}">
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Status*</label>
                                <select id="inputState" class="form-select  @error('status') is-invalid @enderror"
                                    name="status">
                                    <option value="publish" @if (old('status', getValue($faq, 'status')) == 'publish') selected @endif>Publish</option>
                                    <option value="draft" @if (old('status', getValue($faq, 'status')) == 'draft') selected @endif>Draft</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mt-1">
                                <button type="submit" class="btn btn-primary px-5">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Languages</h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mt-1">
                                <label for="inputState" class="form-label">Language*</label>
                                <select readonly disabled id="language" class="form-select" name="language">
                                    @foreach (getLanguages() as $key => $value)
                                        <option value="{{ $value->id }}" @if (old('language', request()->locale_id) == $value->id) selected @endif>
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
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
            selector: '#content',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endpush
