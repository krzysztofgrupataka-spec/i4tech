@props([
  'cta' => __('Zobacz i poczytaj', 'i4tech'),
  'href' => null,
  'image' => null,
  'label' => __('case study', 'i4tech'),
  'title',
  'variant' => 'compact',
])

@php
  $classes = $attributes->class(['case-study-card', "case-study-card--{$variant}"]);
@endphp

<article {{ $classes }}>
  @if ($image)
    <div class="case-study-card__media">
      <img src="{{ esc_url($image) }}" alt="" loading="lazy">
    </div>
  @endif

  <div class="case-study-card__body">
    @if ($label)
      <span class="case-study-card__label">{{ $label }}</span>
    @endif

    <h3 class="case-study-card__title">{{ $title }}</h3>

    @if ($href)
      <a class="case-study-card__link" href="{{ esc_url($href) }}">
        <span>{{ $cta }}</span>
        <span class="case-study-card__link-icon" aria-hidden="true">
          <x-menu-arrow-icon />
        </span>
      </a>
    @endif
  </div>
</article>
