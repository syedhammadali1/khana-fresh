@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                    <form action="{{ route('products.index') }}">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Product" name="keyword" value="{{ request()->keyword }}">
                        <span class="position-absolute top-50 product-show translate-middle-y">
                            <i class="bx bx-search"></i>
                        </span>
                    </form>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('products.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Add New Product
                    </a>
                    {{-- </div>
                <div class="ms-auto"> --}}
                    {{-- <a href="{{ route('product.stock') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Product Stock
                    </a> --}}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($products as $item)
                            <tr style="{{ $item->have_stock_warning ? 'background: rgba(232, 31, 31, 0.583)' : '' }}">
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    <a href="{{ route('products.stock', $item) }}">
                                        {{ $item->stock }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->created_at->toDayDateTimeString() }}
                                </td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('products.edit', $item) }}">
                                            <i class='bx bxs-edit'></i>
                                        </a>
                                        <a href="{{ route('products.show', $item) }}">
                                            <i class='bx bx-street-view'></i>
                                        </a>
                                        <form action="{{ route('products.destroy', ['product' => $item]) }}"
                                            method="post">

                                            @csrf
                                            @method('delete')
                                            <button type="submit">
                                                <i class='bx bxs-trash'></i>
                                            </button>

                                        </form>
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
                {{ $products->links('pagination::simple-bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
