@extends('frontend.layouts.app')

@section('meta')
    <title>Latest News</title>
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
                <div class="single-sec-main lazy"
                    style="background-image: url({{ asset('frontend/assets/blog-page-banner.jpg') }});">
                    <div class="page-center">
                        <div class="single-sec-outer ">
                            <div class="title-text">
                                <h1>Latest News</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-blog">
            <div class="uk-section uk-container">
                <div class="section-title section-title--center">
                    <h3 class="uk-h3">News Blog Articles</h3>
                </div>
                <div class="section-content">
                    <div class="uk-margin-medium-top uk-slider" data-uk-slider="">
                        <div class="uk-position-relative">
                            <div class="uk-slider-container">
                                <ul class="uk-slider-items uk-grid uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-3@xl uk-child-width-1-3@xl"
                                    style="transform: translate3d(0px, 0px, 0px);">
                                    @forelse ($blogs as $item)
                                        <li tabindex="-1" class="uk-active">
                                            <div class="article-card">
                                                <div class="article-card__media"><a
                                                        href="{{ route('frontend.singleblog', $item) }}"><img
                                                            src="{{ $item->getFirstMediaUrl('image') }}"
                                                            alt="Soft &amp; fresh-baked chocolate cookie with chunks" style="height:15rem;width:25rem;"></a>
                                                </div>
                                                <div class="article-card__body">
                                                    <div class="article-card__info"><span
                                                            class="article-card__date">{{ $item->created_at->format('d-M-y') }}</span>
                                                    </div>
                                                    <div class="article-card__title"><a
                                                            href="{{ route('frontend.singleblog', $item) }}">{{ $item->title }}</a>
                                                    </div>
                                                    <div class="article-card__intro">
                                                        {!! $item->description !!}
                                                    </div>
                                                    <div class="article-card__more"> <a class="uk-button-link uk-icon"
                                                            href="{{ route('frontend.singleblog', $item) }}"
                                                            data-uk-icon="arrow-right">Read more<svg width="20" height="20"
                                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                                                data-svg="arrow-right">
                                                                <polyline fill="none" stroke="#000"
                                                                    points="10 5 15 9.5 10 14">
                                                                </polyline>
                                                                <line fill="none" stroke="#000" x1="4" y1="9.5" x2="15"
                                                                    y2="9.5"></line>
                                                            </svg></a></div>
                                                </div>
                                            </div>
                                        </li>

                                    @empty

                                        No Blogs
                                    @endforelse

                                </ul>
                            </div>
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


    </main>
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
                                    src="{{ asset('frontend/assets/img/footer/Nihari-served-with-our-signature-pita-naan.jpg.webp') }}"
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Mutter-Kheema-served-with-handmade-roti.jpg') }}"
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Mediterranean-chicken-with-saffron-rice.jpg') }}"
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Karahi-Gosht-served-with-our-signature-pita-naan.jpg') }} "
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Karahi-Chicken-served-with-our-signature-pita-naan.jpg') }}"
                                    alt="instagram"></li>
                            <li tabindex="-1" class="uk-active"><img class="uk-width-1-1"
                                    src="{{ asset('frontend/assets/img/footer/Gosht-pulao.jpg') }}" alt="instagram"></a>
                            </li>
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
                                src="{{ asset('frontend/assets/img/footer/Curry-khowsay.jpg') }}" alt="instagram"></li>
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
    </div> --}}
@endsection
