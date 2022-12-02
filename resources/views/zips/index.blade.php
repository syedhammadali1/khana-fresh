@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Zips</li>
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
                    <form action="{{ route('zips.index') }}">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Zip" name="keyword" value="{{ request()->keyword }}" value="{{ request()->keyword }}">
                        <span class="position-absolute top-50 product-show translate-middle-y">
                            <i class="bx bx-search"></i>
                        </span>
                    </form>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('zips.importcreate') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Add Zip Excel File
                    </a>
                    <a href="{{ route('zips.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Add New Zip code
                    </a>
                    <a href="{{ route('zips.export') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                         Export Zip codes
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Zips</th>
                            <th>Taxrate</th>
                            <th>UserPlans</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>


                        @php

                            // if (isset($_GET['page'])) {
                            //     $pageNo = $_GET['page'];
                            //     $id = ($pageNo - 1) * 10 + 1;
                            // } else {
                            //     $id = 1;
                            // }

                        @endphp

                        @forelse ($zips as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->zip_name }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->tax_rate }}
                                </td>
                                <td>
                                    <a href="{{ route('zipUserPlan', ['code' => $item->name]) }}">

                                        {{ $item->user_plan }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('zips.edit', $item) }}">
                                            <i class='bx bxs-edit'></i>
                                        </a>

                                        <form id="delete" action="{{ route('zips.destroy', $item) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="ms-3">
                                                <i class='bx bxs-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- @php
                                $id++;
                            @endphp --}}

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

    <div class="d-flex justify-content-center">
        {!! $zips->links('pagination::bootstrap-4') !!}
    </div>
@endsection
