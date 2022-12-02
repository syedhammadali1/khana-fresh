{{-- start single product code --}}
<div>
    <div class="pizza-builder-step__content">
        <div class="pizza-builder-step__title" id="menu-page-title">
            {{-- <i class="fas fa-search"></i> --}}
            {{-- <input type="text" name="" id="search-box" wire:model="search" style="padding: 15px 160px;border-radius: 16px;border: 1.1px solid grey;" placeholder="Search Products" > --}}
            <div class="wrap">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?"
                        wire:model.defer="search" wire:keydown.enter="render">
                    <button type="button" class="searchButton" wire:click='render'>
                        <div wire:target='search' wire:loading.remove>
                            <i class="fa fa-search"></i>
                        </div>
                        <div wire:loading wire:target="search">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>


        <div class="pizza-builder-sause">
            <div wire:target='search' wire:loading.class="opacity-4"
                class="jus sause-list uk-grid uk-child-width-1-4@s uk-child-width-1-2" data-uk-grid="">
                @forelse ($products as $item)
                    <div class="uk-first-column" style="">
                        <div class="sause-item">
                            <div class="jus-check-new sause-item__box"><span class="sause-item__content"><a
                                        href="{{ route('frontend.recipes', ['product' => $item]) }}"><span
                                            class="sause-item__media">
                                            @if ($item->halal == 1)
                                                <div class="ribbon ribbon-top-right"><span>Vegetarian</span></div>
                                            @endif
                                            <img src="{{ $item->getFirstMediaUrl('image') }}"
                                                aBhindi-masalalt="souse">
                                        </span></a><a
                                        href="{{ route('frontend.recipes', ['product' => $item]) }}"><span
                                            class="sause-item__title">{{ $item->name }}</span></a><span
                                        class="sause-item__desc">{{ $item->description }}</span><span
                                        class="sause-item__price"></span></span>
                            </div>
                        </div>
                    </div>
                @empty
                    No Products
                @endforelse


            </div>


            {{ $products->links('livewire::simple-bootstrap') }}


        </div>
    </div>
</div>
