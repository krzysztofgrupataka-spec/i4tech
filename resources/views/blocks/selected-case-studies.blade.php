@php
  if (str_contains($heading, '<')) {
    $headingHtml = preg_replace('/<\/p>\s*<p[^>]*>/i', '<br>', trim($heading));
    $headingHtml = preg_replace('/^<p[^>]*>|<\/p>$/i', '', $headingHtml);
    $headingHtml = wp_kses($headingHtml, [
      'br' => [],
      'em' => [],
      'span' => ['class' => true],
      'strong' => [],
    ]);
  } else {
    $headingLines = preg_split('/\R/u', $heading, 2) ?: [];
    $headingHtml = esc_html(trim($headingLines[0] ?? ''));
    $legacyHighlight = trim($headingLines[1] ?? '');

    if ($legacyHighlight !== '') {
      $headingHtml .= '<br><span class="text-highlight">' . esc_html($legacyHighlight) . '</span>';
    }
  }
@endphp

<section {!! get_block_wrapper_attributes(['class' => "selected-case-studies-block selected-case-studies-block--{$background} alignfull"]) !!}>
  <x-container size="inset">
    <div class="selected-case-studies-block__header">
      @if ($heading)
        <h2 class="selected-case-studies-block__heading">
          {!! $headingHtml !!}
        </h2>
      @endif

      @if ($archiveUrl)
        <x-button
          class="selected-case-studies-block__archive-button"
          href="{{ esc_url($archiveUrl) }}"
          icon="true"
          size="lg"
        >
          {{ __('Przejrzyj wszystkie case studies', 'i4tech') }}
        </x-button>
      @endif
    </div>

    @if (! empty($caseStudyIds))
      @php
        $caseStudyCount = count($caseStudyIds);
      @endphp
      <div class="selected-case-studies-block__grid selected-case-studies-block__grid--count-{{ $caseStudyCount }}">
        @foreach ($caseStudyIds as $index => $caseStudyId)
          @php
            $usesFeaturedLayout = $caseStudyCount === 1 || (($caseStudyCount === 2 || $caseStudyCount === 3) && $index === 0);
            $imageUrl = $usesFeaturedLayout ? (get_the_post_thumbnail_url($caseStudyId, 'full') ?: '') : '';
          @endphp

          <x-case-study-card
            class="selected-case-studies-block__card"
            :title="get_the_title($caseStudyId)"
            :href="get_permalink($caseStudyId)"
            :image="$imageUrl ?: null"
            :variant="$usesFeaturedLayout ? 'featured' : 'compact'"
          />
        @endforeach
      </div>
    @endif
  </x-container>
</section>
