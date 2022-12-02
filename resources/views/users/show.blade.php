@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User List</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="form-label">First Name</label>
                    <h6 class="">{{ $user->first_name ?? 'No First Name' }}</h6>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Last Name</label>
                    <h6 class="">{{ $user->last_name ?? 'No Last Name' }}</h6>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Email</label>
                    <h6 class="">{{ $user->email ?? 'No Email' }}</h6>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Status</label>
                    <h6 class="">{{ $user->status ?? 'No Status' }}</h6>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Zip</label>
                    <h6 class="">{{ $user->zip ?? 'No Zip' }}</h6>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Created at</label>
                    <h6 class="">{{ $user->created_at->toDayDateTimeString() ?? 'No Created at' }}</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
