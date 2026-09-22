@php
  $blockAttributes = ['class' => 'contact-form-section-block alignfull'];
  if (! empty($attributes['anchor'])) $blockAttributes['id'] = sanitize_title($attributes['anchor']);
  if (! empty($attributes['className'])) $blockAttributes['class'] .= ' ' . sanitize_html_class($attributes['className']);
  $wrapperAttributes = get_block_wrapper_attributes($blockAttributes);
  $headingHtml = preg_replace('/<\/p>\s*<p[^>]*>/i', '<br>', $heading);
  $headingHtml = preg_replace('/^<p[^>]*>|<\/p>$/i', '', (string) $headingHtml);
  $headingHtml = wp_kses($headingHtml, ['br' => [], 'em' => [], 'span' => ['style' => true, 'class' => true], 'strong' => []]);
@endphp

<section {!! $wrapperAttributes !!}>
  <div class="contact-form-section-block__inner">
    <div class="contact-form-section-block__intro">
      <div class="contact-form-section-block__intro-inner">
        @if ($heading)<h2 class="contact-form-section-block__heading">{!! $headingHtml !!}</h2>@endif
        @if ($text)<div class="contact-form-section-block__text">{!! wp_kses_post(wpautop($text)) !!}</div>@endif
      </div>
    </div>

    <div class="contact-form-section-block__form-panel">
      <div class="contact-form-section-block__form">
        @if ($formId && shortcode_exists('contact-form-7'))
          {!! do_shortcode(sprintf('[contact-form-7 id="%d"]', $formId)) !!}
        @elseif ($isPreview)
          <p class="contact-form-section-block__placeholder">{{ __('Wybierz formularz Contact Form 7.', 'i4tech') }}</p>
        @endif
      </div>
    </div>
  </div>
</section>
