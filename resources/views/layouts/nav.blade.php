<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('frontend/assets/img/Khana-fresh-Logo.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Khana Fresh</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->

    <ul class="metismenu" id="menu">
        {{-- dashboard --}}
        <li>
            <a class="" href="{{ route('dashboard') }}" aria-expanded="true">
                <div class="parent-icon">
                    <i class="lni lni-dashboard"></i>
                </div>
                <div class="menu-title">
                    Dashboard
                </div>
            </a>
        </li>

        {{-- blogs --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-blogger"></i>
                </div>
                <div class="menu-title">
                    Blogs
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('blogs.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('blogs.index') }}">
                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('blog-categories.index') }}">
                        <div class="parent-icon">
                            <i class="lni lni-agenda"></i>
                        </div>
                        <div class="menu-title">
                            Categories
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Coupen --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-discover"></i>
                </div>
                <div class="menu-title">
                    Coupen
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('copens.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('copens.index') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- flavours --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-fresh-juice"></i>
                </div>
                <div class="menu-title">
                    Flavour
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('flavours.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('flavours.index') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Ingrediants --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-grow"></i>
                </div>
                <div class="menu-title">
                    Ingredients
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('ingredients.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('ingredients.index') }}">
                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- nutrition --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-juice"></i>
                </div>
                <div class="menu-title">
                    Nutrition
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('nutritions.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('nutritions.index') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- product --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-producthunt"></i>
                </div>
                <div class="menu-title">
                    Product
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('products.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('products.index') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List
                        </div>
                    </a>
                </li>

                {{-- category --}}
                {{-- <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                            <i class="lni lni-agenda"></i>
                        </div>
                        <div class="menu-title">
                            Category
                        </div>
                    </a>
                    <ul class="mm-collapse">
                        <li>
                            <a class="" href="{{ route('categories.create') }}">
                                <div class="parent-icon">
                                    <i class="lni lni-plus"></i>
                                </div>
                                <div class="menu-title">
                                    Add
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="" href="{{ route('categories.index') }}">

                                <div class="parent-icon">
                                    <i class="lni lni-list"></i>
                                </div>
                                <div class="menu-title">
                                    List </div>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </li>

        {{-- plans --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-notepad"></i>
                </div>
                <div class="menu-title">
                    Plan
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('plans.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('plans.index') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- terms --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-ban"></i>
                </div>
                <div class="menu-title">
                    Terms & Conditions
                </div>
            </a>
            <ul class="mm-collapse">
                {{-- <li>
                    <a class="" href="{{ route('terms.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li> --}}
                <li>
                    <a class="" href="{{ route('terms.index') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- users --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-users"></i>
                </div>
                <div class="menu-title">
                    Users
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('users.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('users.index') }}">
                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- userpaln --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-wheelbarrow"></i>
                </div>
                <div class="menu-title">
                    User Plan
                </div>
            </a>
            <ul class="mm-collapse">
                {{-- <li>
                    <a class="" href="{{ route('userplans.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li> --}}
                <li>
                    <a class="" href="{{ route('userplans.index') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- globaloption --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-world"></i>
                </div>
                <div class="menu-title">
                    Global Options
                </div>
            </a>
            <ul class="mm-collapse">
                {{-- <li>
                    <a class="" href="{{ route('userplans.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li> --}}
                <li>
                    <a class="" href="{{ route('option') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- zips --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-zip"></i>
                </div>
                <div class="menu-title">
                    Zips
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('zips.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-plus"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('zips.index') }}">

                        <div class="parent-icon">
                            <i class="lni lni-list"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-ship"></i>
                </div>
                <div class="menu-title">
                    Deliveries And Packaging
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('delivery') }}">
                        <div class="parent-icon">
                            <i class="lni lni-service"></i>
                        </div>
                        <div class="menu-title">
                            Todays Deliveries
                        </div>
                    </a>
                </li>

            </ul>
        </li>





        {{-- <li>
            <a class="" href="/menus" aria-expanded="true">
                <div class="parent-icon">
                    <i class="lni lni-anchor"></i>
                </div>
                <div class="menu-title">
                    Menus
                </div>
            </a>
        </li> --}}
        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-bubble"></i>
                </div>
                <div class="menu-title">
                    Coaches
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="/coaches/create">
                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="/coaches">
                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            List
                        </div>
                    </a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-add-files"></i>
                </div>
                <div class="menu-title">
                    Pages
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="{{ route('pages.create') }}">
                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('pages.index') }}">


                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-bubble"></i>
                </div>
                <div class="menu-title">
                    Testimonials
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="/testimonials/create">
                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="/testimonials">
                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            List
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="/blog-categories">
                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            Categories
                        </div>
                    </a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-bubble"></i>
                </div>
                <div class="menu-title">
                    Faqs
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="/faqs/create">
                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="/faqs">

                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-package"></i>
                </div>
                <div class="menu-title">
                    Packages
                </div>
            </a>
            <ul class="mm-collapse">
                <li>
                    <a class="" href="/packages/create">
                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            Add
                        </div>
                    </a>
                </li>
                <li>
                    <a class="" href="/packages">

                        <div class="parent-icon">
                            <i class="lni lni-bubble"></i>
                        </div>
                        <div class="menu-title">
                            List </div>
                    </a>
                </li>
            </ul>
        </li> --}}
        {{-- <li>
            <a href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-bubble"></i>
                </div>
                <div class="menu-title">
                    Form Entries
                </div>
            </a>
        </li> --}}
        {{-- <li>
            <a href="javascript:;">
                <div class="parent-icon">
                    <i class="lni lni-bubble"></i>
                </div>
                <div class="menu-title">
                    Theme Setting
                </div>
            </a>
        </li> --}}

    </ul>
    <!--end navigation-->
</div>
