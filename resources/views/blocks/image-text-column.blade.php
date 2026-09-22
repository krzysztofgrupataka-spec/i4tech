@php
  $blockAttributes = [
    'class' => sprintf(
      'image-text-column-block image-text-column-block--%s image-text-column-block--padding-top-%s image-text-column-block--padding-bottom-%s alignfull',
      $layout,
      $paddingTop,
      $paddingBottom,
    ),
  ];
  $wrapperAttributes = get_block_wrapper_attributes($blockAttributes);

  $isLegacyHeading = ! str_contains($heading, '<');
  $highlightPosition = $isLegacyHeading && $headingHighlight !== ''
    ? mb_strpos($heading, $headingHighlight)
    : false;

  if ($isLegacyHeading) {
    $headingBefore = $highlightPosition !== false ? mb_substr($heading, 0, $highlightPosition) : $heading;
    $headingAfter = $highlightPosition !== false
      ? mb_substr($heading, $highlightPosition + mb_strlen($headingHighlight))
      : '';
    $headingHtml = nl2br(esc_html($headingBefore));
  } else {
    $headingHtml = preg_replace('/<\/p>\s*<p[^>]*>/i', '<br>', trim($heading));
    $headingHtml = preg_replace('/^<p[^>]*>|<\/p>$/i', '', $headingHtml);
    $headingHtml = wp_kses($headingHtml, [
      'br' => [],
      'em' => [],
      'span' => ['class' => true],
      'strong' => [],
    ]);
  }

  if ($isLegacyHeading && $highlightPosition !== false) {
    $headingHtml .= sprintf(
      '<span class="text-highlight">%s</span>%s',
      nl2br(esc_html($headingHighlight)),
      nl2br(esc_html($headingAfter)),
    );
  }
@endphp

<section {!! $wrapperAttributes !!}>
  <x-container size="default">
    <div class="image-text-column-block__grid">
      <div class="image-text-column-block__content">
        @if ($heading)
          <h2 class="image-text-column-block__heading">
            {!! $headingHtml !!}
          </h2>
        @endif

        @if ($text)
          <div class="image-text-column-block__text">
            {!! wp_kses_post($text) !!}
          </div>
        @endif

        @if ($buttonLabel && $buttonUrl)
          <x-button
            class="image-text-column-block__button"
            href="{{ esc_url($buttonUrl) }}"
            icon="true"
            size="lg"
            target="{{ $buttonTarget === '_blank' ? '_blank' : null }}"
            rel="{{ $buttonTarget === '_blank' ? 'noopener noreferrer' : null }}"
          >
            {{ $buttonLabel }}
          </x-button>
        @endif
      </div>

      @if ($imageId)
        <div class="image-text-column-block__media">
          <x-picture
            class="image-text-column-block__image"
            :id="$imageId"
            size="full"
            sizes="(min-width: 64rem) 37.5rem, calc(100vw - 2rem)"
          />
        </div>
      @endif
    </div>
  </x-container>
</section>
