@extends("layouts.app")


@section('wrapper')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Testimonial</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('testimonials.store') }}" method="POST">
        @csrf
        <input type="hidden" name="locale_parent_id" value="{{ request()->locale_parent_id }}">
        <input type="hidden" name="locale_id" value="{{ request()->locale_id }}">
        <input type="hidden" name="page_id" data-id="page_id" id="page_id" value="">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Add Testimoinal</h5>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            @include('atoms.forms.tinymcy',[
                            'label'=>'Content',
                            'model'=>null,
                            'field'=>'content',
                            'rows'=>'15'
                            ])
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
                                    <option value="publish" @if (old('status', isset($data) && $data->status) == 'publish') selected @endif>Publish</option>
                                    <option value="draft" @if (old('status', isset($data) && $data->status) == 'draft') selected @endif>Draft</option>
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
                            <h5 class="mb-0 text-primary">Coach</h5>
                        </div>
                        <hr>
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Select Coach*</label>
                                <select   data-placeholder="Select Author"  data-allow-clear="true" class="single-select w-100 form-select  @error('coach_id') is-invalid @enderror"
                                    id="coach_id" name="coach_id">
                                    <option value="">Select Coach</option>
                                    @foreach ($coaches as $coach)
                                        <option value="{{ $coach->id }}" @if (old('coach_id') == $coach->id) selected @endif>{{ $coach->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('coach_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
