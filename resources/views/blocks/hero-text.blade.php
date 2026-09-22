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
    <div class="hero-text-block__grid">
      @if ($heading)
        <h1 class="hero-text-block__heading">{!! $headingHtml !!}</h1>
      @endif

      @if ($text || ($ctaLabel && $ctaUrl))
        <div class="hero-text-block__content">
          @if ($text)
            <div class="hero-text-block__text">
              {!! wp_kses_post($text) !!}
            </div>
          @endif

          @if ($ctaLabel && $ctaUrl)
            <x-button
              class="hero-text-block__cta"
              href="{{ esc_url($ctaUrl) }}"
              icon="true"
              size="lg"
              variant="primary"
              target="{{ $ctaTarget === '_blank' ? '_blank' : null }}"
              rel="{{ $ctaTarget === '_blank' ? 'noopener noreferrer' : null }}"
            >
              {{ $ctaLabel }}
            </x-button>
          @endif
        </div>
      @endif
    </div>
  </x-container>
</section>
