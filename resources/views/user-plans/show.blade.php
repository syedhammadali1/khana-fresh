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
            <div class="row"><h1> Order details</h1> </div>
            <br>
            <div class="row">

                <div class="col-md-6">
                    <label for="name" class="form-label">Plan Name</label>
                    <h6 class="">{{ $userplan->plan->name ?? 'No Last Name' }}</h6>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Order No</label>
                    <h6 class="">{{ $userplan->id ?? 'No Order No' }}</h6>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Plan Price</label>
                    <h6 class="">{{ $userplan->plan->price ?? 'No Email' }}</h6>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Status</label>
                    <h6 class="">@if ($userplan->status == 0)
                        cancel
                    @elseif ($userplan->status == 1)
                        pending
                        @elseif ($userplan->status == 2)
                        active
                    @endif</h6>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Plan meals</label>

                    @foreach ($planMeals as $item)
                    <h6 class="">{{ $item->name }}</h6>
                    @endforeach

                </div>

                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Address</label>
                    <h6 class="">{{ $userplan->user->address?? 'No Email' }}</h6>
                </div>

            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <div class="row"><h1> User details</h1> </div>
            <br>
            <div class="row">

                <div class="col-md-6">
                    <label for="name" class="form-label">User Id</label>
                    <h6 class="">{{ $userplan->user->id?? 'No Last Name' }}</h6>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">User Name</label>
                    <h6 class="">{{ $userplan->user->first_name ?? 'No Email' }}</h6>

                </div>

                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Email</label>
                    <h6 class="">{{ $userplan->user->email ?? 'No Email' }}</h6>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="name" class="form-label">Phone No</label>
                    <h6 class="">{{ $userplan->user->phone ?? 'No Email' }}</h6>
                </div>

            </div>
        </div>

    </div>
@endsection
