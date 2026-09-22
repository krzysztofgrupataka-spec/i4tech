@extends('layouts.app')

@section('content')
  @while (have_posts())
    @php
      the_post();
    @endphp
    @php
      $intro = function_exists('get_field') ? get_field('blog_post_intro') : '';
      $authorName = function_exists('get_field') ? trim((string) get_field('blog_post_author_name')) : '';
      $authorRole = function_exists('get_field') ? trim((string) get_field('blog_post_author_role')) : '';
      $relatedHeading = function_exists('get_field') ? get_field('blog_post_related_heading') : '';
      $relatedPosts = function_exists('get_field') ? (array) get_field('blog_post_related_posts') : [];
      $authorName = $authorName ?: get_the_author();
    @endphp
    <article @php(post_class('blog-article'))>
      <header class="blog-article__hero">
        <x-container size="inset">
          <h1>{{ get_the_title() }}</h1>
          <div class="blog-article__meta">
            <span class="blog-article__author-inline">
              {{ $authorName }}
              @if ($authorRole)
                , {{ $authorRole }}
              @endif
            </span>
            <time datetime="{{ esc_attr(get_the_date('c')) }}">{{ get_the_date('j F Y') }}</time>
          </div>
        </x-container>
      </header>

      <x-container size="narrow">
        @if ($intro)
          <div class="blog-article__intro">{!! wp_kses_post($intro) !!}</div>
        @endif
        <div class="blog-article__content entry__content">
          @php(the_content())
        </div>

        @if ($authorName)
          <aside class="blog-article__author-card">
            <strong>{{ __('Autor:', 'i4tech') }} {{ $authorName }}</strong>
            @if ($authorRole)
              <span>{{ $authorRole }}</span>
            @endif
          </aside>
        @endif
      </x-container>

      @if ($relatedPosts)
        <section class="blog-article__related">
          <x-container size="inset">
            @if ($relatedHeading)
              <div class="blog-article__related-heading">{!! wp_kses_post($relatedHeading) !!}</div>
            @endif
            <div class="blog-article__related-grid">
              @foreach (array_slice($relatedPosts, 0, 3) as $relatedPost)
                <x-blog-card :post="$relatedPost" />
              @endforeach
            </div>
          </x-container>
        </section>
      @endif
    </article>
  @endwhile
@endsection
