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
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <form action="{{ route('users.index') }}">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search User" name="keyword" value="{{ request()->keyword }}">
                        <span class="position-absolute top-50 product-show translate-middle-y">
                        <i class="bx bx-search"></i>
                    </span>
                    </form>
                </div>
                {{-- @can('user.create') --}}
                <div class="ms-auto">
                    <a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Add New User
                    </a>
                </div>

                <div class="ms-auto">
                    <a href="{{ route('export-data') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">

                        Download User Excel Sheet
                    </a>
                </div>
                {{-- @endcan --}}
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            {{-- <th>Status</th> --}}
                            <th>Zip</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id = 1;
                        @endphp
                        @foreach ($users as $user)
                            <tr>

                                <td>
                                    {{ $id }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->zip }}
                                </td>

                                <td>
                                    {{ $user->created_at->toDayDateTimeString() }}
                                </td>
                                </td>
                                <td>
                                    <div class="d-flex order-actions">

                                        <a href="{{ route('users.edit', ['user' => $user]) }}" class=""><i
                                                class='bx bxs-edit'></i></a>
                                        <a href="{{ route('users.show', ['user' => $user]) }}" class=""><i
                                                class='bx bx-info-circle'></i></a>


                                        <form action="{{ route('users.destroy', ['user' => $user]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit">
                                                <i class='bx bxs-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $id++
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $users->links('pagination::simple-bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
