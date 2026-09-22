@php
  $blockAttributes = [
    'class' => "image-hero-block image-hero-block--{$alignment} alignfull",
  ];

  if ($imageUrl) {
    $blockAttributes['style'] = "--image-hero-background: url('" . esc_url($imageUrl) . "')";
  }
@endphp

<section {!! get_block_wrapper_attributes($blockAttributes) !!}>
  <x-container>
    <div class="image-hero-block__content">
      @if ($heading)
        <h1 class="image-hero-block__heading">{!! wp_kses_post($heading) !!}</h1>
      @endif

      @if ($text)
        <div class="image-hero-block__text">
          {!! wp_kses_post($text) !!}
        </div>
      @endif

      @if (($primary['label'] && $primary['url']) || ($secondary['label'] && $secondary['url']))
        <div class="image-hero-block__actions">
          @if ($primary['label'] && $primary['url'])
            <x-button
              class="image-hero-block__button image-hero-block__button--primary"
              href="{{ esc_url($primary['url']) }}"
              icon="true"
              size="lg"
              target="{{ $primary['target'] === '_blank' ? '_blank' : null }}"
              rel="{{ $primary['target'] === '_blank' ? 'noopener noreferrer' : null }}"
            >
              {{ $primary['label'] }}
            </x-button>
          @endif

          @if ($secondary['label'] && $secondary['url'])
            <x-button
              class="image-hero-block__button image-hero-block__button--ghost"
              href="{{ esc_url($secondary['url']) }}"
              icon="true"
              size="lg"
              variant="ghost"
              target="{{ $secondary['target'] === '_blank' ? '_blank' : null }}"
              rel="{{ $secondary['target'] === '_blank' ? 'noopener noreferrer' : null }}"
            >
              {{ $secondary['label'] }}
            </x-button>
          @endif
        </div>
      @endif
    </div>
  </x-container>
</section>

<x-breadcrumbs :items="$breadcrumbs" :schema="$breadcrumbSchema" />
