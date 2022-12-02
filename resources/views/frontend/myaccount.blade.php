@extends('frontend.layouts.app')

@section('meta')
    <title>Login</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@section('content')
    <main class="page-main" id="background-grey">

        <!-- <div class="section-about">
                                      <div class="uk-section uk-container">
                                        <div class="uk-grid uk-child-width-1-2@m uk-flex-middle" data-uk-grid="">
                                          <div class="uk-text-center uk-first-column"><img src="assets/img/pages/home/img-about.png" alt=""></div>
                                          <div>
                                            <div class="section-title burger wave">
                                              <h3 class="uk-h3">Cooking With Passion</h3>
                                            </div>
                                            <div class="section-content">
                                              <p>Incididunt ut labore et dolore magna aliqua enim ad minim veniam quisya nostrud exercitation ullamco laboris nisi ut aliquip ex ea com labmodo consequat dhuis aute irure dolor in reprehen deritn volupta velit esse id est anim laborum. </p>
                                              <p>Cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupida non oident sunt in culpa qui officia deserunt mollit.</p>
                                              <div class="uk-margin-medium-top"><a class="uk-button" href="page-blog-article.html"><span>Read More</span><img class="uk-margin-small-left" src="assets/img/icons/ice-cream.svg" alt=""></a></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div> -->
        <!-- How To Work Section Start -->


        <!-- Meals Start -->

        <div class="section-banners">
            <div class="uk-section uk-container">
                <div class="uk-grid uk-grid-medium uk-child-width-1-2@m" data-uk-grid>
                    <div>
                        <div class="account">
                            <img src="{{ asset('frontend/assets/account-icon-png-2.jpg') }}" />
                        </div>
                    </div>
                    <div>
                        <div class="account-text">
                            <div class="uk-h3">YOUR DASHBOARD TOOLS</div>
                            <div class="uk-h2">ACCOUNT DASHBOARD</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @guest
            <div class="section-banners">
                <div class="uk-section uk-container">
                    <div class="uk-grid uk-grid-medium uk-child-width-1-2@m" data-uk-grid>
                        <div>
                            <div class="login-form">
                                <div class="section-title">
                                    <div class="uk-h2">Login</div>
                                </div>
                                <div class="section-content" id="login-form-content">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="uk-grid uk-grid-small uk-child-width-1-2@s" data-uk-grid="">
                                            <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                                <label>Username or email address *</label>
                                                <input class="uk-input uk-form-large" type="email" name="email"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="uk-width-1-1 uk-grid-margin uk-first-column" id="show_hide_password">
                                                <label>Password *</label><a href=""><i class="fa fa-eye"></i></a>
                                                <input class="uk-input uk-form-large" type="password"
                                                    autocomplete="current-password" name="password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="uk-grid-margin uk-first-column"><button
                                                    class="uk-button uk-button-large" type="submit">Login</button></div>

                                        </div>

                                    </form>
                                    {{-- <label id="lostyour">Lost your password?</label> --}}

                                    @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}" style="text-decoration: none; color:black; ">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="register-form">
                                <div class="section-title">
                                    <div class="uk-h2">Register</div>
                                </div>
                                <div class="section-content" id="register-form-content">
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="uk-grid uk-grid-small uk-child-width-1-2@s" data-uk-grid="">
                                            <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                                <label>Email address *</label>
                                                <input class="uk-input uk-form-large" type="email" name="register_email"
                                                    value="{{ old('register_email') }}">
                                                @error('register_email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                {{-- <label >A password will be sent to your email address.</label> --}}
                                            </div>
                                            <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                                <label>Password</label>
                                                <input class="uk-input uk-form-large" type="password" name="register_password"
                                                    value="{{ old('register_password') }}">
                                                @error('register_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                                <label>Zipcode *</label>
                                                <input class="uk-input uk-form-large" type="number"
                                                    autocomplete="current-password" name="register_zip"
                                                    value="{{ old('register_zip') }}">
                                                @error('register_zip')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                                <input type="checkbox" name="terms">
                                                <label for="">Agree to Terms and Conditions</label>
                                            </div>

                                            <div class="uk-grid-margin uk-first-column"><button
                                                    class="uk-button uk-button-large" type="submit">Register</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endguest



        <div class="section-banners">

            <div class="uk-section uk-container">
                <div class="uk-h3 uk-text-center">GOT A QUESTION OR NEED SOME HELP?</div>

                <div class="uk-grid uk-grid-medium uk-child-width-1-1@m" data-uk-grid>

                    <div>
                        <div class="form1">
                            <div class="section-content">
                                <form action="#!">
                                    <div class="uk-grid uk-grid-small uk-child-width-1-2@s" data-uk-grid="">
                                        <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                            <div class="uk-grid-margin uk-first-column"><input
                                                    class="uk-input uk-form-large" type="text" placeholder="Name *"></div>
                                        </div>
                                        <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                            <div class="uk-grid-margin uk-first-column"><input
                                                    class="uk-input uk-form-large" type="email" placeholder="Email *"></div>
                                        </div>
                                        <div class="uk-width-1-1 uk-first-column" id="">
                                            <textarea class="uk-textarea uk-form-large" placeholder="Message *"></textarea>
                                        </div>
                                        <div class="uk-grid-margin uk-first-column"><button
                                                class="uk-button uk-button-large" type="submit">Send</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Meals End -->

        <!-- frequently asked questions Start -->

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
        </div> --}}
    </main>
@endsection
