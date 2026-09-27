@php
  $attributes = ['class' => 'contact-page-block alignfull'];
  if (! empty($block_attributes['anchor'])) $attributes['id'] = sanitize_title($block_attributes['anchor']);
  if (! empty($block_attributes['className'])) $attributes['class'] .= ' ' . sanitize_html_class($block_attributes['className']);
  $icon = fn (string $name, int $width, int $height) => sprintf('<img src="%s" alt="" width="%d" height="%d" aria-hidden="true">', esc_url(get_theme_file_uri("public/images/{$name}.svg")), $width, $height);
@endphp

<section {!! get_block_wrapper_attributes($attributes) !!}>
  <div class="contact-page-block__information">
    <div class="contact-page-block__information-inner">
      @if ($data['heading'])<h1 class="contact-page-block__heading">{{ $data['heading'] }}</h1>@endif
      @if ($data['intro'])<p class="contact-page-block__intro">{{ $data['intro'] }}</p>@endif

      <div class="contact-page-block__details">
        <div class="contact-page-block__contact-column">
          @if ($data['email'])
            <div class="contact-page-block__detail">{!! $icon('mail', 16, 11) !!}<a href="mailto:{!! esc_attr(antispambot($data['email'])) !!}">{!! esc_html(antispambot($data['email'])) !!}</a></div>
          @endif
          @if ($data['address'])
            <div class="contact-page-block__detail">{!! $icon('home', 16, 18) !!}<div><address>{!! nl2br(e($data['address'])) !!}</address>@if ($data['directionsUrl'])<a class="contact-page-block__directions" href="{{ esc_url($data['directionsUrl']) }}" target="_blank" rel="noopener">{{ __('wyznacz trasę', 'i4tech') }}</a>@endif</div></div>
          @endif
        </div>

        <div class="contact-page-block__contact-column">
          <h2>{{ $data['officeLabel'] }}</h2>
          @foreach ($data['officePhones'] as $index => $phone)
            <div class="contact-page-block__detail contact-page-block__detail--line">{!! $index === 0 ? $icon('phone', 16, 17) : '<span></span>' !!}<a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}">{{ $phone }}</a></div>
          @endforeach
          @if ($data['officeEmail'])<div class="contact-page-block__detail contact-page-block__detail--line">{!! $icon('mail', 16, 11) !!}<a href="mailto:{!! esc_attr(antispambot($data['officeEmail'])) !!}">{!! esc_html(antispambot($data['officeEmail'])) !!}</a></div>@endif
        </div>

        <div class="contact-page-block__contact-column">
          <h2>{{ $data['salesLabel'] }}</h2>
          @if ($data['salesPhone'])<div class="contact-page-block__detail contact-page-block__detail--line">{!! $icon('phone', 16, 17) !!}<a href="tel:{{ preg_replace('/[^+\d]/', '', $data['salesPhone']) }}">{{ $data['salesPhone'] }}</a></div>@endif
          @if ($data['salesEmail'])<div class="contact-page-block__detail contact-page-block__detail--line">{!! $icon('mail', 16, 11) !!}<a href="mailto:{!! esc_attr(antispambot($data['salesEmail'])) !!}">{!! esc_html(antispambot($data['salesEmail'])) !!}</a></div>@endif
          @if ($data['serviceEmail'])
            <h2>{{ $data['serviceLabel'] }}</h2>
            <div class="contact-page-block__detail contact-page-block__detail--line">{!! $icon('mail', 16, 11) !!}<a href="mailto:{!! esc_attr(antispambot($data['serviceEmail'])) !!}">{!! esc_html(antispambot($data['serviceEmail'])) !!}</a></div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page-block__form-panel contact-form-section-block contact-form-section-block__form-panel">
    <div class="contact-page-block__form contact-form-section-block__form">
      @if ($data['formId'] && shortcode_exists('contact-form-7'))
        {!! do_shortcode(sprintf('[contact-form-7 id="%d"]', $data['formId'])) !!}
      @elseif ($is_preview)
        <p>{{ __('Wybierz formularz Contact Form 7.', 'i4tech') }}</p>
      @endif
    </div>
  </div>
</section>
