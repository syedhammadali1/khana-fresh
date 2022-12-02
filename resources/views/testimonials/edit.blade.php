@extends("layouts.app")


@section('wrapper')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('testimonials.store') }}" method="POST">
        @csrf
        <input type="hidden" name="locale_parent_id" value="{{ request()->locale_parent_id }}">
        <input type="hidden" name="locale_id" value="{{ request()->locale_id }}">
        <input type="hidden" name="page_id" data-id="page_id" id="page_id" value="{{ $testimonial->id }}">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Edit Testimoinal</h5>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            @include('atoms.forms.tinymcy',[
                            'label'=>'Content',
                            'model'=>$testimonial,
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
                                    value="{{ $testimonial->created_at->toDayDateTimeString() }}">
                            </div>
                            <div class="col-12 mt-1">
                                <button type="submit" class="btn btn-primary px-5">Update</button>
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
                                <label for="inputState" class="form-label">Author*</label>
                                <select   data-placeholder="Select Author"  data-allow-clear="true" class="single-select w-100 form-select  @error('coach_id') is-invalid @enderror"
                                    id="coach_id" name="coach_id">
                                    <option value="">Select Author</option>
                                    @foreach ($coaches as $coach)
                                        <option value="{{ $coach->id }}" @if (old('coach_id', $testimonial->coach_id) == $coach->id) selected @endif>{{ $coach->full_name }}
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
                                @foreach (getLanguages() as $language)
                                    @if ($testimonial->locale_id !== $language->id)
                                        @if (in_array($language->id, $testimonial->languages->pluck('locale_id')->toArray()))
                                            <a class="d-block"
                                                href="{{ route('testimonials.edit', [
                                                    'testimonial' => $testimonial->languages->where('locale_id', $language->id)->first()->id,
                                                    'locale_id' => $language->id,
                                                    'locale_parent_id' => $testimonial->locale_parent_id,
                                                ]) }}">
                                                <i class="bx bxs-edit"></i>
                                                {{ $language->name }}
                                            </a>
                                        @else
                                            @php
                                                $local_parent_id = $testimonial->languages->where('locale_id', request()->locale_id)->first();
                                                $locoale_parent_id = $local_parent_id ? $local_parent_id->locale_parent_id : $testimonial->id;
                                            @endphp
                                            <a class="d-block"
                                                href="{{ route('testimonials.create', ['locale_parent_id' => $locoale_parent_id, 'locale_id' => $language->id]) }}">
                                                <i class="bx bxs-add-to-queue"></i>
                                                {{ $language->name }}
                                            </a>
                                        @endif
                                    @else
                                        <span class="text-success">
                                            <i class="bx bxs-edit"></i>
                                            {{ $language->name }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
