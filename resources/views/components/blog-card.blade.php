@props([
  'post',
  'featured' => false,
  'cta' => __('Czytaj artykuł', 'i4tech'),
])

@php
  $postId = $post instanceof WP_Post ? $post->ID : absint($post);
  $url = get_permalink($postId);
  $title = get_the_title($postId);
  $imageId = get_post_thumbnail_id($postId);
@endphp

<article @class(['blog-card', 'blog-card--featured' => $featured])>
  <a class="blog-card__link" href="{{ esc_url($url) }}">
    @if ($featured)
      <div class="blog-card__body">
        <h2 class="blog-card__title">{{ $title }}</h2>
        <span class="blog-card__cta">{{ $cta }} <x-menu-arrow-icon /></span>
      </div>
      <div class="blog-card__media">
        @if ($imageId)
          <x-picture :id="$imageId" size="large" />
        @endif
      </div>
    @else
      <div class="blog-card__media">
        @if ($imageId)
          <x-picture :id="$imageId" size="card" />
        @endif
      </div>
      <div class="blog-card__body">
        <h2 class="blog-card__title">{{ $title }}</h2>
        <span class="blog-card__cta">{{ $cta }} <x-menu-arrow-icon /></span>
      </div>
    @endif
  </a>
</article>
