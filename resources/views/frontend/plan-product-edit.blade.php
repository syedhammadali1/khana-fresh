@extends('frontend.layouts.app')

@section('meta')
    <title>Edit Plan</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@section('content')
    <div class="page-content uk-text-center">
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
                                    @livewire('component.frontend.menu.user.product-edit',
                                    [
                                    'plan'=>$plan,
                                    'productsQuantity'=>$productsQuantity
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
