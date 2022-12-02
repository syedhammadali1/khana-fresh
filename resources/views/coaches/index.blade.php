@extends("layouts.app")


@section('wrapper')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Coach List</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4">
                @foreach (getLanguages() as $language)
                    <a href="{{ url()->current() }}?locale_id={{ $language->id }}"
                        class="badge rounded-pill bg-{{ ($language->id == request()->locale_id && request()->has('locale_id')) ||(!request()->has('locale_id') && $language->id == 1)? 'success': 'primary' }} m-1">
                        {{ $language->name }}
                    </a>
                @endforeach
            </div>
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <input type="text" class="form-control ps-5 radius-30" placeholder="Search User">
                    <span class="position-absolute top-50 product-show translate-middle-y">
                        <i class="bx bx-search"></i>
                    </span>
                </div>

                <div class="ms-auto">
                    <a href="{{ route('coaches.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Add New Coach
                    </a>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Languages</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coaches as $coach)
                            <tr>
                                <td>
                                    {{ $coach->full_name }}
                                </td>
                                <td>
                                    {{ $coach->user->email }}
                                </td>
                                <td>
                                    @foreach (getLanguages() as $language)
                                        @if ($coach->locale_id !== $language->id)

                                            @if (in_array($language->id, $coach->languages->pluck('locale_id')->toArray()))
                                                @php
                                                    $local_parent = $coach->languages->where('locale_id', $language->id)->first();
                                                    $local_parent_id = $coach->locale_parent_id ? $coach->locale_parent_id : $local_parent->locale_parent_id;
                                                @endphp
                                                <a class="d-block"
                                                    href="{{ route('coaches.edit', [
                                                        'coach' => $coach->languages->where('locale_id', $language->id)->first()->id,
                                                        'locale_id' => $language->id,
                                                        'locale_parent_id' => $local_parent_id,
                                                    ]) }}">
                                                    <i class="bx bxs-edit"></i>
                                                    {{ $language->name }}
                                                </a>
                                            @else
                                                @php
                                                    $local_parent_id = $coach->languages->where('locale_id', request()->locale_id)->first();
                                                    $locoale_parent_id = $local_parent_id ? $local_parent_id->locale_parent_id : $coach->id;
                                                @endphp
                                                <a class="d-block"
                                                    href="{{ route('coaches.create', ['locale_parent_id' => $locoale_parent_id, 'locale_id' => $language->id]) }}">
                                                    <i class="bx bxs-add-to-queue"></i>
                                                    {{ $language->name }}
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if ($coach->status == 'publish')
                                        <div
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                            <i class='bx bxs-circle me-1'></i>
                                            {{ ucfirst($coach->status) }}
                                        </div>
                                    @else
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                            <i class='bx bxs-circle me-1'></i>
                                            {{ ucfirst($coach->status) }}
                                        </div>
                                    @endif

                                </td>
                                <td>
                                    {{ $coach->created_at->toDayDateTimeString() }}
                                </td>
                                </td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('coaches.edit', ['coach' => $coach,'locale_id' => $coach->locale_id,'locale_parent_id' => $coach->locale_parent_id]) }}"
                                            class=""><i class='bx bxs-edit'></i></a>

                                        <a href="{{ route('coaches.destroy', ['coach' => $coach]) }}"
                                            class="ms-3"><i class='bx bxs-trash'></i></a>
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
    </div>


@endsection
