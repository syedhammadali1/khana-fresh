@extends('frontend.layouts.app')

@section('meta')
    <title>Contact Us</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@section('content')
    <main class="page-main">
        <div class="span12 widget-span widget-type-custom_widget " style="" data-widget-type="custom_widget" data-x="0"
            data-w="12">
            <div id="hs_cos_wrapper_module_15984274671381708"
                class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style=""
                data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <div class="single-sec-main lazy" style="background-image: url({{ asset('frontend/assets/conta.jpg') }});">
                    <div class="page-center">
                        <div class="single-sec-outer ">
                            <div class="title-text">
                                <h1>Contact Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-contacts-form">
            <div class="uk-section uk-container">
                <div class="uk-grid" data-uk-grid="">
                    <div class="uk-width-1-3@m uk-first-column" id="contact-form-text">
                        <div class="section-title">
                            <h2>
                                <h class="greeen">Contact </h>
                                us at
                            </h2>
                        </div>
                        <div class="section-content">
                            <ul class="contacts-list">
                                <li><i class="fa fa-envelope-open"></i> <a
                                        href="mailto:{{ getAdminEmail() }}">{{ getAdminEmail() }}</a></li>
                            </ul>
                            <hr class="uk-margin">
                        </div>
                    </div>
                    <div class="uk-width-2-3@m">
                        <div class="section-title" id="fillform-title">
                            <h3 class="uk-h3">Have a question or concern?</h3>
                        </div>
                        <div class="section-content">
                            <form class="contact-form-main" action="#!">
                                <div class="uk-grid uk-grid-medium uk-child-width-1-2@s" data-uk-grid="">
                                    <div class="uk-first-column"><input class="uk-input" type="text"
                                            placeholder="Your Name"></div>
                                    <div><input class="uk-input" type="text" placeholder="Email"></div>
                                    <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                        <textarea class="uk-textarea" name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="uk-grid-margin uk-first-column"><input class="uk-button" type="submit"
                                            value="Send message" onclick="alert('Thanks For Giving Your Message')"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </main>

    {{-- <div class="section-instagram">
    <div class="uk-container">
    </div>
    <div class="uk-container-expand">
      <div class="uk-margin-medium-top uk-slider" data-uk-slider="" id="second-slide">
        <div class="uk-position-relative">
          <div class="uk-slider-container uk-light">
            <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l uk-child-width-1-6@xl" style="transform: translate3d(0px, 0px, 0px);">
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Nihari-served-with-our-signature-pita-naan.jpg.webp') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Mutter-Kheema-served-with-handmade-roti.jpg') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Mediterranean-chicken-with-saffron-rice.jpg') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Karahi-Gosht-served-with-our-signature-pita-naan.jpg') }} " alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Karahi-Chicken-served-with-our-signature-pita-naan.jpg') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Gosht-pulao.jpg') }}" alt="instagram"></a></li>
            </ul>
          </div>
          <ul id="insta-silde" class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top" hidden=""><li uk-slider-item="0" hidden="" class="uk-active"><a href=""></a></li><li uk-slider-item="1" hidden=""><a href=""></a></li><li uk-slider-item="2" hidden=""><a href=""></a></li><li uk-slider-item="3" hidden=""><a href=""></a></li><li uk-slider-item="4" hidden=""><a href=""></a></li><li uk-slider-item="5" hidden=""><a href=""></a></li></ul>
        </div>
      </div>

    </div>
      <div class="uk-margin-medium-top uk-slider" data-uk-slider="" >
        <div class="uk-position-relative">
          <div class="uk-slider-container uk-light">
            <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l uk-child-width-1-6@xl" style="transform: translate3d(0px, 0px, 0px);">
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Gola-kabob-burrito-served-with-salsa-basmati-rice-and-chickpeas.jpg') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Dal-makhani-served-with-Basmati-Rice.jpg') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Dal-Fry-served-with-Basmati-Rice.jpg') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Dal-curry-served-with-Basmati-Rice.jpg') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Curry-khowsay.jpg') }}" alt="instagram"></li>
              <li tabindex="-1" class="uk-active"><img class="uk-width-1-1" src="{{ asset('frontend/assets/img/footer/Malai-boti-paratha-roll.jpg.webp') }}" alt="instagram"></li>
            </ul>
          </div>
          <ul id="insta-silde" class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top" hidden=""><li uk-slider-item="0" hidden="" class="uk-active"><a href=""></a></li><li uk-slider-item="1" hidden=""><a href=""></a></li><li uk-slider-item="2" hidden=""><a href=""></a></li><li uk-slider-item="3" hidden=""><a href=""></a></li><li uk-slider-item="4" hidden=""><a href=""></a></li><li uk-slider-item="5" hidden=""><a href=""></a></li></ul>
        </div>
    </div>
  </div> --}}
@endsection
