@extends('layouts.app')

@section('content')
  <header class="blog-index__hero">
    <x-container size="inset">
      <h1>{{ __('Case studies', 'i4tech') }}</h1>
      <p>{{ __('Zobacz, jak rozwiązujemy rzeczywiste wyzwania technologiczne i środowiskowe w zakładach przemysłowych.', 'i4tech') }}</p>
    </x-container>
  </header>

  <section class="blog-index__content">
    <x-container size="inset">
      @if (have_posts())
        <div class="blog-index__grid">
          <?php $position = 0; ?>

          @while (have_posts())
            @php(the_post())
            <x-blog-card
              :post="get_post()"
              :featured="$position === 0"
              :cta="__('Zobacz case study', 'i4tech')"
            />
            <?php $position++; ?>
          @endwhile
        </div>

        @if (get_next_posts_link())
          <div class="blog-index__pagination">
            {!! get_next_posts_link(__('Zobacz więcej case studies', 'i4tech')) !!}
          </div>
        @endif
      @else
        <p>{{ __('Nie znaleziono case studies.', 'i4tech') }}</p>
      @endif
    </x-container>
  </section>
@endsection
