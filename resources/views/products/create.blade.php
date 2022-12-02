@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Add Product</h5>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            @include('atoms.forms.input', [
                                'name' => 'name',
                                'label' => 'Name',
                                'value' => old('name'),
                                'required' => true,
                                'placeholder' => 'Enter Name',
                            ])

                            @include('atoms.forms.input', [
                                'name' => 'stock',
                                'label' => 'Stock',
                                'type'=>'number',
                                'value' => old('stock'),
                                'required' => true,
                                'placeholder' => 'Enter Available Stock',
                                'classlabel' => 'pt-2'
                            ])

                            <label for="description" class="form-label pt-3">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" id=""
                                cols="10" rows="7">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @include('atoms.forms.input', [
                                'name' => 'slug',
                                'label' => 'Slug',
                                'value' => old('slug'),
                                'required' => true,
                                'placeholder' => 'Enter Slug',
                            ])

                            {{-- @include('atoms.forms.select', [
                                'name' => 'category_id',
                                'data' => $categories,
                                'label' => 'Category',
                                'value' => old('category_id'),
                            ]) --}}

                            @include('atoms.forms.select', [
                                'name' => 'flavour_id',
                                'data' => $flavours,
                                'label' => 'Flavour',
                                'value' => old('flavour_id'),
                            ])

                            @include('atoms.forms.multipleSelect', [
                                'name' => 'ingredient',
                                'data' => $ingredients,
                                'label' => 'Ingredient',
                                'value' => old('ingredient'),
                            ])

                            @include('atoms.forms.multipleSelect', [
                                'name' => 'nutrition',
                                'data' => $nutritions,
                                'label' => 'Nutrition',
                                'value' => old('nutrition'),
                                'withInputList' => 'nutrition_amount',
                                'valueInputList' => old('nutrition_amount'),
                            ])

                            <div class="row">
                                <div class="col-12 col-md-12 ">
                                    @include('atoms.forms.file', [
                                        'name' => 'file',
                                        'label' => 'Image',
                                        'style' => 'display: none',
                                    ])
                                </div>
                                <div class="col-12 col-md-6 mt-md-4">
                                    @include('atoms.forms.input', [
                                        'name' => 'featured',
                                        'label' => 'Featured',
                                        'value' => old('featured'),
                                        'type' => 'checkbox',
                                    ])
                                </div>
                                <div class="col-12 col-md-6 mt-md-4">
                                    @include('atoms.forms.input', [
                                        'name' => 'halal',
                                        'label' => 'Vegetarian',
                                        'value' => old('halal'),
                                        'type' => 'checkbox',
                                    ])
                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary col-md-12">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
