<section id="{{ $blockId }}" class="{{ implode(' ', $blockClasses) }}">
  <x-container>
    <div class="standard-and-procedures-block__layout">
      <div class="standard-and-procedures-block__content">
        @if ($heading)
          <h2 class="standard-and-procedures-block__heading">{{ $heading }}</h2>
        @endif

        @if ($highlightedText)
          <div class="standard-and-procedures-block__highlighted">{!! wp_kses_post($highlightedText) !!}</div>
        @endif

        @if ($text)
          <div class="standard-and-procedures-block__text">{!! wp_kses_post($text) !!}</div>
        @endif
      </div>

      @if ($files)
        <div class="standard-and-procedures-block__files">
          @foreach ($files as $file)
            <a class="standard-and-procedures-block__file" href="{{ esc_url($file['url']) }}" download>
              <span>{{ $file['label'] }}</span>
              <img
                class="standard-and-procedures-block__download"
                src="{{ get_theme_file_uri('public/images/download.svg') }}"
                alt=""
                width="26"
                height="18"
                aria-hidden="true"
              >
            </a>
          @endforeach
        </div>
      @endif
    </div>
  </x-container>
</section>
