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
      <h2 class="opinions-elements-block__heading">{!! $headingHtml !!}</h2>
    @endif

    @if ($items)
      <div class="opinions-elements-block__slider" data-opinions-slider>
        <div class="opinions-elements-block__viewport" data-opinions-viewport>
          <div class="opinions-elements-block__track">
            @foreach ($items as $item)
              <article class="opinions-elements-block__item">
            <img
              class="opinions-elements-block__quote"
              src="{{ get_theme_file_uri('public/images/quote-yellow.svg') }}"
              alt=""
              width="35"
              height="32"
              aria-hidden="true"
            >

            <div class="opinions-elements-block__content">
              @if ($item['text'])
                <div class="opinions-elements-block__text">{!! wp_kses_post($item['text']) !!}</div>
              @endif

              @if ($item['name'] || $item['position'])
                <footer class="opinions-elements-block__author">
                  @if ($item['name'])
                    <strong>{{ $item['name'] }}</strong>
                  @endif
                  @if ($item['position'])
                    <span>{{ $item['position'] }}</span>
                  @endif
                </footer>
              @endif
            </div>
              </article>
            @endforeach
          </div>
        </div>

        <div class="opinions-elements-block__pagination" data-opinions-pagination aria-label="{{ __('Paginacja opinii', 'i4tech') }}"></div>
      </div>
    @endif
  </x-container>
</section>
