<div>
    <div class="uk-first-column " style="padding: 1rem">
        <div class="sause-item">
            <div class="jus-checkbox sause-item__box">
                <span class="sause-item__content">
                    <span class="sause-item__media">
                        @if ($model->halal == 1 )
                            <div class="ribbon ribbon-top-right"><span>Vegetarian</span></div>
                        @endif
                        @if ($model->getFirstMediaUrl('image') == '')
                            <img src="{{ asset('frontend/assets/Bhindi-masala.jpg') }}" alt="source">
                        @else
                            <img src="{{ $model->getFirstMediaUrl('image') }}" alt="source">
                        @endif
                    </span>
                    <span class="sause-item__title">{{ $model->name }} <span class="sause-item__price">
                            x{{ $model->pivot->quantity }}
                        </span></span>
                    <span class="sause-item__desc">{{ $model->description }}</span>
                    <span class="sause-item__price">
                        {{-- @if (is_null($model->pivot))
                            {{ $select }}
                        @else
                            {{ $model->pivot->day }}
                        @endif --}}
                    </span>

                </span>
            </div>
        </div>
    </div>

</div>
