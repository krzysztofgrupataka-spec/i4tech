@extends('layouts.app')

@section('content')
  @php
    $blogOptions = function_exists('\\App\\footer_options') ? \App\footer_options() : [];
  @endphp

  <header class="blog-index__hero">
    <x-container size="inset">
      <h1>{{ $blogOptions['blog_heading'] ?? __('Baza wiedzy', 'i4tech') }}</h1>
      @if (! empty($blogOptions['blog_description']))
        <p>{{ $blogOptions['blog_description'] }}</p>
      @endif
    </x-container>
  </header>

  <section class="blog-index__content">
    <x-container size="inset">
      @if (have_posts())
        <div class="blog-index__grid">
          @php
            $position = 0;
          @endphp
          @while (have_posts())
            @php
              the_post();
            @endphp
            <x-blog-card :post="get_post()" :featured="$position === 0" />
            @php
              $position++;
            @endphp
          @endwhile
        </div>

        @if (get_next_posts_link())
          <div class="blog-index__pagination">{!! get_next_posts_link(__('Zobacz więcej wpisów', 'i4tech')) !!}</div>
        @endif
      @else
        <p>{{ __('Nie znaleziono wpisów.', 'i4tech') }}</p>
      @endif
    </x-container>
  </section>
@endsection
