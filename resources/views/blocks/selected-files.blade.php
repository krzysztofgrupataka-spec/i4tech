<section id="{{ $blockId }}" class="{{ implode(' ', $blockClasses) }}">
  <x-container>
    @if ($heading)
      <h2 class="selected-files-block__heading">{{ $heading }}</h2>
    @endif

    @if ($files)
      <div class="selected-files-block__items">
        @foreach ($files as $file)
          <a
            class="selected-files-block__link"
            href="{{ esc_url($file['url']) }}"
            @if ($file['action'] === 'download')
              download
            @else
              target="_blank"
              rel="noopener noreferrer"
            @endif
          >
            <span>{{ $file['label'] }}</span>
            <img
              class="selected-files-block__icon selected-files-block__icon--{{ $file['action'] }}"
              src="{{ get_theme_file_uri($file['action'] === 'download' ? 'public/images/arrow-down.svg' : 'public/images/open-in-new.svg') }}"
              alt=""
              width="{{ $file['action'] === 'download' ? 26 : 18 }}"
              height="18"
              aria-hidden="true"
            >
          </a>
        @endforeach
      </div>
    @endif
  </x-container>
</section>
