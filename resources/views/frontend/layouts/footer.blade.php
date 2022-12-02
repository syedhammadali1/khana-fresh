<footer class="page-footer">
    <div class="page-footer__top">
        <div class="uk-container">
            <div class="page-footer__contacts">
                <div class="contact-item-box">
                    <div class="contact-item-box__value"><img
                            src="{{ asset('frontend/assets/img/Khana-fresh-Logo.png') }}"></div>
                </div>
                <div class="under-line">
                    <div class="contact-item-box">
                        <div class="contact-item-box__value">
                            <p><a href="{{ route('frontend.home') }}">Home</a></p>
                            <p><a href="{{ route('frontend.aboutus') }}">About Us</a></p>
                            <p><a href="{{ route('frontend.plan') }}">Plan</a></p>
                            <p><a href="{{ route('frontend.menu') }}">Menu</a></p>
                        </div>
                    </div>
                    <div class="contact-item-box">
                        <div class="contact-item-box__value">
                            @auth
                            <p><a href="{{ route('frontend.dashboard') }}">Dashboard</a></p>

                            @else
                            <p><a href="{{ route('frontend.myaccount') }}">My Account</a></p>

                            @endauth

                            <p><a href="{{ route('frontend.latestnews') }}">Latest News</a></p>
                            <p><a href="{{ route('frontend.contactus') }}">Contact Us</a></p>
                            <p><a href="{{ route('frontend.terms') }}">Terms & Conditions</a></p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="page-footer__bottom">
        <div class="uk-container  ">
            <div class="uk-grid uk-child-width-1-4@s" data-uk-grid="">
                <div class="uk-first-column">
                </div>
                <div>
                </div>
                <div class="footer-bottom-text">
                    <p><a href="mailto:{{ getAdminEmail() }}">{{ getAdminEmail() }}</a></p>
                </div>
                <div class="page-footer__social">
                    <div class="page-footer__social">
                        <ul class="social">
                            <li class="social-item"><a class="social-link" href="https://twitter.com/khana_fresh"
                                    target="_blank"><svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true"
                                        focusable="false" data-prefix="fab" data-icon="twitter" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                        </path>
                                    </svg>
                                    <!-- <i class="fab fa-twitter"></i> Font Awesome fontawesome.com --></a>
                            </li>
                            <li class="social-item"><a class="social-link"
                                    href="https://www.facebook.com/KhanaFreshForYou" target="_blank"><svg
                                        class="svg-inline--fa fa-facebook-f fa-w-10" aria-hidden="true"
                                        focusable="false" data-prefix="fab" data-icon="facebook-f" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                                        </path>
                                    </svg>
                                    <!-- <i class="fab fa-facebook-f"></i> Font Awesome fontawesome.com --></a>
                            </li>
                            <li class="social-item"><a class="social-link"
                                    href="https://www.instagram.com/khanafreshforyou/" target="_blank"><svg
                                        class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true"
                                        focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
                                        </path>
                                    </svg>
                                    <!-- <i class="fab fa-linkedin-in"></i> Font Awesome fontawesome.com --></a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-footer__copy"><span>© Copyrights 2022 Khana Fresh. All rights reserved.</span></div>
    </div>

    </div>
    <div id="offcanvas" data-uk-offcanvas="overlay: true" class="uk-offcanvas">
        <div class="uk-offcanvas-bar"><button class="uk-offcanvas-close uk-icon uk-close" type="button"
                data-uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"
                    data-svg="close-icon">
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                </svg></button>
            <div class="uk-margin-top">
                <ul class="uk-nav">
                    @auth
                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li><a href="{{ route('frontend.aboutus') }}">About Us</a></li>
                    <li><a href="{{ route('frontend.plan') }}">Plan</a></li>
                    <li><a href="{{ route('frontend.menu') }}">Menu</a></li>
                    <li><a href="{{ route('frontend.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('frontend.latestnews') }}">Latest News</a></li>
                    <li><a href="{{ route('frontend.contactus') }}">Contact Us</a></li>
                    <li><a href="{{ route('frontend.terms')}}"> Terms & Conditions</a></li>
                    @else

                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li><a href="{{ route('frontend.aboutus') }}">About Us</a></li>
                    <li><a href="{{ route('frontend.plan') }}">Plan</a></li>
                    <li><a href="{{ route('frontend.menu') }}">Menu</a></li>
                    <li><a href="{{ route('frontend.myaccount') }}">My Account</a></li>
                    <li><a href="{{ route('frontend.latestnews') }}">Latest News</a></li>
                    <li><a href="{{ route('frontend.contactus') }}">Contact Us</a></li>
                    <li><a href="{{ route('frontend.terms')}}"> Terms & Conditions</a></li>
                    @endauth


                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- <div class="uk-flex-top" id="callback" data-uk-modal="">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical"><button class="uk-modal-close-default" type="button" data-uk-close=""></button>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div> -->
    <div class="uk-modal-full uk-modal" id="modal-full" data-uk-modal="">
        <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" data-uk-height-viewport=""><button
                class="uk-modal-close-full uk-icon uk-close" type="button" data-uk-close=""><svg width="14" height="14"
                    viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon">
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                </svg></button>
            <form class="uk-search uk-search-large" action="{{ route('frontend.search') }}" method="GET">

                <input class="uk-search-input uk-text-center" type="search"
                    placeholder="Search..." autofocus="" name="keyword" value="{{ request()->keyword }}">
                </form>

        </div>
    </div>
</footer>

