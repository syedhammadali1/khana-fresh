@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('plans.update', $plan) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Edit Flavour</h5>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            @include('atoms.forms.input',[
                            'name'=>'name',
                            'label'=>'Name',
                            'value'=>$plan->name,
                            'required'=>true,
                            'placeholder' => 'Enter Name',
                            ])

                            @include('atoms.forms.input',[
                            'name'=>'limit',
                            'label'=>'Meals per week',
                            'value'=>$plan->limit,
                            'required'=>true,
                            'placeholder' => 'Enter Meals per week',
                            'classlabel'=>'mt-2',
                            'type'=>'number'
                            ])

                            @include('atoms.forms.input',[
                            'name'=>'price',
                            'label'=>'Price',
                            'value'=>$plan->price,
                            'placeholder' => 'Enter Price',
                            'required'=>true,
                            'classlabel'=>'mt-2',
                            'type'=>'number'
                            ])
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary col-md-12">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
