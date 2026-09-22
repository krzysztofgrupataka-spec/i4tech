@php
  $headingHtml = preg_replace('/<\/p>\s*<p[^>]*>/i', '<br>', trim($heading));
  $headingHtml = preg_replace('/^<p[^>]*>|<\/p>$/i', '', $headingHtml);
  $headingHtml = wp_kses($headingHtml, [
    'br' => [],
    'em' => [],
    'span' => ['class' => true],
    'strong' => [],
  ]);
@endphp

<section id="{{ $blockId }}" class="{{ implode(' ', $blockClasses) }}">
  <x-container>
    @if ($heading)
      <h2 class="selected-solutions-block__heading">{!! $headingHtml !!}</h2>
    @endif

    @if ($solutionIds || $imageId)
      <div class="selected-solutions-block__grid">
        @foreach ($solutionIds as $solutionId)
          <a class="selected-solutions-block__tile" href="{{ esc_url(get_permalink($solutionId)) }}">
            <h3 class="selected-solutions-block__title">{{ get_the_title($solutionId) }}</h3>
            <span class="selected-solutions-block__cta">
              <span>{{ __('Dowiedz się więcej', 'i4tech') }}</span>
              <span class="selected-solutions-block__icon" aria-hidden="true">
                <x-menu-arrow-icon />
              </span>
            </span>
          </a>
        @endforeach

        @if ($imageId)
          <div
            class="selected-solutions-block__media"
            style="--selected-solutions-image-span: {{ $imageSpan }}"
          >
            <x-picture
              class="selected-solutions-block__image"
              :id="$imageId"
              size="content-wide"
              sizes="(min-width: 64rem) 43.125rem, calc(100vw - 2rem)"
            />
          </div>
        @endif
      </div>
    @endif
  </x-container>
</section>
