
@extends('frontend.layouts.app')

@section('meta')
    <title>Single Blog</title>
    <meta content="Chernyh Mihail" name="author">
    <meta content="Spedito - All in one place" name="description">
@endsection


@section('content')
<main class="page-main">

    <div class="page-content">

      <div class="uk-margin-large-top uk-container uk-container-small">
        <div class="section-title section-title--center wave">
            <h1 class="uk-text-center">{{ $blog->title }}</h1>
        </div>

        <article class="article-full">
          <div class="article-full__info">


            
            <div class="article-full__date"><svg class="svg-inline--fa fa-calendar-alt fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg><!-- <i class="fas fa-calendar-alt"></i> Font Awesome fontawesome.com --><span>{{ date("F jS, Y", strtotime($blog->created_at)) }}</span></div>

          </div>
          <div class="article-full__image"><a href="/page-blog-article.html"><img src="{{ $blog->getFirstMediaUrl('image') }}" alt="img-article"></a></div>
          <div class="article-full__content">
            {!! $blog->description !!}



          </div>
        </article>
      </div>
    </div>
</main>



@endsection
