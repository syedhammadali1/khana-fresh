@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4">
            </div>
            <div class="d-lg-flex align-items-center mb-4 gap-3">

                {{-- <div class="ms-auto">
                    <a href="{{ route('terms.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Add New Term
                    </a>
                </div> --}}
            </div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Terms And Conditions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                        $id = 1;
                        @endphp

                        @forelse ($terms as $item)
                            <tr>
                                <td>
                                    {{ $id }}
                                </td>
                                <td>
                                    {{-- {!!  $item->condition !!} --}}
                                    privacy policy
                                </td>

                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('terms.edit', $item) }}">
                                            <i class='bx bxs-edit'></i>
                                        </a>
                                        <form action="{{ route('terms.destroy', ['term' => $item]) }}" method="post">
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
