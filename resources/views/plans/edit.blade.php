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
    <form class="row g-3" action="{{ route('plans.update', $plan) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Edit Plan</h5>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" name="name" value="{{ $plan->name }}"
                                class="form-control  @error('name') is-invalid @enderror" id="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="limit" class="form-label">Meals per week</label>
                            <input type="text" name="limit" value="{{ $plan->limit }}"
                                class="form-control  @error('limit') is-invalid @enderror" id="limit">
                            @error('limit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="price" class="form-label">Price (Per meal)</label>
                            <input type="text" name="price" value="{{ $plan->price }}"
                                class="form-control  @error('price') is-invalid @enderror" id="price">
                            @error('price')
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
