@extends('frontend.layouts.app')

@section('meta')
    <title>Dashboard</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/card.css') }}">
@endpush


@section('content')
    <!-- Modal -->
    <div class="modal fade" id="passchanger" tabindex="-1" role="dialog" aria-labelledby="passchangerLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passchangerLabel"> Confirm Your Identity</h5>

                </div>
                <form action="{{ route('frontend.pass.check') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div style="padding: 10px !important">
                            <label>Password</label>
                            <input required class="uk-input" type="password" Value="" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Show</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <main class="page-main greycolor">
        <div class="section-features">
            <div class="uk-section uk-container">
                <div class="section-title section-title--center">
                    <!-- <h3 class="uk-h3">How It Works</h3> -->
                </div>
                <div class="uk-grid uk-child-width-1-3@s" data-uk-grid="">
                    <div class="uk-first-column">
                        <div class="user-front user-active-dash" id="per-info" onclick="SPut('user-dash-form')">

                            <div class="px-3 py-2 rounded bg-indigo-600 text-white mr-3">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>

                            <div class="user-front-text">
                                <h1 class="user-front-font-semibold"><span class="num-2">Personal Info</span></h1>
                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="feature-item">
                            <div class="user-front" id="Pay-info" onclick="SPut('user-payment')">

                                <div class="px-3 py-2 rounded bg-indigo-600 text-white mr-3">
                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                </div>

                                <div class="user-front-text">
                                    <h1 class="user-front-font-semibold"><span class="num-2">Payment Info</span>
                                    </h1>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- <div>
                        <div class="feature-item">
                            <div class="user-front" >

                                <div class="px-3 py-2 rounded bg-indigo-600 text-white mr-3">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </div>

                                <div class="user-front-text">
                                    <h1 class="user-front-font-semibold"><span class="num-2">Menu</span></h1>
                                </div>

                            </div>
                        </div>
                    </div> --}}
                    <div class="feature-item">
                        <div class="user-front" id="Pay-Subscription" onclick="SPut('user-subscriptin')">

                            <div class="px-3 py-2 rounded bg-indigo-600 text-white mr-3">
                                <i class="fa fa-money-bill"></i>
                            </div>

                            <div class="user-front-text">
                                <h1 class="user-front-font-semibold"><span class="num-2">Subscription</span></h1>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- P0ersonal Info --}}
        <div class="uk-section uk-container">
            <div class="uk-grid uk-grid-stack" data-uk-grid="">

                <div class="uk-width-1-1@m uk-first-column" id="user-dash-form">
                    <div class="section-title" id="fillform-title">
                        <h3 class="uk-h3">Your Current Details</h3>
                    </div>
                    <div class="section-content">
                        <form class="contact-form-main" action="{{ route('frontend.profileupdate') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="uk-grid uk-grid-medium uk-child-width-1-2@s" data-uk-grid="">
                                <div class="uk-first-column"><label>Username</label>
                                    <input class="uk-input" type="text" Value="{{ auth()->user()->email }}">
                                </div>
                                <div><label>Email</label>
                                    <input class="uk-input" type="email" Value="{{ auth()->user()->email }}"
                                        disabled readonly>
                                </div>
                                <div><label>First Name</label>
                                    <input class="uk-input" type="text" Value="{{ auth()->user()->first_name }}"
                                        name="first_name">

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $errors->first('name') }}</strong> --}}
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div><label>Last Name</label>
                                    <input class="uk-input" type="text" Value="{{ auth()->user()->last_name }}"
                                        name="last_name">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $errors->first('name') }}</strong> --}}
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div><label>Address</label>
                                    <input class="uk-input" type="text" Value="{{ auth()->user()->address }}"
                                        name="address">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $errors->first('name') }}</strong> --}}
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div><label>Address Line 2</label>
                                    <input class="uk-input" type="text" Value="{{ auth()->user()->address2 }}"
                                        name="address2">

                                    @error('address2')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $errors->first('name') }}</strong> --}}
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div><label>City</label>
                                    <input class="uk-input" type="text" Value="{{ auth()->user()->city }}"
                                        name="city">

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $errors->first('name') }}</strong> --}}
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div><label>State</label>
                                    <input class="uk-input" type="text" Value="{{ auth()->user()->state }}"
                                        name="state">

                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $errors->first('name') }}</strong> --}}
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div><label>Zip Code</label>
                                    <input disabled readonly class="uk-input" type="number"
                                        value="{{ auth()->user()->zip }}">
                                </div>
                                <div><label>Phone Number</label>
                                    <input class="uk-input" type="text" id="phoneNo"
                                        value="{{ auth()->user()->phone }}" name="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $errors->first('name') }}</strong> --}}
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="uk-grid-margin uk-first-column">
                                    <input class="uk-button" type="submit" value="Update">
                                </div>
                        </form>
                    </div>
                </div>

                <div class="uk-width-1-1@m uk-first-column">

                    <div class="section-title" id="fillform-title">
                        <h3 class="uk-h3">Change Password</h3>
                    </div>

                    <div class="section-content">
                        <form class="contact-form-main" action="{{ route('frontend.changePassword') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="uk-grid uk-grid-medium uk-child-width-1-1@s" data-uk-grid="">
                                <div> <label> Old Password</label><input class="uk-input uk-form-large" type="password"
                                        autocomplete="current-password" name="old_password">
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $errors->first('name') }}</strong> --}}
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div> <label>New Password</label><input class="uk-input uk-form-large" type="password"
                                        name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div> <label>Confirm Password</label><input class="uk-input uk-form-large" type="password"
                                        name="confirm_password">
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="alert-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="uk-grid-margin uk-first-column"><input class="uk-button" type="submit"
                                        value="Update"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- P0ersonal Info --}}

        {{-- Payment Info --}}
        <div class="uk-grid uk-grid-stack" data-uk-grid="">
            <div class="uk-width-1-1@m uk-first-column" id="user-payment">
                <div class="section-title" id="fillform-title">
                    <h3 class="uk-h3">Payment Info</h3>
                </div>
                @if (is_null(auth()->user()->card))
                    no card
                @else
                    <div class="section-content">
                        <div class="container preload">
                            <div class="creditcard">
                                <div class="front">
                                    <div id="ccsingle"></div>
                                    <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471"
                                        style="enable-background:new 0 0 750 471;" xml:space="preserve">
                                        <g id="Front">
                                            <g id="CardBackground">
                                                <g id="Page-1_1_">
                                                    <g id="amex_1_">
                                                        <path id="Rectangle-1_1_" class="lightcolor grey"
                                                            d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                                                                                                                                                                     C0,17.9,17.9,0,40,0z" />
                                                    </g>
                                                </g>
                                                <path class="darkcolor greydark"
                                                    d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z" />
                                            </g>
                                            <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber"
                                                class="st2 st3 st4">
                                                @if (!cache()->get('checkCardNumber'))
                                                    {{ auth()->user()->card->card_hidden_number }}
                                                @else
                                                    {{ auth()->user()->card->card_number }}
                                                @endif
                                            </text>
                                            <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname"
                                                class="st2 st5 st6">{{ auth()->user()->card->holder_name }}</text>
                                            <text transform="matrix(1 0 0 1 54.1074 389.8793)"
                                                class="st7 st5 st8">cardholder
                                                name</text>
                                            <text transform="matrix(1 0 0 1 479.7754 388.8793)"
                                                class="st7 st5 st8">expiration</text>
                                            <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">card
                                                number</text>
                                            <g>
                                                <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire"
                                                    class="st2 st5 st9">{{ auth()->user()->card->formatted_date }}</text>
                                                <text transform="matrix(1 0 0 1 479.3848 417.0097)"
                                                    class="st2 st10 st11">VALID</text>
                                                <text transform="matrix(1 0 0 1 479.3848 435.6762)"
                                                    class="st2 st10 st11">THRU</text>
                                                <polygon class="st2"
                                                    points="554.5,421 540.4,414.2 540.4,427.9 		" />
                                            </g>
                                            <g id="cchip">
                                                <g>
                                                    <path class="st2"
                                                        d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
                                                                                                                                                          c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z" />
                                                </g>
                                                <g>
                                                    <g>
                                                        <rect x="82" y="70" class="st12" width="1.5"
                                                            height="60" />
                                                    </g>
                                                    <g>
                                                        <rect x="167.4" y="70" class="st12" width="1.5"
                                                            height="60" />
                                                    </g>
                                                    <g>
                                                        <path class="st12"
                                                            d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                                                                                                                                                                c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                                                                                                                                                                C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                                                                                                                                                                c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                                                                                                                                                                c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z" />
                                                    </g>
                                                    <g>
                                                        <rect x="82.8" y="82.1" class="st12" width="25.8"
                                                            height="1.5" />
                                                    </g>
                                                    <g>
                                                        <rect x="82.8" y="117.9" class="st12" width="26.1"
                                                            height="1.5" />
                                                    </g>
                                                    <g>
                                                        <rect x="142.4" y="82.1" class="st12" width="25.8"
                                                            height="1.5" />
                                                    </g>
                                                    <g>
                                                        <rect x="142" y="117.9" class="st12" width="26.2"
                                                            height="1.5" />
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                        <g id="Back">
                                        </g>
                                    </svg>
                                </div>
                                <div class="back">
                                    <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471"
                                        style="enable-background:new 0 0 750 471;" xml:space="preserve">
                                        <g id="Front">
                                            <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11" />
                                        </g>
                                        <g id="Back">
                                            <g id="Page-1_2_">
                                                <g id="amex_2_">
                                                    <path id="Rectangle-1_2_" class="darkcolor greydark"
                                                        d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                                                                                                                                                          C0,17.9,17.9,0,40,0z" />
                                                </g>
                                            </g>
                                            <rect y="61.6" class="st2" width="750" height="78" />
                                            <g>
                                                <path class="st3"
                                                    d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
                                                                                                                                                                                              C707.1,246.4,704.4,249.1,701.1,249.1z" />
                                                <rect x="42.9" y="198.6" class="st4" width="664.1"
                                                    height="10.5" />
                                                <rect x="42.9" y="224.5" class="st4" width="664.1"
                                                    height="10.5" />
                                                <path class="st5"
                                                    d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z" />
                                            </g>
                                            <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity"
                                                class="st6 st7">985</text>
                                            <g class="st8">
                                                <text transform="matrix(1 0 0 1 518.083 280.0879)"
                                                    class="st9 st6 st10">security code</text>
                                            </g>
                                            <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5" />
                                            <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5" />
                                            <text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback"
                                                class="st12 st13">John Doe</text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <form class="contact-form-main"
                            action="{{ route('frontend.updateCard', auth()->user()->card) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="uk-grid uk-grid-medium uk-child-width-1-3@l" data-uk-grid="">
                                <div class="uk-first-column">
                                    <label>Card Holder Name</label>
                                    <input class="uk-input" type="text"
                                        Value="{{ auth()->user()->card->holder_name }}" name="holder_name">
                                    @error('holder_name')
                                        <span class="text-danger">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <label>Card Number
                                        <button id="passchangerbtn" type="button" data-toggle="modal"
                                            data-target="#passchanger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                        </button>
                                    </label>
                                    <input class="uk-input" type="text"
                                        @if (!cache()->get('checkCardNumber')) Value="{{ auth()->user()->card->card_hidden_number }}" readonly @else Value="{{ auth()->user()->card->card_number }}" @endif
                                        name="card_name">
                                    @error('card_name')
                                        <span class="text-danger">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Button trigger modal -->



                                {{-- <div><label>CVC</label><input class="uk-input" type="number"
                                        Value="{{ auth()->user()->card->cvc }}" name="cvc">
                                    @error('cvc')
                                        <span class="text-danger">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div><label>Expiry Date</label>
                                    <input class="uk-input" type="month" id="cardExpiry"
                                        Value="{{ auth()->user()->card->expiry_date }}" name="expiry_date">
                                    @error('expiry_date')
                                        <span class="text-danger">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div id="cardUpdateButton" class="uk-grid-margin uk-first-column">
                                    <input class="uk-button" type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

            </div>
        </div>






        <div class="uk-grid uk-grid-stack" data-uk-grid="" style="display: block">

            <div class="uk-width-1-1@m uk-first-column" id="user-subscriptin">
                <div class="section-title" id="fillform-title">
                    <h3 class="uk-h3">Subscription Plan</h3>
                </div>


                <div class="section-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Current Status</th>
                                <th>Action Buttons</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (auth()->user()->plan as $item)
                                @livewire('component.frontend.menu.user.plan-status',[
                                'item'=>$item
                                ])
                            @empty
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </main>

    <script>
        $(document).ready(function() {
            $('#phoneNo').mask("999-999-0000")

        });
    </script>
@endsection


@push('js')
    <script src="{{ asset('frontend/assets/js/card.js') }}"></script>

    <script>
        function SPut(params) {
            $.ajax({
                url: "processing-status-dashboard",
                data: {
                    for: 'put',
                    name: params
                }
            });
        }

        $(document).ready(function() {
            $.ajax({
                url: "processing-status-dashboard",
                data: {
                    for: 'get',
                },
                success: function(result) {
                    array = [
                        'user-payment',
                        'user-dash-form',
                        'user-subscriptin',
                    ]

                    var result = result.replace('"', '');
                    var result = result.replace('"', '');
                    if (result == 'null') {
                        var result = 'user-dash-form'
                    }
                    $.each(array, function(k, v) {
                        if (v == result) {
                            $("#" + v).show();
                        } else {
                            $("#" + v).hide();
                        }
                    });
                    var btnArray = {
                        "user-payment": "Pay-info",
                        "user-dash-form": "per-info",
                        "user-subscriptin": "Pay-Subscription",
                    };
                    let myBtns = document.querySelectorAll('.user-front');
                    myBtns.forEach(b => b.classList.remove('user-active-dash'));
                    $('#' + btnArray[result]).addClass("user-active-dash");
                }
            });

            var card = {!! json_encode(cache()->get('checkCardNumber')) !!};
            if (card != null) {
                $('#passchangerbtn').hide();
            } else {
                $('#cardUpdateButton').hide();
            }
        })
    </script>
@endpush
