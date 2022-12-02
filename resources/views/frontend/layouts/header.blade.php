 <header class="page-header">
     <div class="page-header__top">
         <div class="uk-container">
             <nav class="uk-navbar-container uk-navbar-transparent uk-navbar" data-uk-navbar="">
                 <div class="uk-navbar-left"><button class="uk-button uk-icon" type="button" data-target="#offcanvas"
                         data-uk-toggle="" data-uk-icon="menu" aria-expanded="false"><svg width="20" height="20"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="menu">
                             <rect x="2" y="4" width="16" height="1"></rect>
                             <rect x="2" y="9" width="16" height="1"></rect>
                             <rect x="2" y="14" width="16" height="1"></rect>
                         </svg></button>
                     <ul class="uk-navbar-nav">
                         <li><a href="{{ route('frontend.aboutus') }}">How It Works</a></li>
                         <li><a href="{{ route('frontend.plan') }}">Our Plan</a></li>
                         <li><a href="{{ route('frontend.menu') }}">Menu</a></li>
                     </ul>
                 </div>
                 <div class="uk-navbar-center">
                     <div class="logo">
                         <div class="logo__box"><a class="logo__link" href="{{ route('frontend.home') }}">
                                 <img class="logo__img logo__img--full"
                                     src="{{ asset('frontend/assets/img/Khana-fresh-Logo.png') }}" alt="logo"><img
                                     class="logo__img logo__img-small"
                                     src="{{ asset('frontend/assets/img/Khana-fresh-Logo.png') }}" alt="logo"></a>
                         </div>
                     </div>
                 </div>
                 <div class="uk-navbar-right"><a class="uk-button" data-toggle="modal" data-target="#myModal">GET
                         40% OFF</a>
                     <ul class="uk-navbar-nav">
                         @auth
                             <li><a href="{{ route('frontend.dashboard') }}">Dashboard</a></li>
                         @else
                             <li><a href="{{ route('frontend.myaccount') }}">My Account</a></li>
                         @endauth

                         <li><a href="{{ route('frontend.latestnews') }}">Blog</a></li>
                         <li><a href="{{ route('frontend.contactus') }}">Contact Us</a></li>
                     </ul>
                 </div>
             </nav>
         </div>
     </div>
     <div class="page-header__bottom">
         <div class="uk-container">
             <div class="uk-navbar-container uk-navbar-transparent uk-navbar" data-uk-navbar="">
                 <div class="uk-navbar-left">
                     <div>
                         <div class="block-with-phone"><img src="{{ asset('frontend/assets/emailgreen.png') }}"
                                 alt="delivery" width="42" height="28">
                             <div> <span>For More Information </span><a
                                     href="mailto:{{ getAdminEmail() }}">{{ getAdminEmail() }}</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="uk-navbar-center"></div>
                 <div class="uk-navbar-right">
                     <div class="other-links">
                         <ul class="other-links-list">
                             <li><a href="#modal-full" data-uk-toggle="" aria-expanded="false"><span
                                         data-uk-icon="search" class="uk-icon"><svg width="20" height="20"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="search">
                                             <circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7">
                                             </circle>
                                             <path fill="none" stroke="#000" stroke-width="1.1"
                                                 d="M14,14 L18,18 L14,14 Z"></path>
                                         </svg></span></a></li>

                             @auth
                                 <li id="user-icon-dash"><span class="uk-icon"><img
                                             src="https://img.icons8.com/color/48/000000/user.png"
                                             style="height: 39px" /></span>
                                     <div class="dropdown-content">
                                         <a href="{{ route('frontend.dashboard') }}">
                                             <p>Dashboard</p>
                                         </a>
                                         <a href="{{ route('frontend.logout') }}">
                                             <p>Sign Out</p>
                                         </a>
                                     </div>
                                 </li>
                             @else
                                 <li><a href="{{ route('frontend.myaccount') }}"><span data-uk-icon="user"
                                             class="uk-icon"><svg width="20" height="20" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg" data-svg="user">
                                                 <circle fill="none" stroke="#000" stroke-width="1.1" cx="9.9" cy="6.4"
                                                     r="4.4"></circle>
                                                 <path fill="none" stroke="#000" stroke-width="1.1"
                                                     d="M1.5,19 C2.3,14.5 5.8,11.2 10,11.2 C14.2,11.2 17.7,14.6 18.5,19.2">
                                                 </path>
                                             </svg></span></a></li>

                             @endauth









                         </ul>
                         <a id="for-free-de" href="{{ route('frontend.dashboard') }}">50% off<br /> On Your First
                             Order
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </header>
