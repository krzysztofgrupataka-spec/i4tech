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
    <div class="text-columns-block__grid">
      @if ($heading)
        <h2 class="text-columns-block__heading">{!! $headingHtml !!}</h2>
      @endif

      @if ($text)
        <div class="text-columns-block__text">
          {!! wp_kses_post($text) !!}
        </div>
      @endif
    </div>

    @if ($items)
      <div class="text-columns-block__items">
        @foreach ($items as $item)
          <article class="text-columns-block__item">
            @if ($item['title'])
              <h3 class="text-columns-block__item-title">{{ $item['title'] }}</h3>
            @endif

            @if ($item['text'])
              <div class="text-columns-block__item-text">
                {!! wp_kses_post($item['text']) !!}
              </div>
            @endif
          </article>
        @endforeach
      </div>
    @endif
  </x-container>
</section>
