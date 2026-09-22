@php
  $headingHtml = preg_replace('/<\/p>\s*<p[^>]*>/i', '<br>', trim($heading));
  $headingHtml = preg_replace('/^<p[^>]*>|<\/p>$/i', '', $headingHtml);
  $headingHtml = wp_kses($headingHtml, [
    'br' => [],
    'em' => [],
    'span' => ['class' => true, 'style' => true],
    'strong' => [],
  ]);
@endphp

<section id="{{ $blockId }}" class="{{ implode(' ', $blockClasses) }}">
  <div class="linked-technologies-block__inner container container--default">
    @if ($heading)
      <h2 class="linked-technologies-block__heading">{!! $headingHtml !!}</h2>
    @endif

    @if ($technologyIds && $variant === 'horizontal')
      <nav class="linked-technologies-block__links" aria-label="{{ __('Powiązane technologie', 'i4tech') }}">
        @foreach ($technologyIds as $technologyId)
          <a class="linked-technologies-block__link" href="{{ get_permalink($technologyId) }}">
            {{ get_the_title($technologyId) }}
          </a>
        @endforeach
      </nav>
    @elseif ($technologyIds)
      <x-technology-accordion :technology-ids="$technologyIds" />
    @endif
  </div>
</section>
