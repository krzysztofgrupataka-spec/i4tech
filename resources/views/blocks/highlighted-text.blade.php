<section id="{{ $blockId }}" class="{{ implode(' ', $blockClasses) }}">
  <div class="highlighted-text-block__panel">
    <div class="highlighted-text-block__inner">
      <span class="highlighted-text-block__line" aria-hidden="true"></span>
      <div class="highlighted-text-block__text">
        {!! wp_kses_post($content) !!}
      </div>
    </div>
  </div>
</section>
