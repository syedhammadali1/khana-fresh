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
    <form class="row g-3" action="{{ route('products.update', $product) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Edit Product</h5>
                        </div>
                        <hr>
                        <div class="col-md-12">


                            @include('atoms.forms.input', [
                                'name' => 'name',
                                'label' => 'Name',
                                'value' => $product->name,
                                'required' => true,
                                'placeholder' => 'Enter Name',
                            ])




                            <label for="description" class="form-label pt-3">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" id=""
                                cols="10" rows="7">{{ $product->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @include('atoms.forms.input', [
                                'name' => 'slug',
                                'label' => 'Slug',
                                'value' => $product->slug,
                                'required' => true,
                                'placeholder' => 'Enter Slug',
                            ])

                            {{-- @include('atoms.forms.select', [
                                'name' => 'category_id',
                                'data' => $categories,
                                'label' => 'Category',
                                'value' => $product->category_id,
                            ]) --}}

                            @include('atoms.forms.select', [
                                'name' => 'flavour_id',
                                'data' => $flavours,
                                'label' => 'Flavour',
                                'value' => $product->flavour_id,
                            ])

                            @include('atoms.forms.multipleSelect', [
                                'name' => 'ingredient',
                                'data' => $ingredients,
                                'label' => 'Ingredient',
                                'value' => $product->ingredients->pluck('id'),
                            ])

                            @include('atoms.forms.multipleSelect', [
                                'name' => 'nutrition',
                                'data' => $nutritions,
                                'label' => 'Nutrition',
                                'withInputList' => 'nutrition_amount',
                                'value' => $product->nutritions->pluck('id'),
                                'valueInputList' => $nutrition_amount,
                            ])

                            <div x-data="{ open: false, old_stock: {{ $product->stock }}, new_stock: {{ $product->stock }}, add_stock: 0 }" x-effect="new_stock = old_stock + add_stock">
                                <div class="row">

                                    <div x-show="!open" class="col-sm-10">
                                        @include('atoms.forms.input', [
                                            'name' => '',
                                            'label' => 'Stock',
                                            'type' => 'number',
                                            'value' => $product->stock,
                                            'required' => true,
                                            'disabled' => true,
                                            'placeholder' => 'Enter Available Stock',
                                            'classlabel' => 'pt-2',
                                        ])
                                    </div>
                                    <div x-show="open" class="col-sm-10">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label pt-2 ">
                                                    Old Stock
                                                </label>
                                                <input type="number" disabled class="form-control"
                                                    x-model.number="old_stock">
                                            </div>
                                            <div class="col-1 text-center pt-5">
                                                +
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label pt-2 ">
                                                    Add Stock
                                                </label>
                                                <input type="number" class="form-control" x-model.number="add_stock">
                                            </div>
                                            <div class="col-1 text-center pt-5">
                                                =
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label pt-2 ">
                                                    New Stock
                                                </label>
                                                <input readonly name="stock" type="number" class="form-control"
                                                    x-model.number="new_stock">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 pt-4 mt-3">
                                        <button type="button" :class="{'btn btn-primary' : open, 'btn btn-white' : !open}"
                                            @click="open = ! open,datefiler = false,add_stock=0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                            </svg> Add Stock
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <div class="row pt-2">
                                <div class="col-12 col-md-12 ">
                                    @if ($product->getFirstMediaUrl('image') == '')
                                        @include('atoms.forms.file', [
                                            'name' => 'file',
                                            'label' => 'Image',
                                            'style' => 'display: none',
                                        ])
                                    @else
                                        @include('atoms.forms.file', [
                                            'name' => 'file',
                                            'label' => 'Image',
                                            'src' => $product->getFirstMediaUrl('image'),
                                        ])
                                    @endif
                                </div>
                                <div class="col-12 col-md-6 mt-md-4">
                                    @include('atoms.forms.input', [
                                        'name' => 'featured',
                                        'label' => 'Featured',
                                        'value' => $product->featured,
                                        'type' => 'checkbox',
                                    ])
                                </div>
                                <div class="col-12 col-md-6 mt-md-4">
                                    @include('atoms.forms.input', [
                                        'name' => 'halal',
                                        'label' => 'Halal',
                                        'value' => $product->halal,
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
