@php
  $wrapper = ['class' => 'case-study-efects-block alignfull'];
  if (! empty($attributes['anchor'])) $wrapper['id'] = sanitize_title($attributes['anchor']);
  if (! empty($attributes['className'])) $wrapper['class'] .= ' ' . sanitize_html_class($attributes['className']);
@endphp

<section {!! get_block_wrapper_attributes($wrapper) !!}>
  <x-container>
    <div class="case-study-efects-block__inner">
      @if ($heading)
        <div class="case-study-efects-block__heading">{!! wp_kses_post($heading) !!}</div>
      @endif

      @if ($text)
        <div class="case-study-efects-block__text">{!! wp_kses_post($text) !!}</div>
      @endif
    </div>
  </x-container>
</section>
