@extends('frontend.layouts.app')
@section('meta')
    <title>Home</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@section('content')
    <main class="page-main">
        <!-- slider-start -->
        <div class="span12 widget-span widget-type-custom_widget " style="" data-widget-type="custom_widget" data-x="0"
            data-w="12">
            <div id="hs_cos_wrapper_module_15984274671381708"
                class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style=""
                data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <div class="single-sec-main lazy"
                    style="background-image: url({{ asset('frontend/assets/main-banner.png') }});">
                    <div class="page-center">
                        <div class="single-sec-outer ">
                            <div class="single-sec-inner">
                                <div class="single-sec-title" style="padding: 40px">
                                    <h2>Deliciousness Made Easy!</h2>
                                    <h2 class="home-made"><b>Homemade food delivered to your door</b></h2>
                                    {{-- <p>GET nutritious, CHEF-PREPARED MEALS
                                        Healthy readymade meals delivered TO YOUR DOORSTEP</p> --}}
                                    <p>Check what chef prepared meals are available in your area</p>

                                    <div class="homepage-form">
                                        <div class="section-content">
                                            <form action="{{ route('frontend.userdata') }}" method="POST">
                                                @csrf
                                                <div class="uk-grid uk-grid-small uk-child-width-1-2@s" data-uk-grid="">
                                                    <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                                        <input class="uk-input uk-form-large" placeholder="Email"
                                                            type="email" name="email">


                                                    </div>

                                                    <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                                        <input class="uk-input uk-form-large" placeholder="Zip Code"
                                                            type="number" name="zip">
                                                    </div>
                                                    <div class="uk-width-1-1 uk-grid-margin uk-first-column"><button
                                                            class="uk-button uk-button-large" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="section-features">
            <div class="uk-section uk-container">
                <div class="section-title section-title--center wave">
                    <h3 class="uk-h3">How It Works</h3>
                </div>
                <div class="uk-grid uk-child-width-1-4@s" data-uk-grid="">

                    <div class="uk-first-column">
                        <div class="feature-item">
                            <div class="feature-item__icon"><img
                                    src="{{ asset('frontend/assets/img/gif/KFpan-gif.gif') }}" alt="feature"></div>
                            <div class="feature-item__title">We Redefine Taste</div>
                            <div class="feature-item__desc">Chef Inspired meals, made from fresh ingredients </div>
                        </div>
                    </div>
                    <div>
                        <div class="feature-item">
                            <div class="feature-item__icon"><img
                                    src="{{ asset('frontend/assets/img/gif/laptop-gif-v2.gif') }}" alt="feature">
                            </div>
                            <div class="feature-item__title">Pick Your Meals</div>
                            <div class="feature-item__desc">30+ halal and Vegetarian to pick from</div>
                        </div>
                    </div>

                    <div>
                        <div class="feature-item">
                            <div class="feature-item__icon"><img
                                    src="{{ asset('frontend/assets/img/gif/KFtruck-gif.gif') }}" alt="feature"></div>
                            <div class="feature-item__title">Delivered Fresh</div>
                            <div class="feature-item__desc">We deliver, perfectly portioned, table ready, healthy meals to
                                your
                                door.</div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-item__icon"><img
                                src="{{ asset('frontend/assets/img/gif/microwave-gif-v2.gif') }}" alt="feature"></div>
                        <div class="feature-item__title">Heat, Eat & Enjoy</div>
                        <div class="feature-item__desc">No prep. No mess. Our meals arrive ready to heat and eat in
                            minutes.</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- How To Work Section End -->

        <!-- Order Your Own Tasty Food Start -->

        <div class="section-steps">
            <div class="uk-section uk-text-center">
                <div class="section-title section-title--center wave">
                    <h3 class="uk-h3">New, Healthy and Unbelievably Tasty meals made</h3>
                </div>
                <div class="select-substitle-p">
                    <h4>Our meals set the bar for quality and taste</h4>
                </div>
                <div class="uk-container-expand">
                    <div class="section-content">
                        <div class="uk-grid" data-uk-grid="">
                            <div class="uk-width-4-4@m">
                                <div data-uk-slider="finite: true" class="uk-slider">
                                    <div class="uk-position-relative">
                                        <div class="uk-slider-container">
                                            <ul class="uk-slider-items uk-grid uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-3x1 style="
                                                transform: translate3d(0px, 0px, 0px);">
                                                <li tabindex="-1" class="uk-active">
                                                    <div class="step-item step-item--1">
                                                        <div class="step-item__icon"><img
                                                                src={{ asset('frontend/assets/img/pages/home/step-1.png') }}
                                                                alt="img-step">
                                                        </div>
                                                        <div class="step-item__title">New, Fresh Ingredients</div>
                                                        <div class="step-item__desc">We just utilize new fixings from our
                                                            organization of confided
                                                            in accomplices. Factor suppers are liberated from chemicals,
                                                            anti-microbial, refined
                                                            sugars and GMOs</div>
                                                    </div>
                                                </li>
                                                <li tabindex="-1" class="uk-active">
                                                    <div class="step-item step-item--2">
                                                        <div class="step-item__icon"><img
                                                                src="{{ asset('frontend/assets/img/pages/home/step-2.png') }}"
                                                                alt="img-step">
                                                        </div>
                                                        <div class="step-item__title">Culinary specialist Crafted Recipes
                                                        </div>
                                                        <div class="step-item__desc">Our group of culinary specialists make
                                                            suppers so delicious,
                                                            you will have a hard time believing they're sound and make
                                                            healthy microwave meals
                                                            delivered at your doorstep.</div>
                                                    </div>
                                                </li>
                                                <li tabindex="-1" class="uk-active">
                                                    <div class="step-item step-item--3">
                                                        <div class="step-item__icon"><img
                                                                src="{{ asset('frontend/assets/img/pages/home/step-3.png') }}"
                                                                alt="img-step">
                                                        </div>
                                                        <div class="step-item__title">Planned by Dietitians</div>
                                                        <div class="step-item__desc">Our enlisted dietitians work
                                                            inseparably with our kitchen to
                                                            guarantee each dinner is loaded with premium, science-upheld
                                                            nourishing quality.</div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"
                                                hidden="">
                                                <li uk-slider-item="0" hidden="" class="uk-active"><a href=""></a>
                                                </li>
                                                <li uk-slider-item="1" hidden=""><a href=""></a></li>
                                                <li uk-slider-item="2" hidden=""><a href=""></a></li>
                                                <li uk-slider-item="3" hidden=""><a href=""></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-margin-medium-top uk-text-center"> <a class="uk-button"
                                        style="padding: 30px" href="{{ route('frontend.plan') }}"><span>Create
                                            &amp; Order Now!</span><img class="uk-margin-small-left"
                                            src="assets/img/icons/ice-cream.svg" alt=""></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Order Your Own Tasty Food End -->

        <!-- Sliding Banner Start -->
        <div class="full-banner">
            <img src="{{ asset('frontend/assets/img/Khana-Fresh-Banner-Gif.gif') }}" />
        </div>
        <!-- Sliding Banner End-->

        <!-- Tab Start -->
        <div class="uk-margin-large-top uk-container">
            <div class="pizza-builder">
                <div class="uk-grid uk-grid-stack" data-uk-grid="">
                    <div class="uk-width-4-4@m uk-first-column">
                        <div class="pizza-builder-steps">
                            <div class="pizza-builder-step">
                                <div class="pizza-builder-step">
                                    <div class="pizza-builder-step__title" id="menu-page-title">
                                        <h2><b>Homemade food delivered to your door</b>
                                            <br>

                                        </h2>
                                    </div>
                                    <div wire:id="nK00Vpko4C6FxQrQeqYV">
                                        <div class="pizza-builder-step__content">
                                            <div class="pizza-builder-step__title" id="menu-page-title">



                                            </div>


                                            <div class="pizza-builder-sause">
                                                <div class="jus sause-list uk-grid uk-child-width-1-4@s uk-child-width-1-2"
                                                    data-uk-grid="">

                                                    @forelse ($products as $item)
                                                        <div class="uk-first-column" style="">
                                                            <div class="sause-item">
                                                                <div class="jus-check-new sause-item__box"><span
                                                                        class="sause-item__content"><a
                                                                            href="{{ route('frontend.recipes', ['product' => $item]) }}"><span
                                                                                class="sause-item__media">
                                                                                @if ($item->halal == 1)
                                                                                    <div class="ribbon ribbon-top-right">
                                                                                        <span>Vegetarian</span>
                                                                                    </div>
                                                                                @endif

                                                                                <img src="{{ $item->getFirstMediaUrl('image') }}"
                                                                                    aBhindi-masalalt="souse">
                                                                            </span></a><a
                                                                            href="{{ route('frontend.recipes', ['product' => $item]) }}"><span
                                                                                class="sause-item__title">{{ $item->name }}</span></a>
                                                                        {{-- <button class="renew" wire:click="renew">Vegetarian</button> --}}
                                                                        <span
                                                                            class="sause-item__desc">{{ $item->description }}</span><span
                                                                            class="sause-item__price"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        No Products
                                                    @endforelse


                                                </div>


                                                <div>

                                                </div>



                                            </div>
                                        </div>
                                    </div>

                                    <!-- Livewire Component wire-end:nK00Vpko4C6FxQrQeqYV -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab End -->

        <!-- Meals Start -->
        <div class="section-featured-deals" id="meal-price">
            <div class="uk-container-expand">
                <div data-uk-slider="" class="uk-slider">
                    <div class="uk-position-relative">
                        <div class="uk-slider-container uk-light">
                            <div class="section-title section-title--center wave">
                                <h3 class="uk-h3">Pricing</h3>
                            </div>
                            <div class="select-substitle-p">
                                <h4>Save time money</h4>
                                <h4>Try one of our weekly meal plans with no commitments. You can pause, cancel, or change
                                    your plan
                                    at any time.</h4>
                            </div>
                            <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@ uk-child-width-1-4l"
                                style="transform: translate3d(0px, 0px, 0px);">

                                @foreach ($plans as $item)
                                    <li tabindex="-1" class="uk-active">
                                        <div class="featured-deal-item">
                                            <div class="featured-deal-item uk-text-center">
                                                <div class="pricing-col-rep">
                                                    <div class="pricin">
                                                        <div class="pricing-title-spz">{{ $item->limit }} Meals</div>
                                                        <div class="pw-text-spz">per Week</div>
                                                        <div class="cur-price-spz">${{ $item->price }}</div>
                                                        <div class="pp-text-spz">PER MEAL</div>
                                                        <a class="pricing-cta-spz"
                                                            href="{{ ROUTE('frontend.plan') }}">GET STARTED</a>

                                                    </div>
                                                </div>
                                            </div>
                                    </li>
                                @endforeach


                            </ul>
                            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top" hidden="">
                                <li uk-slider-item="0" hidden="" class="uk-active"><a href=""></a></li>
                                <li uk-slider-item="1" hidden=""><a href=""></a></li>
                                <li uk-slider-item="2" hidden=""><a href=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Meals End -->

        <!-- frequently asked questions Start -->
        <div class="span12 widget-span widget-type-custom_widget " style="" data-widget-type="custom_widget" data-x="0"
            data-w="12">
            <div id="hs_cos_wrapper_module_1598509992047534"
                class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style=""
                data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <div class="accordion">
                    <div class="page-center">
                        <div class="section-title section-title--center wave">
                            <h3 class="uk-h3">Frequently Asked Questions</h3>
                        </div>
                        <div class="meals1">
                            <div class="accordion-outer">
                                <div class="accordion-panel-left-right">
                                    <div class="accordion-panel-col-6">

                                        <div class="accordion-panel">

                                            <div class="accordion-panel-title" rel="accordion1">What are the benefits
                                                of
                                                Khana Fresh?</div>
                                            <div style="display: none;" class="accordion-panel-content" id="accordion1">
                                                <p>Khana Fresh provides fresh, ready-prepared kitchen to table meals. We
                                                    shop, we prep, we
                                                    cook, and deliver to your door for you so you can enjoy delicious
                                                    meals
                                                    without the hassle.
                                                    Unlike take-out or greasy restaurants our food is nutritionally
                                                    sound
                                                    leaving you looking
                                                    great, feeling amazing. You will have time and energy to focus on
                                                    what
                                                    you need. </p>
                                            </div>

                                        </div>

                                        <div class="accordion-panel">

                                            <div class="accordion-panel-title" rel="accordion2">What long will the food
                                                last?</div>


                                            <div style="display: none;" class="accordion-panel-content" id="accordion2">
                                                <p>Khana Fresh meals will stay fresh for 7 days in the fridge. We do not
                                                    use
                                                    any artificial
                                                    preservatives, instead we seal our food with MAP (Modified
                                                    Atmosphere
                                                    Packaging). MAP lowers
                                                    the amount of oxygen in the container, slowing the natural
                                                    breakdown/
                                                    oxidation of food
                                                    products. If you’ve ever bought a bag of salad or any fresh,
                                                    packaged
                                                    food product, it has
                                                    been packaged using a similar technology. Our goal is to deliver
                                                    fresh
                                                    food from “Our
                                                    Kitchen to your Table”</p>
                                            </div>

                                        </div>

                                        <div class="accordion-panel">

                                            <div class="accordion-panel-title" rel="accordion3">How do the meals stay
                                                fresh during transit?
                                            </div>


                                            <div style="display: none;" class="accordion-panel-content" id="accordion3">
                                                <p>Insulated boxes along with cold packs keep the box at refrigerated
                                                    temperatures for the
                                                    duration of the transit! We test and continue to test our meal in
                                                    all
                                                    seasons across all
                                                    climates.
                                                    <br /><br /> It is normal for the packs to be slightly melted by the
                                                    time they arrive. As
                                                    they melt the release cold air into the box . The cold air does
                                                    dissipate quickly when you
                                                    open it, so you should transfer the meals to the fridge immediately.
                                                </p>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="accordion-panel-col-6">

                                        <div class="accordion-panel">

                                            <div class="accordion-panel-title" rel="accordion1">Are Khana Fresh Meals
                                                Halal?</div>


                                            <div style="display: none;" class="accordion-panel-content" id="accordion1">
                                                <p>100% hand slaughtered halal chicken, beef, or goat is delivered daily
                                                    to
                                                    ensure freshness
                                                    and quality by partners and suppliers. We also butcher inhouse to
                                                    deliver the best cuts of
                                                    meat for each meal.</p>
                                            </div>

                                        </div>

                                        <div class="accordion-panel">

                                            <div class="accordion-panel-title" rel="accordion2">Why Khana Fresh Meals
                                                Halal?</div>


                                            <div style="display: none;" class="accordion-panel-content" id="accordion2">
                                                <p>Halal requires that the blood is totally depleted from the meat,
                                                    resulting in better and
                                                    fresher quality, free from bacteria. In additional, as the meat is
                                                    not
                                                    stressed, it is free
                                                    from “fear toxins” which results in softer meat which is free from
                                                    radicals which are
                                                    released when animals are under stress.</p>
                                            </div>

                                        </div>

                                        <div class="accordion-panel">

                                            <div class="accordion-panel-title" rel="accordion3">Is Khana Fresh
                                                Vegetarian
                                                Friendly</div>


                                            <div style="display: none;" class="accordion-panel-content" id="accordion3">
                                                <p>Yes, in fact all Vegetarian meals have a separate designated cutlery,
                                                    pots, pans, and even
                                                    stoves from all non-vegetarian areas to ensure that there is no
                                                    cross
                                                    contamination between
                                                    non meat and meat products</p>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <a class="pricing-cta-spz" href="{{ route('frontend.plan') }}">GET STARTED</a>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="section-instagram">
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
                                        src={{ asset('frontend/assets/img/footer/Mutter-Kheema-served-with-handmade-roti.jpg') }}
                                        alt="instagram">
                                </li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src={{ asset('frontend/assets/img/footer/Mediterranean-chicken-with-saffron-rice.jpg') }}
                                        alt="instagram">
                                </li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src={{ asset('frontend/assets/img/footer/Karahi-Gosht-served-with-our-signature-pita-naan.jpg ') }}
                                        alt="instagram">
                                </li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src={{ asset('frontend/assets/img/footer/Karahi-Chicken-served-with-our-signature-pita-naan.jpg') }}
                                        alt="instagram">
                                </li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src={{ asset('frontend/assets/img/footer/Gosht-pulao.jpg') }}
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
                                    src={{ asset('frontend/assets/img/footer/Gola-kabob-burrito-served-with-salsa-basmati-rice-and-chickpeas.jpg') }}
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Dal-makhani-served-with-Basmati-Rice.jpg') }}
                                    alt="instagram">
                            </li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Dal-Fry-served-with-Basmati-Rice.jpg') }}
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Dal-curry-served-with-Basmati-Rice.jpg') }}
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Curry-khowsay.jpg') }} alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Malai-boti-paratha-roll.jpg.webp') }}
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
        </div> --}}
    </main>
@endsection
