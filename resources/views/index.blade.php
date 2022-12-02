@extends("layouts.app")

@section('style')
    <link href="/assets/plugins/highcharts/css/highcharts.css" rel="stylesheet" />
    <link href="/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
@endsection

@section('wrapper')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 bg-primary bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">Total Active Orders</p>
                                <h4 class="my-1 text-white">{{ @$totalActiveOrder }}</h4>
                            </div>
                            <div class="text-white ms-auto font-35"><i class='bx bx-cart-alt'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-danger bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">Total Income</p>
                                <h4 class="my-1 text-white">${{ @$totalIncome }}</h4>
                            </div>
                            <div class="text-white ms-auto font-35"><i class='bx bx-dollar'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-warning bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Total Users</p>
                                <h4 class="text-dark my-1">{{ @$totalUsers }}</h4>
                            </div>
                            <div class="text-dark ms-auto font-35"><i class='bx bx-user-pin'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-success bg-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-white">Total Products</p>
                                <h4 class="my-1 text-white">{{ @$totalProducts }}</h4>
                            </div>
                            <div class="text-white ms-auto font-35"><i class='bx bx-comment-detail'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="{{ route('delivery') }}">
                    <div class="card radius-10 bg-success bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-white">Today's Delivery</p>
                                    <h4 class="my-1 text-white">{{ @$todayDelivery }}</h4>
                                </div>
                                <div class="text-white ms-auto font-35">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                        class="bi bi-truck" viewBox="0 0 16 16">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <!--end row-->

        <div class="row">
            <div class="col-xl-6">
                <div class="card border-top border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="card-title ">
                            <div class="d-flex align-items-center"><i class="lni lni-producthunt me-1 font-22 text-danger"></i>
                                <h5 class="mb-0 text-danger">Product Stock Left</h5>
                            </div>
                            <hr>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Stock-left</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($productStockLeft as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('products.edit', $item) }}">
                                                    {{ $item->stock }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">
                                                <h4 class="m-5 text-center">
                                                    Not a single product have less than 5 stock.
                                                </h4>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
