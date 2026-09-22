@php
  $blockAttributes = [
    'class' => "hero-section-block hero-section-block--{$variant} alignfull",
  ];

  if ($imageUrl) {
    $blockAttributes['style'] = "--hero-section-image: url('" . esc_url($imageUrl) . "')";
  }

  $wrapperAttributes = get_block_wrapper_attributes($blockAttributes);
@endphp

<section {!! $wrapperAttributes !!}>
  <x-container class="hero-section-block__container" size="wide">
    <div class="hero-section-block__content">
      @if ($heading)
        <h1 class="hero-section-block__heading">{!! wp_kses_post($heading) !!}</h1>
      @endif

      @if ($text)
        <p class="hero-section-block__text">{!! wp_kses_post($text) !!}</p>
      @endif

      @if ($buttonLabel && $buttonUrl)
        <x-button class="hero-section-block__button" href="{{ esc_url($buttonUrl) }}" icon="true">
          {{ $buttonLabel }}
        </x-button>
      @endif
    </div>
  </x-container>
</section>

<x-breadcrumbs :items="$breadcrumbs" :schema="$breadcrumbSchema" />
