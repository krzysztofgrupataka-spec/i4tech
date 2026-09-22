@php
  $blockAttributes = ['class' => 'materials-form-section-block alignfull'];
  if (! empty($attributes['anchor'])) $blockAttributes['id'] = sanitize_title($attributes['anchor']);
  if (! empty($attributes['className'])) $blockAttributes['class'] .= ' ' . sanitize_html_class($attributes['className']);
  $wrapperAttributes = get_block_wrapper_attributes($blockAttributes);
  $headingHtml = nl2br(esc_html($heading));
@endphp

<section {!! $wrapperAttributes !!}>
  <div class="materials-form-section-block__inner container container--default">
    @if ($heading)
      <h2 class="materials-form-section-block__heading">{!! $headingHtml !!}</h2>
    @endif

    @if ($text)
      <div class="materials-form-section-block__text">{!! wp_kses_post($text) !!}</div>
    @endif

    @if ($formId && shortcode_exists('contact-form-7'))
      <div class="materials-form-section-block__form">
        {!! do_shortcode(sprintf('[contact-form-7 id="%d"]', $formId)) !!}
      </div>
    @elseif ($isPreview)
      <p class="materials-form-section-block__placeholder">{{ __('Wybierz formularz Contact Form 7.', 'i4tech') }}</p>
    @endif
  </div>
</section>
