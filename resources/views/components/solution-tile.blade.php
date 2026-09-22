@props([
  'cta' => __('Dowiedz się więcej', 'i4tech'),
  'featured' => false,
  'href' => null,
  'mediaType' => 'image',
  'mediaUrl' => null,
  'title',
])

@php
  $classes = $attributes->class([
    'solution-tile',
    'solution-tile--featured' => filter_var($featured, FILTER_VALIDATE_BOOLEAN),
  ]);
@endphp

<article {{ $classes }}>
  <a class="solution-tile__link" href="{{ esc_url($href) }}">
    @if ($mediaUrl)
      <span class="solution-tile__media" aria-hidden="true">
        @if ($mediaType === 'video')
          <video autoplay loop muted playsinline preload="metadata">
            <source src="{{ esc_url($mediaUrl) }}">
          </video>
        @else
          <img src="{{ esc_url($mediaUrl) }}" alt="" loading="lazy">
        @endif
      </span>
    @endif

    <h3 class="solution-tile__title">{{ $title }}</h3>
    <span class="solution-tile__cta">
      <span>{{ $cta }}</span>
      <span class="icon-button icon-button--primary icon-button--md solution-tile__icon" aria-hidden="true">
        <x-menu-arrow-icon />
      </span>
    </span>
  </a>
</article>
