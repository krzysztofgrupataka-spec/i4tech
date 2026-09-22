@php
  $variant = $variant ?? 'default';
  $isCompact = $variant === 'compact';
  $options = $footerOptions ?? [];
  $backgroundId = absint($options['background_image_id'] ?? 0);
  $backgroundUrl = $backgroundId ? wp_get_attachment_image_url($backgroundId, 'full') : '';
  $footerLinks = $footerNavigationItems ?? [];
  $industryLinks = $footerIndustryNavigationItems ?? [];
  $socialLinks = array_filter([
    'in' => $options['linkedin_url'] ?? '',
    'fb' => $options['facebook_url'] ?? '',
    'yt' => $options['youtube_url'] ?? '',
  ]);
@endphp

<footer
  class="site-footer site-footer--{{ sanitize_html_class($variant) }}"
  @if ($backgroundUrl) style="--footer-background-image: url('{{ esc_url($backgroundUrl) }}')" @endif
>
  <div class="site-footer__surface">
    <x-container>
      <div class="site-footer__grid">
        @unless ($isCompact)
        <div class="site-footer__cta">
          <h2 class="site-footer__heading">
            <span>{{ $options['heading'] ?? __('Z jakim wyzwaniem', 'i4tech') }}</span>
            <span>{{ $options['heading_highlight'] ?? __('mierzy się Twój zakład?', 'i4tech') }}</span>
          </h2>

          @if (! empty($options['description']))
            <p class="site-footer__description">{{ $options['description'] }}</p>
          @endif

          @if (! empty($options['cta_label']) && ! empty($options['cta_url']))
            <div class="site-footer__actions">
              <x-button class="site-footer__button" href="{{ esc_url($options['cta_url']) }}" icon="true">
                {{ $options['cta_label'] }}
              </x-button>
            </div>
          @endif
        </div>
        @endunless

        <div class="site-footer__details">
          @if (! $isCompact && ! empty($options['address']))
            <address class="site-footer__address">{!! nl2br(e($options['address'])) !!}</address>
          @endif

          @if (! empty($footerLinks))
            <nav class="site-footer__nav" aria-label="{{ esc_attr__('Footer navigation', 'i4tech') }}">
              <ul class="site-footer__list">
                @foreach ($footerLinks as $item)
                  <li>
                    <a href="{{ esc_url($item['url']) }}" @if ($item['target']) target="{{ esc_attr($item['target']) }}" rel="noopener" @endif>
                      {{ $item['title'] }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </nav>
          @endif

          @if (! empty($socialLinks))
            <div class="site-footer__social">
              <p>{{ $options['social_label'] ?? __('Social media', 'i4tech') }}</p>
              <ul class="site-footer__social-list">
                @foreach ($socialLinks as $label => $url)
                  <li>
                    <a href="{{ esc_url($url) }}" target="_blank" rel="noopener" aria-label="{{ esc_attr(strtoupper($label)) }}">
                      @if ($label === 'in')
                        <img src="{{ get_theme_file_uri('public/images/linkedin.svg') }}" alt="" width="18" height="18" aria-hidden="true">
                      @else
                        {{ $label }}
                      @endif
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>

        @if (! empty($industryLinks))
          <nav class="site-footer__industries" aria-label="{{ esc_attr__('Industry navigation', 'i4tech') }}">
            <p class="site-footer__column-title">{{ __('Branże', 'i4tech') }}</p>
            <ul class="site-footer__list">
              @foreach ($industryLinks as $item)
                <li>
                  <a href="{{ esc_url($item['url']) }}" @if ($item['target']) target="{{ esc_attr($item['target']) }}" rel="noopener" @endif>
                    {{ $item['title'] }}
                  </a>
                </li>
              @endforeach
            </ul>
          </nav>
        @endif
      </div>
    </x-container>
  </div>
</footer>
