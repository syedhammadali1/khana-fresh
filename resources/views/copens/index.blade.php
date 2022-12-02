@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Coupens</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4">
            </div>
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <form action="{{ route('copens.index') }}">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Coupen" name="keyword" value="{{ request()->keyword }}">
                        <span class="position-absolute top-50 product-show translate-middle-y">
                            <i class="bx bx-search"></i>
                        </span>
                    </form>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('copens.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Add New Coupen
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $id = 1;
                        @endphp

                        @forelse ($copens as $item)
                            <tr>
                                <td>
                                    {{ $id }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->discount }}
                                </td>
                                <td>
                                    @if ($item->active)
                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                            <i class='bx bxs-circle me-1'></i>

                                        </div>
                                    @else
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                            <i class='bx bxs-circle me-1'></i>

                                        </div>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->toDayDateTimeString() }}
                                </td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('copens.edit', $item) }}">
                                            <i class='bx bxs-edit'></i>
                                        </a>
                                        <form action="{{ route('copens.destroy', ['copen' => $item]) }}" method="post">
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

                        @empty
                            <tr>
                                <td colspan="5">
                                    <h4 class="m-5 text-center">
                                        No records
                                    </h4>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
