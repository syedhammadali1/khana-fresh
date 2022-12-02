
@extends('frontend.layouts.app')

@section('meta')
    <title>Single Blog</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection

@section('content')
<main class="page-main">

    <div class="page-content">
      <div class="uk-margin-large-top uk-container">
          <p><strong>Terms &amp; Conditions Updated: </strong></p>
<p><strong>August 3 2021 </strong></p>
        @foreach ($terms as $item)
        {!! $item->condition !!}

        @endforeach
      </div>
    </div>
  </main>

  @endsection
