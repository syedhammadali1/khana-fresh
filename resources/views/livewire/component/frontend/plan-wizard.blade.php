<div>

    <div class="pizza-builder-step__title">
        @if ($step == 1)
            <div class="pizza-builder-step__numb">1</div>
            <h3 class="uk-h3">Select Your Plan</h3>
        @endif
        @if ($step == 2)
            <div class="pizza-builder-step__numb">2</div>
            <h3 class="uk-h3">Select Your Meal</h3>
        @endif
        @if ($step == 3)
            <div class="pizza-builder-step__numb">3</div>
            <h3 class="uk-h3">Select Your Weeks Day</h3>
        @endif
        @if ($step == 4)
            <div class="pizza-builder-step__numb">4</div>
            <h3 class="uk-h3">Your Personal Information</h3>
        @endif
        @if ($step == 5)
            <div class="pizza-builder-step__numb">5</div>
            <h3 class="uk-h3">Payment Information</h3>
        @endif
    </div>
    <div class="pizza-builder-step__content">
        <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="{{ $step >= 1 ? 'active-progress' : '' }}">
                    <div class="before-p-plan">
                        <p>1</p>
                    </div><strong>Select Plan</strong>
                </li>
                <li class="{{ $step >= 2 ? 'active-progress' : '' }}">
                    <div class="before-p-plan">
                        <p>2</p>
                    </div><strong>Select Meal</strong>
                </li>
                <li class="{{ $step >= 3 ? 'active-progress' : '' }}">
                    <div class="before-p-plan">
                        <p>3</p>
                    </div><strong>Select Week's Day</strong>
                </li>
                <li class="{{ $step >= 4 ? 'active-progress' : '' }}">
                    <div class="before-p-plan">
                        <p>4</p>
                    </div><strong>Personal</strong>
                </li>
                <li class="{{ $step >= 5 ? 'active-progress' : '' }}">
                    <div class="before-p-plan">
                        <p>5</p>
                    </div><strong>Payment</strong>
                </li>
            </ul> <!-- fieldsets -->
            <fieldset style="position: relative; opacity: 1;">
                {{-- quantity : {{ var_export($productsQuantity) }} <br> --}}
                {{-- limit : {{ var_export($userlimit) }} <br> --}}
                {{-- userplan : {{ var_export($userplan) }} <br> --}}
                {{-- total : {{ var_export($total) }} <br> --}}
                {{-- days : {{ var_export($productsDays) }} <br> --}}
                {{-- disable : {{ var_export($disabled) }} <br> --}}
                {{-- selectedPro : {{ var_export($selectedProducts) }} <br> --}}
                {{-- dayssofproduct : {{ var_export($days) }} <br> --}}


                {{-- step 1 --}}
                {{-- @if ($step == 1) --}}

                <div style="{{ $step == 1 ? '' : 'display:none' }}">
                    <div class="form-card ">
                        <div class="pizza-builder-step__content">
                            <div class="pizza-builder-size-pizza">
                                <ul class="size-pizza-list">
                                    @foreach ($plans as $plan)
                                        <li class="size-pizza-item">
                                            <label class="size-pizza-item__box">
                                                <input type="radio" wire:model="userplan" value="{{ $plan->id }}">
                                                <span class="size-pizza-item__content">
                                                    <span class="size-pizza-item__circle large">
                                                        <span>{{ $plan->limit }}</span>
                                                    </span>
                                                    <span class="size-pizza-item__title">${{ $plan->price }} <br>
                                                        Per Serving
                                                    </span>
                                                </span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                                @error('userplan')
                                    <div class="alert alert-danger uk-text-center uk-mt-4">
                                        <strong>Alert!</strong> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input type="button" wire:click="stepOne" wire:loading.class="d-none" class="action-button"
                        value="Next Step">
                    <div wire:loading wire:target="stepOne">
                        {{-- <div class="action-button uk-pt-2" style="height: 40px;padding-top: 10px"> --}}
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        {{-- </div> --}}
                    </div>
                </div>
                {{-- step 1 --}}
                {{-- @endif --}}

                {{-- @if ($step == 2) --}}
                {{-- step 2 --}}
                <div style="{{ $step == 2 ? '' : 'display:none' }}">
                    <div class="form-card">
                        <div class="pizza-builder-step__content">
                            <p>You can select upto {{ $userlimit }} toppings for your order.</p>
                            <div class="pizza-builder-toppings">
                                <div class="js-hidden-box toppings-list uk-grid uk-child-width-1-4@s uk-child-width-1-2 uk-grid-stack"
                                    data-uk-grid="">
                                    @foreach ($products as $product)
                                        <div
                                            class="uk-grid-margin {{ $product->is_stock_available ? '' : 'inactivediv' }}">
                                            <div class="toppings-item">
                                                <div
                                                    class="{{ $product->is_stock_available ? 'js-checkbox ' : '' }} toppings-item__box @if (array_key_exists($product->id, $this->productsQuantity)) is-checked @endif">
                                                    <span class="toppings-item__content">
                                                        <span class="toppings-item__media"
                                                            @if ($product->is_stock_available) wire:click="selectProduct({{ $product->id }})" @endif>
                                                            @if ($product->halal == 1)
                                                                <div class="ribbones ribbones-top-right">
                                                                    <span>Vegetarian</span>
                                                                </div>
                                                            @endif
                                                            @if ($product->getFirstMediaUrl('image') == '')
                                                                <img src="{{ asset('frontend/assets/') }}"
                                                                    alt="toppings">
                                                            @else
                                                                <img src="{{ $product->getFirstMediaUrl('image') }}"
                                                                    alt="toppings">
                                                            @endif

                                                            @if ($product->is_stock_available)
                                                                <span class="counter" style="z-index: 99">
                                                                    <button type="button" class="minus"
                                                                        wire:click="minus({{ $product->id }})">-</button>
                                                                    <input type="text"
                                                                        wire:model.defer="productsQuantity.{{ $product->id }}"
                                                                        value="1">
                                                                    <button type="button" class="plus"
                                                                        wire:click="plus({{ $product->id }})">+</button>
                                                                </span>
                                                            @endif
                                                        </span>
                                                        <span class="toppings-item__title">{{ $product->name }}
                                                            <span class="uk-text-danger">
                                                                {{ $product->is_stock_available ? '' : '(Currently Unavailable)' }}
                                                            </span>
                                                        </span>
                                                        <span class="toppings-item__desc">{{ $product->description }}
                                                            roti</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="uk-text-center uk-margin-medium-top">
                                    <button type="button" class="btn-more" wire:loading.attr="disabled"
                                        wire:target="loadMoreProducts" wire:click='loadMoreProducts'>
                                        <div wire:loading wire:target="loadMoreProducts">
                                            Loading..
                                        </div>
                                        <div wire:loading.remove wire:target="loadMoreProducts">
                                            View More Options
                                        </div>
                                    </button>
                                </div> --}}
                                @error('productsQuantity')
                                    <div class="alert alert-danger uk-text-center uk-mt-4">
                                        <strong>Required!</strong> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input wire:loading.class="d-none" type="button" wire:click="$set('step', '1')"
                        class="action-button-previous" value="Previous">
                    <input type="button" {{ $disabled ? 'disabled' : '' }} wire:click="stepTwo"
                        style="{{ $disabled ? 'background: gray' : '' }}" wire:loading.class="d-none"
                        class="action-button " value="Next Step">
                    <div wire:loading wire:target="stepTwo">
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                    </div>
                </div>
                {{-- step 2 --}}
                {{-- @endif --}}

                {{-- @if ($step == 3) --}}
                {{-- step 3 --}}
                <div style="{{ $step == 3 ? '' : 'display:none' }}">
                    <div class="form-card">
                        @if (!is_null($fromday))
                            <h3>
                                <div class="uk-text-danger">
                                    Note Please Select Your Week Date From {{ $fromday }}
                                </div>
                            </h3>
                        @endif

                        <div class="pizza-builder">
                            <div class="uk-grid uk-grid-stack" data-uk-grid="">
                                <div class="uk-width-4-4@m uk-first-column">
                                    <div class="pizza-builder-steps">
                                        <div class="pizza-builder-step">
                                            <div class="pizza-builder-step">
                                                <div class="pizza-builder-step__content">
                                                    <!--<div class="pizza-builder-step__title" id="menu-page-title">-->
                                                    <!--  <h2>Menu for February 15, 2022</h2>-->
                                                    <!--</div>-->
                                                    <div class="row" x-data="{ open: @entangle('showWeeks') }">
                                                        <div class="col-3">
                                                            <label>Week 1 Delivery Date*</label>
                                                            <input class="datepicker"
                                                              id="week1" type="text"
                                                               onchange='Livewire.emit("updatingWeek1", this.value)'>
                                                            {{-- <input min="{{ $week1min }}" class="datepicker"
                                                             wire:model="week1" id="week1" type="text"> --}}
                                                            @error('week1')
                                                                <div class="uk-text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div x-show="open">
                                                            <div class="col-3">
                                                                <label>Week 2 Delivery Date*</label>
                                                                <input min="{{ $week2min }}"
                                                                    max="{{ $week2max }}" wire:model="week2"
                                                                    id="week2" type="date">
                                                                @error('week2')
                                                                    <div class="uk-text-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-3">
                                                                <label>Week 3 Delivery Date*</label>
                                                                <input min="{{ $week3min }}"
                                                                    max="{{ $week3max }}" wire:model="week3"
                                                                    id="week3" type="date">
                                                                @error('week3')
                                                                    <div class="uk-text-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-3">
                                                                <label>Week 4 Delivery Date*</label>
                                                                <input min="{{ $week4min }}"
                                                                    max="{{ $week4max }}" wire:model="week4"
                                                                    id="week4" type="date">
                                                                @error('week4')
                                                                    <div class="uk-text-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input wire:loading.class="d-none" type="button" name="previous"
                        wire:click="$set('step', '2')" class=" action-button-previous" value="Previous">
                    <input type="button" wire:click="stepThree" wire:loading.class="d-none"
                        class="action-button " value="Next Step">
                    <div wire:loading wire:target="stepThree">
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                    </div>
                </div>
                {{-- step 3 --}}
                {{-- @endif --}}

                {{-- @if ($step == 4) --}}
                {{-- step 4 --}}
                <div style="{{ $step == 4 ? '' : 'display:none' }}">
                    <div class="form-card">
                        <div class="section-contacts-form">
                            <div class="uk-section uk-container">
                                <div class="uk-grid uk-grid-stack" data-uk-grid="">
                                    <div class="uk-width-2-3@m uk-first-column">
                                        <div class="section-title">
                                            <h3 class="uk-h3">Delivery Address
                                            </h3>
                                        </div>
                                        <div class="section-content">
                                            <div class="uk-grid uk-grid-medium uk-child-width-1-2@s uk-grid-stack"
                                                data-uk-grid="">
                                                <div class="uk-first-column">
                                                    <label>First Name *
                                                        <input wire:model.lazy="fname" class="uk-input"
                                                            type="text">
                                                        @error('fname')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>
                                                </div>
                                                <div>
                                                    <label>Last Name *
                                                        <input wire:model.lazy="lname" class="uk-input"
                                                            type="text">
                                                        @error('lname')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>
                                                </div>
                                                <div class="uk-grid-margin uk-first-column">
                                                    <label>Address *
                                                        <input wire:model.lazy="address1" class="uk-input"
                                                            type="text">
                                                        @error('address1')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>
                                                </div>
                                                <div class="uk-grid-margin">
                                                    <label>Address Line 2
                                                        <input wire:model.lazy="address2" class="uk-input"
                                                            type="text">
                                                        @error('address2')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="uk-grid uk-grid-medium uk-child-width-1-2@s uk-grid-stack"
                                                data-uk-grid="">
                                                <div class="uk-first-column">
                                                    <label>City *
                                                        <input wire:model.lazy="city" class="uk-input"
                                                            type="text">
                                                        @error('city')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>
                                                </div>
                                                <div>
                                                    <label>State *
                                                        <select wire:model.defer="state" class="uk-select"
                                                            data-test-region-input="true" data-input="region"
                                                            data-input-error="true" autocomplete="address-level1">
                                                            <option value="">Select</option>
                                                            <option value="AL">Alabama</option>
                                                            <option value="AK">Alaska</option>
                                                            <option value="AZ">Arizona</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="CA">California</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="CT">Connecticut</option>
                                                            <option value="DE">Delaware</option>
                                                            <option value="DC">District of Columbia</option>
                                                            <option value="FL">Florida</option>
                                                            <option value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IN">Indiana</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="ME">Maine</option>
                                                            <option value="MD">Maryland</option>
                                                            <option value="MA">Massachusetts</option>
                                                            <option value="MI">Michigan</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="NH">New Hampshire</option>
                                                            <option value="NJ">New Jersey</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="NY">New York</option>
                                                            <option value="NC">North Carolina</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="OH">Ohio</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="PA">Pennsylvania</option>
                                                            <option value="RI">Rhode Island</option>
                                                            <option value="SC">South Carolina</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TN">Tennessee</option>
                                                            <option value="TX">Texas</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="VT">Vermont</option>
                                                            <option value="VA">Virginia</option>
                                                            <option value="WA">Washington</option>
                                                            <option value="WV">West Virginia</option>
                                                            <option value="WI">Wisconsin</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                        @error('state')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>
                                                </div>
                                                <div>
                                                    <label>ZIP code *
                                                        <input wire:model.lazy="zip" class="uk-input"
                                                            type="number">
                                                        @error('zip')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>
                                                </div>

                                                <label>Phone Number *
                                                    <input wire:model.lazy="phone" class="uk-input uk-form-large phone"
                                                        type="text" id="phone">
                                                    @error('phone')
                                                        <div class="uk-text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </label>
                                            </div>
                                            {{-- <div class="uk-grid uk-grid-medium uk-child-width-1-2@s uk-grid-stack"
                                                data-uk-grid="">
                                                <div class="uk-width-1-1 uk-first-column">
                                                    <label>Phone Number *
                                                        <input wire:model.lazy="phone" class="uk-input uk-form-large"
                                                            type="number">
                                                        @error('phone')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>

                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3@m" id="Order-summary-div">
                                        <div id="Order-summary-main">
                                            <div class="section-title" id="Order-summary-title">
                                                <h3 class="uk-h3">Order summary</h3>
                                            </div>
                                            <div class="uk-grid uk-grid-medium uk-child-width-1-2@s uk-grid-stack"
                                                data-uk-grid="">
                                                <div class="uk-width-1-1 uk-first-column">
                                                    <label>Got a discount code?
                                                        <input wire:model.defer='coupen' class="uk-input uk-form-large"
                                                            type="text">
                                                        @error('coupen')
                                                            <div class="uk-text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </label>
                                                </div>
                                                @if (!$discountApplied)
                                                    <div class="uk-grid-margin uk-first-column">
                                                        <input type="button" wire:click="coupenCheck"
                                                            wire:loading.class="d-none" class="uk-button"
                                                            value="Apply Discount">
                                                        <span wire:loading wire:target="coupenCheck">
                                                            <i class="fa fa-spinner fa-spin"
                                                                style="font-size:24px"></i>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="order-summ-text">
                                                {{-- <p>{{ @$selectedPlan->limit }} meals per
                                                    week<span>${{ @$selectedPlan->price * @$selectedPlan->limit }}</span>
                                                </p> --}}
                                                {{-- <p>Standard Shipping<span>$9.99</span></p> --}}
                                                @if ($discountApplied)
                                                    <p> <b style="color: green">Discount is Applied</b></span></p>
                                                    @if (!is_null($taxRate))
                                                        <p>Tax Rate<span>{{ @$taxRate }}%</span></p>
                                                        {{-- <p>Tax Rate Amount<span>${{ @$taxRateAmount }}</span></p> --}}
                                                        <p>Tax Rate
                                                            Amount<span>${{ number_format((float) @$taxRateAmount, 2, '.', '') }}</span>
                                                        </p>
                                                    @endif
                                                    <p>Week
                                                        1<span>${{ number_format((float) @$pricePerWeek, 2, '.', '') }}</span>
                                                    </p>
                                                    <p>Week 2
                                                        (Auto-deducted)<span>${{ number_format((float) @$pricePerWeek, 2, '.', '') }}</span>
                                                    </p>
                                                    <p>Week 3
                                                        (Auto-deducted)<span>${{ number_format((float) @$pricePerWeek, 2, '.', '') }}</span>
                                                    </p>
                                                    <p>Week 4
                                                        (Auto-deducted)<span>${{ number_format((float) @$pricePerWeek, 2, '.', '') }}</span>
                                                    </p>
                                                    {{-- <p>Total Amount Per Month<span>${{ @$totalPrice }}</span></p> --}}
                                                @else
                                                    @if (!is_null($taxRate))
                                                        <p>Tax Rate<span>{{ @$taxRate }}%</span></p>
                                                        <p>Tax Rate
                                                            Amount<span>${{ number_format((float) @$taxRateAmount, 2, '.', '') }}</span>
                                                        </p>
                                                    @endif
                                                    <p>Week
                                                        1<span>${{ number_format((float) @$pricePerWeek, 2, '.', '') }}</span>
                                                    </p>
                                                    <p>Week 2
                                                        (Auto-deducted)<span>${{ number_format((float) @$pricePerWeek, 2, '.', '') }}</span>
                                                    </p>
                                                    <p>Week 3
                                                        (Auto-deducted)<span>${{ number_format((float) @$pricePerWeek, 2, '.', '') }}</span>
                                                    </p>
                                                    <p>Week 4
                                                        (Auto-deducted)<span>${{ number_format((float) @$pricePerWeek, 2, '.', '') }}</span>
                                                    </p>
                                                    {{-- <p>Total Amount Per Month<span>${{ @$totalPrice }}</span></p> --}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input wire:loading.class="d-none" type="button" name="previous"
                        wire:click="$set('step', '3')" class="previous action-button-previous" value="Previous">
                    <input type="button" wire:click="stepFour" wire:loading.class="d-none"
                        class="action-button " value="Next Step">
                    <div wire:loading wire:target="stepFour">
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                    </div>
                </div>
                {{-- step 4 --}}
                {{-- @endif --}}

                {{-- @if ($step == 5) --}}
                {{-- step 5 --}}
                <div style="{{ $step == 5 ? '' : 'display:none' }}">
                    <div class="form-card">
                        @error('paymentError')
                            <div class="alert alert-danger uk-text-center uk-mt-4">
                                <strong> {{ $message }} </strong>
                            </div>
                        @enderror

                        <h2 class="fs-title">Payment Information</h2>

                        <div class="row">
                            <div class="col-9">
                                <label class="pay">Card Holder Name*</label>
                                <input @if ($this->authUserPlan) disabled @endif wire:model.defer="holder_name"
                                    type="text" name="holdername" placeholder="">
                                @error('holder_name')
                                    <div class="uk-text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="pay">Card Number*</label>
                                <input @if ($this->authUserPlan) disabled @endif wire:model.defer="card_number"
                                    type="number">
                                @error('card_number')
                                    <div class="uk-text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-3"> <label class="pay">CVC*</label>
                                <input class="pw" wire:model.defer="cvc" type="number" pattern="[0-9]*"
                                    inputmode="numeric" placeholder="***">
                                @error('cvc')
                                    <div class="uk-text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3"> <label class="pay">Expiry Date*</label> </div>
                            <div class="col-9">
                                <input @if ($this->authUserPlan) disabled @endif wire:model.defer="expiry_date"
                                    type="month">
                                @error('expiry_date')
                                    <div class="uk-text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <input wire:loading.class="d-none" type="button" name="previous"
                        wire:click="$set('step', '4')" class="previous action-button-previous" value="Previous">
                    <input type="button" wire:click="stepFive" wire:loading.class="d-none"
                        class="action-button " value="Confirm">
                    <div wire:loading wire:target="stepFive">
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                    </div>
                </div>
                {{-- step 5 --}}
                {{-- @endif --}}

                {{-- @if ($step == 6) --}}
                {{-- step 6 --}}
                <div style="{{ $step == 6 ? '' : 'display:none' }}">
                    <div class="form-card uk-text-center">
                        <h2 class="fs-title text-center">Success !</h2> <br><br>
                        <div class="row justify-content-center">
                            <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png"
                                    class="fit-image">
                            </div>
                        </div> <br><br>
                        <div class="row justify-content-center">
                            <div class="col-7 text-center">
                                <h5>You Have Successfully Signed Up! Go To
                                    <a href="{{ route('frontend.dashboard') }}">Dashboard</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- step 6 --}}
                {{-- @endif --}}

            </fieldset>
        </form>
    </div>

    <div style="{{ $step == -1 ? '' : 'display:none' }}">
        <div class="form-card uk-text-center">
            <h2 class="fs-title text-center">Notice!</h2> <br><br>
            <div class="row justify-content-center">
                <div class="col-3"> <img src="https://img.icons8.com/color-glass/48/000000/commercial.png"
                        class="fit-image">
                </div>

            </div> <br><br>
            <div class="row justify-content-center">
                <div class="col-7 text-center uk-alert uk-alert-warning">
                    <b>
                        <h5>Plan System in Progress, Expected date is 10-May-2022 </h5>
                    </b>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    $(document).ready(function() {
        // var disabledDates = ["2022-05-17", "2022-05-19", "2022-05-21"]
        $('#phone').mask("999-999-0000")
        // $('#week1').datepicker({
        //     format: 'Y-m-d',
        //     autoclose: true,
        //     todayHighlight: true,
        //     datesDisabled: disabledDates
        // });

        var disabledDates =  <?php echo json_encode($disabled_dates); ?>;
        $('#week1').datepicker({
            minDate: new Date({!! json_encode($week1min) !!}),
            beforeShowDay: function(date) {
                var day = date.getDay();
                var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
                return [(day != 0 && day != 1) && (disabledDates.indexOf(string) == -1)];
            }
        });
    });
</script>
