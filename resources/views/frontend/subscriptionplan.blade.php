@extends('frontend.layouts.app')

@section('meta')
    <title>Dashboard</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

{{-- <div class="page-content uk-text-center">
    <div class="uk-margin-large-top uk-container">
        <div class="pizza-builder">
            <div class="uk-grid uk-grid-stack" data-uk-grid="">
                <div class="uk-width-4-4@m uk-first-column">
                    <div class="pizza-builder-steps">
                        <div class="pizza-builder-step">
                            <div class="pizza-builder-step">
                                <div class="pizza-builder-step__title" id="menu-page-title">
                                    <h2>
                                        <p></p>
                                    </h2>
                                </div>
                                <div class="pizza-builder-step__content">
                                    <!--<div class="pizza-builder-step__title" id="menu-page-title">-->
                                    <!--  <h2>Menu for February 15, 2022</h2>-->
                                    <!--</div>-->
                                    <div class="pizza-builder-sause" id="gird-menu-item">
                                        <div class="jas sause-list uk-grid uk-child-width-1-4@s uk-child-width-1-2"
                                            data-uk-grid="">
                                            <a
                                                href="{{ route('frontend.plan.product.edit', [
                                                    'user' => auth()->user()->email,
                                                    'plan' => $userplan->plan->name,
                                                ]) }}">
                                                View</a>
                                            @foreach ($meals as $key => $item)
                                                @livewire('component.frontend.menu.user.single.product',[
                                                'model'=> $item
                                                ])
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <div id="weekhead" class="d-flex justify-content-center">
                                            <h1>
                                                Weeks

                                            </h1>
                                        </div>
                                        <div class="section-content">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Week 1</td>
                                                        <td>Week 2</td>
                                                        <td>Week 3</td>
                                                        <td>Week 4</td>
                                                    </tr>
                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            @livewire('component.frontend.menu.user.single.product-week',[
                                                            'userplan'=> $userplan,
                                                            'week'=> $userplan->week1,
                                                            'for' => 'week 1'
                                                            ])
                                                        </td>
                                                        <td>
                                                            @livewire('component.frontend.menu.user.single.product-week',[
                                                            'userplan'=> $userplan,
                                                            'week'=> $userplan->week2,
                                                            'for' => 'week 2'
                                                            ])
                                                        </td>
                                                        <td>
                                                            @livewire('component.frontend.menu.user.single.product-week',[
                                                            'userplan'=> $userplan,
                                                            'week'=> $userplan->week3,
                                                            'for' => 'week 3'
                                                            ])
                                                        </td>
                                                        <td>
                                                            @livewire('component.frontend.menu.user.single.product-week',[
                                                            'userplan'=> $userplan,
                                                            'week'=> $userplan->week4,
                                                            'for' => 'week 4'
                                                            ])
                                                        </td>
                                                    </tr>
                                            </table>

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
</div> --}}
@section('content')
    <div class="uk-text-center" style="margin-top: 10px">
        <h1>Your Menu And Delivery Details</h1>
    </div>
    <div class="uk-width-4-4@m uk-first-column">
        <div class="uk-grid uk-child-width-1-4@s uk-child-width-1-2 uk-text-center" data-uk-grid="">
            @livewire('component.frontend.menu.user.single.product-week',[
            'userplan'=> $userplan,
            'week'=> $userplan->week1,
            'for' => 'week 1'
            ])
            @livewire('component.frontend.menu.user.single.product-week',[
            'userplan'=> $userplan,
            'week'=> $userplan->week2,
            'for' => 'week 2'
            ])
            @livewire('component.frontend.menu.user.single.product-week',[
            'userplan'=> $userplan,
            'week'=> $userplan->week3,
            'for' => 'week 3'
            ])
            @livewire('component.frontend.menu.user.single.product-week',[
            'userplan'=> $userplan,
            'week'=> $userplan->week4,
            'for' => 'week 4'
            ])

        </div>

        <div class="pizza-builder-steps">
            <div class="pizza-builder-step">
                <div class="pizza-builder-step">
                    <div class="pizza-builder-step__title" id="menu-page-title">
                    </div>
                    <div class="pizza-builder-step__content">
                        <!--<div class="pizza-builder-step__title" id="menu-page-title">-->
                        <!--  <h2>Menu for February 15, 2022</h2>-->
                        <!--</div>-->
                        <div class="pizza-builder-sause">
                            <div class="jus-hidden-box sause-list uk-grid uk-child-width-1-4@s uk-child-width-1-2"
                                data-uk-grid="">
                                @foreach ($meals as $key => $item)
                                    @livewire('component.frontend.menu.user.single.product',[
                                    'model'=> $item
                                    ])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
