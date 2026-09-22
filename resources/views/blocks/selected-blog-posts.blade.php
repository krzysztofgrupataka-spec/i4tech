@php
  $headingHtml = preg_replace('/<\/p>\s*<p[^>]*>/i', '<br>', trim($heading));
  $headingHtml = preg_replace('/^<p[^>]*>|<\/p>$/i', '', $headingHtml);
  $headingHtml = wp_kses($headingHtml, [
    'br' => [],
    'em' => [],
    'span' => ['class' => true],
    'strong' => [],
  ]);
@endphp

<section id="{{ $blockId }}" class="{{ implode(' ', $blockClasses) }}">
  <div class="selected-blog-posts-block__inner container container--default">
    <div class="selected-blog-posts-block__header">
      @if ($heading)
        <h2 class="selected-blog-posts-block__heading">{!! $headingHtml !!}</h2>
      @endif

      @if ($archiveUrl)
        <x-button
          class="selected-blog-posts-block__archive-button"
          href="{{ esc_url($archiveUrl) }}"
          icon="true"
          size="lg"
          variant="primary"
        >
          {{ __('Przejdź do bloga', 'i4tech') }}
        </x-button>
      @endif
    </div>

    @if ($postIds)
      <div class="selected-blog-posts-block__grid">
        @foreach ($postIds as $postId)
          <article class="selected-blog-posts-block__card">
            <a class="selected-blog-posts-block__card-link" href="{{ get_permalink($postId) }}">
              @if (has_post_thumbnail($postId))
                <span class="selected-blog-posts-block__media">
                  {!! get_the_post_thumbnail($postId, 'card', [
                    'class' => 'selected-blog-posts-block__image',
                    'loading' => 'lazy',
                    'decoding' => 'async',
                  ]) !!}
                </span>
              @endif

              <span class="selected-blog-posts-block__body">
                <h3 class="selected-blog-posts-block__title">{{ get_the_title($postId) }}</h3>
                <span class="selected-blog-posts-block__read-more">
                  {{ __('Czytaj artykuł', 'i4tech') }}
                  <x-menu-arrow-icon />
                </span>
              </span>
            </a>
          </article>
        @endforeach
      </div>
    @endif
  </div>
</section>
