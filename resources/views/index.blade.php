@extends('layouts.app')

@section('content')
  <x-section>
      @if (have_posts())
        <div class="post-list">
          @while (have_posts()) @php(the_post())
            <article @php(post_class('post-card'))>
              <h2 class="post-card__title">
                <a href="{{ esc_url(get_permalink()) }}">{{ get_the_title() }}</a>
              </h2>
              <div class="post-card__excerpt">
                @php(the_excerpt())
              </div>
            </article>
          @endwhile
        </div>

        {!! get_the_posts_navigation() !!}
      @else
        <p>{{ __('No posts found.', 'i4tech') }}</p>
      @endif
  </x-section>
@endsection
