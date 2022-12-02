@extends('frontend.layouts.app')

@section('meta')
    <title>Recipes</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@section('content')
<main class="page-main" id="recipes-page-body">
    <div class="span12 widget-span widget-type-custom_widget " style="" data-widget-type="custom_widget" data-x="0" data-w="12">
      <div id="hs_cos_wrapper_module_15984274671381708" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module"><div class="single-sec-main lazy" style="background-image: url({{ asset('frontend/assets/recipi-banner.jpg') }});">
        <div class="page-center">
          <div class="single-sec-outer ">
         <div class="title-text"><h1>Recipes</h1></div>
          </div>
        </div></div>
      </div>
      </div>

    <div class="page-content">
      <div class="uk-margin-large-top uk-container">
        <div class="pizza-builder">
          <div class="pizza-builder-step__title">

            <h2 class="uk-h2">{{ $product->name }}</h2>
          </div>
          <div class="uk-grid" data-uk-grid="">
   <div class="uk-width-2-3@m uk-first-column">
                <div class="pizza-builder-step">
                  <div class="pizza-builder-step__content">
                    <div class="pizza-builder-size-pizza" id="recipes-img">
                        <img src={{ $product->getFirstMediaUrl('image') }}>

                    </div>
                  </div>
                  <div class="uk-grid-margin uk-first-column"><a href="checkout delivery.html"></a></div>
                </div>
                <div class="pizza-builder-step">
                  <div class="pizza-builder-step__content">
                    <div class="pizza-builder-sause">
                      <div class="sj-hidden-box sause-list uk-grid uk-child-width-2-3@s uk-grid-stack" data-uk-grid="">
                        <div class="uk-first-column" style="">
                          <div class="sause-item">
                 <p>{{ $product->description }}</p>
                          </div>
                        </div>

                      </div>

                    </div>

                  </div>
                </div>
                <div class="pizza-builder-step">
                  <div class="pizza-builder-step__title">
                    <h3 class="uk-h3">Ingredients In This Meal</h3>
                  </div>
                  <div class="pizza-builder-step__content" id="ingredent-main">
                    <p>Allergens: Milk</p>
                    <p>Produced in a facility that processes milk, eggs, fish, shellfish, tree nuts, peanuts, wheat, and soybean..</p>
                    <div class="pizza-builder-step__content">
                        <div class="pizza-builder-sause">
                            <ul class="uk-grid uk-grid-medium uk-child-width-1-2@m uk-child-width-3-2" data-uk-grid="">

                                @foreach ($product->ingredients as $item)
                                <li tabindex="-1" class="uk-active uk-first-column"><svg class="svg-inline--fa fa-gift fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="gift" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z"></path></svg><!-- <i class="fas fa-gift"></i> Font Awesome fontawesome.com --> {{ $item->name }}</li>
                                @endforeach


                           </ul>
                        </div>
                      </div>
                </div>
                </div>
                <div class="pizza-builder-step">
                    <div class="pizza-builder-step__title">
                      <h3 class="uk-h3">As easy as heat and eat!</h3>
                    </div>
                    <div class="pizza-builder-step__content" id="ingredent-main">
                      <div class="pizza-builder-step__content">
                          <div class="pizza-builder-sause" id="ingredent-main">
                            <div class="web-1dbji8w"><div><ol class="web-hqqqad"><li class="web-vk64xh"><span class="web-foam4n"></span><div class="web-1hhw9qn"><p>MICROWAVE</p>
                                <ol>
                                <li>Remove meal sleeve and pierce clear plastic film. 2. Microwave meal on HIGH for 2 minutes. If needed, heat an additional 30 seconds or until desired temperature is reached. 3. Carefully remove meal and let stand for 2 minutes. 4. Remove film, plate meal, spoon mushroom gravy over burger and enjoy!</li>
                                </ol>
                                <p>OVEN</p>
                                <ol class="oven-text">
                                <li>Preheat oven to 375°F. 2. Remove meal sleeve and clear plastic film. 3. Place tray on an oven safe baking sheet, position in the center of the oven and heat for 5 minutes. 4. Check temperature. If needed, heat an additional 2 minutes or until desired temperature is reached. 5. Carefully remove meal, plate, spoon mushroom gravy over burger and enjoy!</li>
                                </ol></div></li></ol></div></div>
                          </div>
                        </div>
                  </div>
                  </div>
            </div>

              <div class="uk-width-1-3@m uk-text-center">
                <div class="pizza-build">
              <div class="pizza-builder-order">
                <div class="pizza-builder-order__title">Nutrition Per Serving</div>
                <div class="pizza-builder-order__rows">
                  <div class="pizza-builder-order__row pizza-builder-order__row-title"><span>Per serving</span></div>
                    @foreach ($product->nutritions as $item)

                    <div class="pizza-builder-order__row">
                      <div class="pizza-builder-order__row-name">{{ $item->name  }}</div>
                      <div class="pizza-builder-order__row-price">{{ $item->pivot->amount }}</div>
                    </div>

                    @endforeach

                </div>
                </div>
                <!-- <div class="pizza-builder-order__info"> <span>Pizza Size:  14” Large</span><span>$6.70</span></div>
                <div class="pizza-builder-order__total"><span>Order Total</span><span>$25.38</span></div>
                <div class="pizza-builder-order__btns"> <button class="uk-button uk-width-1-1" type="button"><span>Add to Cart</span><span data-uk-icon="cart"></span></button><button class="uk-button uk-button-default uk-width-1-1" type="button"><span>Add / Create another pizza</span></button></div> -->
              </div>

            </div>
          </div>
        </div>
    </div>
  </div>


        <div class="section-instagram">
            <div class="uk-container">
            </div>
            <div class="uk-container-expand">
                <div class="uk-margin-medium-top uk-slider" data-uk-slider="" id="second-slide">
                    <div class="uk-position-relative">
                        <div class="uk-slider-container uk-light">
                            <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l uk-child-width-1-6@xl"
                                style="transform: translate3d(0px, 0px, 0px);">
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src={{ asset('frontend/assets/img/footer/Nihari-served-with-our-signature-pita-naan.jpg.webp') }}
                                        alt="instagram"></li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src="{{ asset('frontend/assets/img/footer/Mutter-Kheema-served-with-handmade-roti.jpg') }}"
                                        alt="instagram"></li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src="{{ asset('frontend/assets/img/footer/Mediterranean-chicken-with-saffron-rice.jpg') }}"
                                        alt="instagram"></li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src="{{ asset('frontend/assets/img/footer/Karahi-Gosht-served-with-our-signature-pita-naan.jpg ') }}"
                                        alt="instagram"></li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src="{{ asset('frontend/assets/img/footer/Karahi-Chicken-served-with-our-signature-pita-naan.jpg') }}"
                                        alt="instagram"></li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src="{{ asset('frontend/assets/img/footer/Gosht-pulao.jpg') }}"
                                        alt="instagram"></a></li>
                            </ul>
                        </div>
                        <ul id="insta-silde" class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top" hidden="">
                            <li uk-slider-item="0" hidden="" class="uk-active"><a href=""></a></li>
                            <li uk-slider-item="1" hidden=""><a href=""></a></li>
                            <li uk-slider-item="2" hidden=""><a href=""></a></li>
                            <li uk-slider-item="3" hidden=""><a href=""></a></li>
                            <li uk-slider-item="4" hidden=""><a href=""></a></li>
                            <li uk-slider-item="5" hidden=""><a href=""></a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="uk-margin-medium-top uk-slider" data-uk-slider="">
                <div class="uk-position-relative">
                    <div class="uk-slider-container uk-light">
                        <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l uk-child-width-1-6@xl"
                            style="transform: translate3d(0px, 0px, 0px);">
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Gola-kabob-burrito-served-with-salsa-basmati-rice-and-chickpeas.jpg') }}"
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Dal-makhani-served-with-Basmati-Rice.jpg') }}"
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Dal-Fry-served-with-Basmati-Rice.jpg') }}"
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Dal-curry-served-with-Basmati-Rice.jpg') }}"
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Curry-khowsay.jpg') }}" alt="instagram">
                            </li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Malai-boti-paratha-roll.jpg.webp') }}"
                                    alt="instagram"></li>
                        </ul>
                    </div>
                    <ul id="insta-silde" class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top" hidden="">
                        <li uk-slider-item="0" hidden="" class="uk-active"><a href=""></a></li>
                        <li uk-slider-item="1" hidden=""><a href=""></a></li>
                        <li uk-slider-item="2" hidden=""><a href=""></a></li>
                        <li uk-slider-item="3" hidden=""><a href=""></a></li>
                        <li uk-slider-item="4" hidden=""><a href=""></a></li>
                        <li uk-slider-item="5" hidden=""><a href=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
