<div>
    {{-- Product Quantity : {{ var_export($productsQuantity) }}
    Total : {{ var_export($total) }} --}}
    <p>You can select upto {{ $userlimit }} toppings for your order.</p>
    <div class=" toppings-list uk-grid uk-child-width-1-4@s uk-child-width-1-2 uk-grid-stack" data-uk-grid="">
        @foreach ($products as $product)
            <div class="uk-grid-margin">
                <div class="toppings-item">
                    <div class="js-checkbox toppings-item__box @if (array_key_exists($product->id, $this->productsQuantity)) is-checked @endif">
                        <span class="toppings-item__content">
                            <span class="toppings-item__media" wire:click="selectProduct({{ $product->id }})">
                                @if ($product->halal == 1)
                                <div class="ribbon ribbon-top-right ribbon-top-right1"><span>Vegetarian</span></div>
                            @endif

                                @if ($product->getFirstMediaUrl('image') == '')
                                    <img src="{{ asset('frontend/assets/Bhindi-masala.jpg') }}" alt="toppings">
                                @else
                                    <img src="{{ $product->getFirstMediaUrl('image') }}" alt="toppings">
                                @endif

                                <span class="counter" style="z-index: 99">
                                    @if ($product->is_stock_available)
                                        <button type="button" class="minus"
                                            wire:click="minus({{ $product->id }})">-</button>
                                    @endif

                                    <input type="text" style="{{ $product->is_stock_available ? ' ' : 'width: 100%;' }} "
                                        wire:model.defer="productsQuantity.{{ $product->id }}" value="1">

                                    @if ($product->is_stock_available)
                                        <button type="button" class="plus"
                                            wire:click="plus({{ $product->id }})">+</button>
                                    @endif
                                </span>
                            </span>
                            <span class="toppings-item__title">{{ $product->name }}
                                <span class="uk-text-danger">
                                    {{ $product->is_stock_available ? '' : '(Currently Unavailable)' }}
                                </span>
                            </span>
                            <span class="toppings-item__desc">{{ $product->description }}
                                roti</span>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    @error('productsQuantity')
        <div class="alert alert-danger uk-text-center uk-mt-4">
            <strong>Required!</strong> {{ $message }}
        </div>
    @enderror

    <input type="button" wire:click="appyProduct" wire:loading.class="d-none" class="btn btn-success"
        value="Change">
    <div wire:loading wire:target="appyProduct">
        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
    </div>
</div>
