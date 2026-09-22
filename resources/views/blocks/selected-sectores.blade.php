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
  <div class="selected-sectores-block__inner container container--default">
    @if ($heading)
      <h2 class="selected-sectores-block__heading">{!! $headingHtml !!}</h2>
    @endif

    @if ($industryIds)
      <nav class="selected-sectores-block__items" aria-label="{{ esc_attr__('Wybrane branże', 'i4tech') }}">
        @foreach ($industryIds as $industryId)
          <a class="selected-sectores-block__link" href="{{ get_permalink($industryId) }}">
            {{ get_the_title($industryId) }}
          </a>
        @endforeach
      </nav>
    @endif
  </div>
</section>
