@extends("layouts.app")


@section('wrapper')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Term</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('terms.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Add Term</h5>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <label for="condition" class="form-label pt-3">Condition</label>
                            <textarea name="condition" class="form-control @error('condition') is-invalid @enderror"
                                id="condition" id="" cols="10" rows="7">{{ old('condition') }}</textarea>
                            @error('condition')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary col-md-12">Save</button>
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
            selector: 'textarea#condition'
        });
    </script>

@endpush
