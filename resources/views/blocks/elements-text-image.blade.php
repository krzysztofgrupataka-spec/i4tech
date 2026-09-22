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
    <div class="elements-text-image-block__grid">
      @if ($heading)
        <h2 class="elements-text-image-block__heading">{!! $headingHtml !!}</h2>
      @endif

      @foreach ($items as $item)
        @if ($item['type'] === 'image')
          <div class="elements-text-image-block__item elements-text-image-block__item--image">
            <x-picture
              class="elements-text-image-block__image"
              :id="$item['imageId']"
              size="large"
              sizes="(min-width: 75rem) 22.5rem, (min-width: 40rem) 50vw, 100vw"
            />
          </div>
        @else
          <article class="elements-text-image-block__item elements-text-image-block__item--text elements-text-image-block__item--{{ $item['background'] }}">
            @if ($item['title'])
              <h3 class="elements-text-image-block__item-title">{{ $item['title'] }}</h3>
            @endif

            @if ($item['text'])
              <div class="elements-text-image-block__item-text">
                {!! wp_kses_post($item['text']) !!}
              </div>
            @endif
          </article>
        @endif
      @endforeach
    </div>
  </x-container>
</section>
