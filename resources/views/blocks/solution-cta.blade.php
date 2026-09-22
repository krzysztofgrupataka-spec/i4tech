<section id="{{ $blockId }}" class="{{ implode(' ', $blockClasses) }}">
  <div class="solution-cta-block__inner container container--default">
    @if ($heading)
      <h2 class="solution-cta-block__heading">{!! nl2br(esc_html($heading)) !!}</h2>
    @endif

    @if ($buttonLabel && $buttonUrl)
      <x-button
        class="solution-cta-block__button"
        href="{{ esc_url($buttonUrl) }}"
        icon="true"
        size="lg"
        variant="primary"
        target="{{ $buttonTarget === '_blank' ? '_blank' : null }}"
        rel="{{ $buttonTarget === '_blank' ? 'noopener noreferrer' : null }}"
      >
        {{ $buttonLabel }}
      </x-button>
    @endif
  </div>
</section>
