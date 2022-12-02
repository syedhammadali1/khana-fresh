@extends('frontend.layouts.app')

@section('meta')
    <title>About</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection


@section('content')
    <main class="page-main" id="background-grey">
        <div class="span12 widget-span widget-type-custom_widget " style="" data-widget-type="custom_widget" data-x="0"
            data-w="12">
            <div id="hs_cos_wrapper_module_15984274671381708"
                class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style=""
                data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <div class="single-sec-main lazy"
                    style="background-image: url({{ asset('frontend/assets/about-k1.jpg') }});">
                    <div class="page-center">
                        <div class="single-sec-outer ">
                            <div class="title-text">
                                <h1>About Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span12" style="" data-widget-type="custom_widget" data-x="0" data-w="12">
            <div class="about-text">
                <h1>About Us</h1>
                <p>Meals prepared from SCRATCH!!! Food your mother would want you to eat!!! Know what every ingredient in
                    your meal is. Sit down at your table and have a taste of homemade food every time you open one of our
                    meals.All our meals are handmade, using traditional methods
                    utilized in most South Asian homes. We take time honored traditional cuisine
                    and deliver it to your door. r</p>
            </div>
        </div>


        <div class="section-banners">
            <div class="uk-section uk-container">
                <div class="uk-grid uk-grid-stack" data-uk-grid="">
                    <div class="uk-first-column">
                        <div class="about-how">
                            <h2>HOW IT WORKS</h2>
                            <p>Don’t settle for take out or fast food when you have us. Let us do the cooking and you can do
                                the eating, From kitchen to your table.</p>
                        </div>
                    </div>
                    <div class="uk-grid-margin uk-first-column">

                    </div>
                </div>
            </div>
        </div>
        <div class="uk-section uk-container" id="about-page-sec">
            <div class="uk-grid uk-child-width-1-2@s" data-uk-grid="">
                <div class="uk-first-column">
                    <div class="banner-card-text">
                        <h2>Select your treasured recipes</h2>
                        <p>We update our menu every week with many delicious and nutritious meals. You can pick your top
                            choices, or let us make your request depending on your taste inclinations and ordering history.
                        </p>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('frontend/assets/ab1.png') }}">
                </div>
                <div class="uk-grid-margin uk-first-column">
                </div>
            </div>
        </div>
        <div class="uk-section uk-container" id="about-page-sec">
            <div class="uk-grid uk-child-width-1-2@s" data-uk-grid="">
                <div class="uk-first-column">
                    <img src="{{ asset('frontend/assets/ab2.png') }}">
                </div>
                <div>
                    <div class="banner-card-text">
                        <h2>We sweat the intense stuff</h2>
                        <p>Each Khana Fresh meal is prepared by genuine culinary specialists utilizing the freshest spices,
                            vegetables, breads, and or halal meats. Your order is sent to our chefs who prepare your ready
                            to eat healthy meals.</p>
                    </div>
                </div>
                <div class="uk-grid-margin uk-first-column">
                </div>
            </div>
        </div>
        <div class="uk-section uk-container" id="about-page-sec">
            <div class="uk-grid uk-child-width-1-2@s" data-uk-grid="">
                <div class="banner-card-text uk-first-column">
                    <h2>Simply heat, eat and appreciate</h2>
                    <p>Khana Fresh meals can be warmed on the stove, in the oven, or microwave in minutes. We deal with
                        everything, so you don’t have to. </p>
                </div>
                <div class="">
                    <img src={{ asset('frontend/assets/1b3.webp') }}>
                </div>
                <div class="uk-grid-margin uk-first-column">
                </div>
            </div>
        </div>
        <div class="form1">
            <div class="section-title">
                <div class="uk-h2 uk-text-center">Want to know more</div>
                <div class="uk-h1 uk-text-center">ABOUT US</div>
                <div class="uk-h3 uk-text-center">Fill the form we will get back to you</div>
            </div>
            <div class="section-content" id="form1-content">
                <form action="#!">
                    <div class="uk-grid uk-grid-small uk-child-width-1-2@s" data-uk-grid="">
                        <div class="uk-first-column"><input class="uk-input uk-form-large" type="text"
                                placeholder="Your Name *"></div>
                        <div class=""><input class="uk-input uk-form-large" type="text" placeholder="Email *">
                        </div>
                        <div class="uk-width-1-1 uk-grid-margin uk-first-column"><input class="uk-input uk-form-large"
                                type="text" placeholder="Phone Number"></div>
                        <div class="uk-width-1-1 uk-first-column uk-grid-margin">
                            <textarea class="uk-textarea uk-form-large" placeholder="Message *"></textarea>
                        </div>
                        <div class="uk-grid-margin uk-first-column"><button class="uk-button uk-button-large" type="submit"
                                onclick="alert('Thanks For Giving Your Message')">Send</button></div>
                    </div>
                </form>
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
                                        alt="instagram"></li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src={{ asset('frontend/assets/img/footer/Mediterranean-chicken-with-saffron-rice.jpg') }}
                                        alt="instagram"></li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src={{ asset('frontend/assets/img/footer/Karahi-Gosht-served-with-our-signature-pita-naan.jpg ') }}
                                        alt="instagram"></li>
                                <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                        src={{ asset('frontend/assets/img/footer/Karahi-Chicken-served-with-our-signature-pita-naan.jpg') }}
                                        alt="instagram"></li>
                                <li tabindex="-1" class=""><img class="uk-width-1-1"
                                        src="{{ asset('frontend/assets/img/footer/Gosht-pulao.jpg') }}" alt="instagram">
                                </li>
                            </ul>
                        </div>
                        <ul id="insta-silde" class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top">
                            <li uk-slider-item="0" class="uk-active"><a href=""></a></li>
                            <li uk-slider-item="1"><a href=""></a></li>
                            <li uk-slider-item="2"><a href=""></a></li>
                            <li uk-slider-item="3"><a href=""></a></li>
                            <li uk-slider-item="4"><a href=""></a></li>
                            <li uk-slider-item="5"><a href=""></a></li>
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
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Dal-Fry-served-with-Basmati-Rice.jpg') }}
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Dal-curry-served-with-Basmati-Rice.jpg') }}
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Curry-khowsay.jpg') }} alt="instagram"></li>
                            <li tabindex="-1" class=""><img class="uk-width-1-1"
                                    src={{ asset('frontend/assets/img/footer/Malai-boti-paratha-roll.jpg.webp') }}
                                    alt="instagram"></li>
                        </ul>
                    </div>
                    <ul id="insta-silde" class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top">
                        <li uk-slider-item="0" class="uk-active"><a href=""></a></li>
                        <li uk-slider-item="1"><a href=""></a></li>
                        <li uk-slider-item="2"><a href=""></a></li>
                        <li uk-slider-item="3"><a href=""></a></li>
                        <li uk-slider-item="4"><a href=""></a></li>
                        <li uk-slider-item="5"><a href=""></a></li>
                    </ul>
                </div>
            </div>
        </div> --}}


    </main>
@endsection
