@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show Data</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('put')
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Show Product</h5>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ $product->name }}"
                                class="form-control @error('name') is-invalid @enderror" id="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="description" class="form-label pt-3">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                id="description" id="" cols="10" rows="7">{{ $product->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="slug" class="form-label pt-3">Slug</label>
                            <input type="text" name="slug" value="{{ $product->slug }}"
                                class="form-control @error('slug') is-invalid @enderror" id="slug">
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @include('atoms.forms.select',[
                            'name' => 'category_id',
                            'data' => $categories,
                            'label' => 'Category',
                            'value'=>$product->category_id
                            ])

                            @include('atoms.forms.select',[
                            'name' => 'flavour_id',
                            'data' => $flavours,
                            'label' => 'Flavour',
                            'value'=>$product->flavour_id
                            ])

                            @include('atoms.forms.multipleSelect',[
                            'name' => 'ingredient',
                            'data' => $ingredients,
                            'label' => 'Ingredient',
                            'value'=>$product->ingredients->pluck('id')
                            ])

                            @include('atoms.forms.multipleSelect',[
                            'name' => 'nutrition',
                            'data' => $nutritions,
                            'label' => 'Nutrition',
                            'withInputList'=>'nutrition_amount',
                            'value'=>$product->nutritions->pluck('id'),
                            'valueInputList'=>$nutrition_amount
                            ])

                            <div class="form-check my-3" style="user-select: auto;">
                                <input class="form-check-input" type="checkbox" name="featured" value="1"
                                    {{ $product->featured == 1 ? 'checked' : '' }} style="user-select: auto;">
                                <label class="form-check-label" for="formCheck1" style="user-select: auto;">
                                    Featured
                                </label>
                            </div>
                            @error('featured')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary col-md-12">Save</button> --}}
        {{-- </div>
            </div>
        </div> --}}

        <div class="row mt-3">
            @if ($product->getFirstMediaUrl('image') == '')
                <img src="{{ asset('frontend/assets/Bhindi-masala.jpg') }}" alt="toppings" style="max-width:500px;>
            @else
                <img src="{{ $product->getFirstMediaUrl('image') }}" alt="toppings" style="max-width:500px;">
            @endif

            <div class="col-xl-6">

                <div class="card">
                    <div class="card-body">

                        <div class="col-md-12">
                            <label for="name" class="form-label h3 text-primary">Product Name</label>
                            <h3 class="">{{ $product->name ?? 'No  Name' }}</h3>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="name" class="form-label h3 text-primary">Description</label>
                            <h5 class="">{{ $product->description ?? 'No description' }}</h5>
                        </div>

                        <div class="col-md-12 mt-4">
                            <label for="name" class="form-label h3 text-primary">Flavour</label>
                            <h4 class="">{{ @$product->flavour->name }}</h4>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="name" class="form-label h3 text-primary">status</label>
                            <h4 class="">{{ ($product->halal == 1) ? 'vegetarian' : 'non vegetarian'}}</h4>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="name" class="form-label h3 text-primary">Ingrediants</label>
                            @foreach ($product->ingredients as $item)
                                <h4 class="">{{ $item->name }}</h4>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row card">
            <div class="card-body">
                <div class="col-xl-12 mt-4">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="form-label h3 text-primary">Nutration</th>
                                <th class="form-label h3 text-primary">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->nutritions as $item)
                                <tr>
                                    <td scope="row" class="h5">{{ $item->name }}</td>
                                    <td class="h5">{{ $item->pivot->amount }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection
