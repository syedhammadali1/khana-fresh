@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Zip Code</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('zips.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Add Zip Code</h5>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="zip_name" value=""
                                class="form-control  @error('zip_name') is-invalid @enderror" id="zip_name">
                            @error('zip_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Zip</label>
                            <input type="number" name="name" value="{{ old('name') }}"
                                class="form-control   @error('name') is-invalid @enderror" id="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Taxrate</label>
                            <input type="number" step="any" name="tax_rate" value="{{ old('tax_rate') }}"
                                class="form-control   @error('tax_rate') is-invalid @enderror" id="tax_rate">
                            @error('tax_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary col-md-12">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
