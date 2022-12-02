@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add blog-categories</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('blog-categories.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Add blog-categories</h5>
                        </div>
                        <hr>

                        @include('atoms.forms.input',[
                        'name'=>'name',
                        'label'=>'Name',
                        'value'=>old('name'),
                        'required'=>true,
                        'placeholder' => 'Enter Name',
                        ])


                    </div>
                    <button type="submit" class="btn btn-primary col-md-12">Save</button>
                </div>
            </div>
    </form>
@endsection
