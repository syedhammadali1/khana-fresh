@extends('frontend.layouts.app')

{{-- @dd($disabled_dates) --}}
@section('meta')
    <title>Menu</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@section('content')
    <main class="page-main greycolor">
        {{-- banner slider --}}
        <div class="span12 widget-span widget-type-custom_widget " style="" data-widget-type="custom_widget" data-x="0"
            data-w="12">
            <div id="hs_cos_wrapper_module_15984274671381708"
                class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" style=""
                data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <div class="single-sec-main lazy"
                    style="background-image: url({{ asset('frontend/assets/menu-banner-1.jpg') }});">
                    <div class="page-center uk-grid uk-child-width-1-3@s">
                        <div style=" margin-top: -2%;">
                            <h2>Latest Meal</h2>
                            <ul class="uk-switcher">

                                <li class="uk-active" style="">
                                    <div data-uk-slider="" class="uk-slider">
                                        <div class="uk-position-relative">
                                            <div class="uk-slider-container uk-light">
                                                <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-1@s"
                                                    style="transform: translate3d(0px, 0px, 0px);">

                                                    <!-- foreach loop will start from this one -->
                                                    @foreach ($featuredProducts as $fitem)
                                                        <li tabindex="-1" class="uk-active" style="order: -1;">
                                                            <div class="product-item">
                                                                <div class="product-item__box">
                                                                    <div class="product-item__intro">
                                                                        <div class="product-item__not-active">
                                                                            <div class="product-item__media">
                                                                                <div class="uk-inline-clip uk-transition-toggle uk-light"
                                                                                    data-uk-lightbox="data-uk-lightbox"
                                                                                    style="box-shadow: 2px 2px 2px 2px rgb(114 114 114 / 0%);">
                                                                                    @if ($fitem->halal == 1)
                                                                                        <div
                                                                                            class="ribbono ribbono-top-right">
                                                                                            <span>Vegetarian</span>
                                                                                        </div>
                                                                                    @endif
                                                                                    <a
                                                                                        href="{{ $fitem->getFirstMediaUrl('image') }}">
                                                                                        <img src="{{ $fitem->getFirstMediaUrl('image') }}"
                                                                                            alt="Neapolitan Pizza"
                                                                                            style="height: 266px;border-radius: 55px; ">
                                                                                        <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary"
                                                                                            style="background: none;">
                                                                                        </div>
                                                                                        <div class="uk-position-center">
                                                                                            <span
                                                                                                class="uk-transition-fade uk-icon"
                                                                                                data-uk-icon="icon: search;">
                                                                                                <svg width="20" height="20"
                                                                                                    viewBox="0 0 20 20"
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    data-svg="search">
                                                                                                    <circle fill="none"
                                                                                                        stroke="#000"
                                                                                                        stroke-width="1.1"
                                                                                                        cx="9" cy="9" r="7">
                                                                                                    </circle>
                                                                                                    <path fill="none"
                                                                                                        stroke="#000"
                                                                                                        stroke-width="1.1"
                                                                                                        d="M14,14 L18,18 L14,14 Z">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        </div>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-item__whish"><svg
                                                                                        class="svg-inline--fa fa-heart fa-w-16"
                                                                                        aria-hidden="true" focusable="false"
                                                                                        data-prefix="fas" data-icon="heart"
                                                                                        role="img"
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 512 512"
                                                                                        data-fa-i2svg="">
                                                                                        <path fill="currentColor"
                                                                                            d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                                                                                        </path>
                                                                                    </svg>
                                                                                    <!-- <i class="fas fa-heart"></i> Font Awesome fontawesome.com -->
                                                                                </div>
                                                                                <div class="product-item__tooltip"
                                                                                    data-uk-tooltip="title: vegetarian pizza; pos: bottom-right"
                                                                                    title="" aria-expanded="false"
                                                                                    tabindex="0">
                                                                                    <svg class="svg-inline--fa fa-info-circle fa-w-16"
                                                                                        aria-hidden="true" focusable="false"
                                                                                        data-prefix="fas"
                                                                                        data-icon="info-circle" role="img"
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 512 512"
                                                                                        data-fa-i2svg="">
                                                                                        <path fill="currentColor"
                                                                                            d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z">
                                                                                        </path>
                                                                                    </svg>
                                                                                    <!-- <i class="fas fa-info-circle"></i> Font Awesome fontawesome.com -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="product-item__title">
                                                                                <a
                                                                                    href="{{ route('frontend.recipes', ['product' => $fitem]) }}">{{ $fitem->name }}</a>
                                                                            </div>
                                                                            {{-- <div class="product-item__desc">
                                                                            {{ $fitem->description }}
                                                                        </div> --}}

                                                                        </div>

                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach



                                                </ul>
                                            </div>
                                            <div class="uk-visible@l"><a
                                                    class="uk-position-top-left-out uk-icon uk-slidenav-previous uk-slidenav"
                                                    href="#" data-uk-slidenav-previous=""
                                                    data-uk-slider-item="previous"><svg width="14px" height="24px"
                                                        viewBox="0 0 14 24" xmlns="http://www.w3.org/2000/svg"
                                                        data-svg="slidenav-previous">
                                                        <polyline fill="none" stroke="#000" stroke-width="1.4"
                                                            points="12.775,1 1.225,12 12.775,23 "></polyline>
                                                    </svg></a>
                                                <a class="uk-position-top-right-out uk-icon uk-slidenav-next uk-slidenav"
                                                    href="#" data-uk-slidenav-next="" data-uk-slider-item="next"><svg
                                                        width="14px" height="24px" viewBox="0 0 14 24"
                                                        xmlns="http://www.w3.org/2000/svg" data-svg="slidenav-next">
                                                        <polyline fill="none" stroke="#000" stroke-width="1.4"
                                                            points="1.225,23 12.775,12 1.225,1 "></polyline>
                                                    </svg></a>
                                            </div>
                                            <div class="uk-hidden@l" style="
                                                                  display: block!important;
                                                                  margin-top: -11%;
                                                              ">
                                                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top">
                                                    <li uk-slider-item="0" class="uk-active"><a href=""></a></li>
                                                    <li uk-slider-item="1" class=""><a href=""></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>



                            </ul>
                        </div>
                        <div class="single-sec-outer ">
                            <div class="title-text">
                                <h1> Menu</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- bannerend --}}

        {{-- start searchbar and products --}}
    
        <div class="page-content uk-text-center">
            <div class="uk-margin-large-top uk-container">
                <div class="pizza-builder">
                    <div class="uk-grid uk-grid-stack" data-uk-grid="">
                        <div class="uk-width-4-4@m uk-first-column">
                            <div class="pizza-builder-steps">
                                <div class="pizza-builder-step">
                                    <div class="pizza-builder-step">
                                        <div class="pizza-builder-step__title" id="menu-page-title">
                                            <h2><b> Delivered fresh to your door</b>
                                                <br>
                                                <p>Chef
                                                    Inspired meals, made from fresh ingredients.</p>
                                            </h2>
                                        </div>
                                        @livewire('component.frontend.menu.product')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
