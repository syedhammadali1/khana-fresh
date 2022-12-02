@extends('frontend.layouts.app')

@section('meta')
    <title>Search</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@section('content')
<main class="page-main">
    <div class="span12 widget-span widget-type-custom_widget " style="" data-widget-type="custom_widget" data-x="0" data-w="12">
      <div id="hs_cos_wrapper_module_15984274671381708" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module"><div class="single-sec-main lazy" style="background-image: url({{ asset('frontend/assets/khana-fresh-banner-3.jpg') }});">
        <div class="page-center">
          <div class="single-sec-outer ">
         <div class="title-text"><h1>Menu</h1></div>
          </div>
        </div></div>
      </div>
      </div>

    <div class="page-content uk-text-center">
      <div class="uk-margin-large-top uk-container">
        <div class="pizza-builder">
          <div class="uk-grid uk-grid-stack" data-uk-grid="">
            <div class="uk-width-4-4@m uk-first-column">
              <div class="pizza-builder-steps">
                <div class="pizza-builder-step">
                <div class="pizza-builder-step">
                  <div class="pizza-builder-step__title" id="menu-page-title">
                    <h2><b>Get healthy meals delivered,</b>
                      <br>
                      <p>culinary expert arranged dinners conveyed to your entryway.</p>
                    </h2>
                  </div>
                  <div class="pizza-builder-step__content">
                    <!--<div class="pizza-builder-step__title" id="menu-page-title">-->
                    <!--  <h2>Menu for February 15, 2022</h2>-->
                    <!--</div>-->
                    <div class="pizza-builder-sause">
                      <div class="jus-hidden-box sause-list uk-grid uk-child-width-1-4@s uk-child-width-1-2" data-uk-grid="">

                        @if (count($products) > 0)


                        @foreach ($products as $item)

                        <div class="uk-first-column" style="">
                            <div class="sause-item">
                                <div class="jus-checkbox sause-item__box"><span class="sause-item__content"><a href="{{ route('frontend.recipes',['product' => $item]) }}"><span class="sause-item__media">
                                    @if ($item->halal == 1)
                                    <div class="ribbon ribbon-top-right"><span>Vegetarian</span></div>

                                    @endif
                                    <img src="{{ $item->image }}" aBhindi-masalalt="souse"></span></a><a href="{{ route('frontend.recipes',['product' => $item]) }}"><span class="sause-item__title">{{ $item->name }}</span></a><span class="sause-item__desc">{{ $item->description }}</span><span class="sause-item__price"></span></span></div>
                            </div>
                        </div>

                        @endforeach

                           </div>
                            <div class="jus-hidden-btn uk-text-center uk-margin-medium-top"><button class="btn-more" type="button">View More Options</button></div>

                        @else

                        <h2 style="text-align: center">Record Not Found</h2>

                        @endif
                    </div>
                  </div>
                </div>
                <!-- <div class="pizza-builder-step">
                  <div class="pizza-builder-step__title">
                    <div class="pizza-builder-step__numb">3</div>
                    <h3 class="uk-h3">Add Extra Cheese</h3>
                  </div>
                  <div class="pizza-builder-step__content">
                    <div class="pizza-builder-cheese">
                      <div class="cheese-list uk-grid uk-child-width-1-3@s uk-child-width-1-2" data-uk-grid>
                        <div>
                          <div class="cheese-item">
                            <div class="js-checkbox cheese-item__box"><span class="cheese-item__content"><span class="cheese-item__media"><img src="assets/img/pages/builder/cheese-1.jpg" alt="cheese"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></span><span class="cheese-item__title">Garlic Cheese</span><span class="cheese-item__desc">Garlic Cheese 80g</span><span class="cheese-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div>
                          <div class="cheese-item">
                            <div class="js-checkbox cheese-item__box"><span class="cheese-item__content"><span class="cheese-item__media"><img src="assets/img/pages/builder/cheese-2.jpg" alt="cheese"><span class="counter"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span></span></span><span class="cheese-item__title">Apple Cheese</span><span class="cheese-item__desc">Apple Cheese 50g</span><span class="cheese-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="pizza-builder-step">
                  <div class="pizza-builder-step__title">
                    <div class="pizza-builder-step__numb">3</div>
                    <h3 class="uk-h3">Choose Your Toppings</h3>
                  </div>
                  <div class="pizza-builder-step__content">
                    <p>You can select upto 3 toppings for your order.</p>
                    <div class="pizza-builder-toppings">
                      <div class="js-hidden-box toppings-list uk-grid uk-child-width-1-3@s uk-child-width-1-2" data-uk-grid="">
                        <div class="uk-first-column" style="">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-1.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Pineapple</span><span class="toppings-item__desc">Pineapple 80g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div style="">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-2.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Mushrooms</span><span class="toppings-item__desc">Mushrooms 50g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div style="">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-3.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Hot Chillies</span><span class="toppings-item__desc">Hot Chillies 10g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin uk-first-column" style="">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-4.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Aubergines</span><span class="toppings-item__desc">Aubergines 50g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin" style="">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-5.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Peppers</span><span class="toppings-item__desc">Peppers 5g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin" style="">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-2.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Sweet Corn</span><span class="toppings-item__desc">Sweet Corn 80g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin uk-first-column" style="display: none;">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-1.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Pineapple</span><span class="toppings-item__desc">Pineapple 80g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin" style="display: none;">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-2.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Mushrooms</span><span class="toppings-item__desc">Mushrooms 50g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin" style="display: none;">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-3.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Hot Chillies</span><span class="toppings-item__desc">Hot Chillies 10g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin uk-first-column" style="display: none;">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-4.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Aubergines</span><span class="toppings-item__desc">Aubergines 50g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin" style="display: none;">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-5.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Peppers</span><span class="toppings-item__desc">Peppers 5g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                        <div class="uk-grid-margin" style="display: none;">
                          <div class="toppings-item">
                            <div class="js-checkbox toppings-item__box"><span class="toppings-item__content"><span class="toppings-item__media"><img src="assets/img/pages/builder/toppings-2.jpg" alt="toppings"><span class="counter"><span class="minus">-</span><input type="text" value="1"><span class="plus">+</span></span></span><span class="toppings-item__title">Sweet Corn</span><span class="toppings-item__desc">Sweet Corn 80g</span><span class="toppings-item__price">$5.50</span></span></div>
                          </div>
                        </div>
                      </div>
                      <div class="js-hidden-btn uk-text-center uk-margin-medium-top"><button class="btn-more" type="button">View More Options</button></div>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>

@endsection
