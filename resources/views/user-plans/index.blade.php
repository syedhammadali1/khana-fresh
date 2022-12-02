@extends("layouts.app")

@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User plans</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4">
                <div class="ms-auto">

                       

                </div>
            </div>

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>UserName</th>
                            <th>PlanName</th>
                            <th>ExpireDate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userplans as $userplan)
                            <tr>
                                <td>
                                    {{ $userplan->id }}
                                </td>
                                <td>
                                    {{ $userplan->user->first_name }}
                                </td>
                                <td>
                                    {{ $userplan->plan->name }}
                                </td>
                                <td>
                                    {{ $userplan->expire_at }}
                                </td>

                                <td>
                                    <div class="d-flex order-actions">
                                        {{-- <a href="{{ route('userplans.edit', $userplan) }}">
                                            <i class='bx bxs-edit'></i>
                                        </a> --}}

                                        <a href="{{ route('userplans.show', ['userplan' => $userplan]) }}" class=""><i
                                            class='bx bx-info-circle'></i></a>



                                        {{-- <a href="{{ route('userplans.destroy', $userplan) }}" class="ms-3">
                                            <i class='bx bxs-trash'></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
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
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $userplans->links('pagination::simple-bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

