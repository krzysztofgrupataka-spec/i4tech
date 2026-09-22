@php
  $headingHtml = preg_replace('/<\/p>\s*<p[^>]*>/i', '<br>', trim($heading));
  $headingHtml = preg_replace('/^<p[^>]*>|<\/p>$/i', '', $headingHtml);
  $headingHtml = wp_kses($headingHtml, [
    'br' => [],
    'em' => [],
    'span' => ['class' => true],
    'strong' => [],
  ]);
  $titlesOnly = !array_filter($items, static fn ($item) => $item['text'] !== '');
@endphp

<section id="{{ $blockId }}" class="{{ implode(' ', $blockClasses) }}">
  <x-container size="inset">
    @if ($heading)
      <h2 class="text-tiles-elements-block__heading">{!! $headingHtml !!}</h2>
    @endif

    @if ($items)
      <div @class([
        'text-tiles-elements-block__grid',
        'text-tiles-elements-block__grid--count-' . count($items),
        'text-tiles-elements-block__grid--titles-only' => $titlesOnly,
      ])>
        @foreach ($items as $item)
          <article class="text-tiles-elements-block__tile">
            @if ($item['title'])
              <h3 class="text-tiles-elements-block__tile-title">{{ $item['title'] }}</h3>
            @endif

            @if ($item['text'])
              <div class="text-tiles-elements-block__tile-text">
                {!! wp_kses_post($item['text']) !!}
              </div>
            @endif
          </article>
        @endforeach
      </div>
    @endif
  </x-container>
</section>
