@extends("layouts.app")

@section('wrapper')



<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Stock</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row card">
    <div class="card-body">
        <div class="col-xl-12 mt-4">
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th class="form-label h3 text-primary">Product</th>
                        <th class="form-label h3 text-primary">Stock</th>
                        <th class="form-label h3 text-primary">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td scope="row" class="h5">{{ $product->name }}</td>
                            <td class="h5">{{ $product->stock }}</td>
                            <td class="h5">{{ $today }}</td>
                        </tr>
                    @endforeach
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
