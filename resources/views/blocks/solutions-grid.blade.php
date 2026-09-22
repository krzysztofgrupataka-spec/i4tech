<section {!! get_block_wrapper_attributes(['class' => 'solutions-grid-block alignfull']) !!}>
  <x-container>
    @if ($heading || $headingHighlight)
      <h2 class="solutions-grid-block__heading">
        @if ($heading)
          <span>{{ $heading }}</span>
        @endif
        @if ($headingHighlight)
          <span>{{ $headingHighlight }}</span>
        @endif
      </h2>
    @endif

    @if (! empty($solutionIds))
      <div class="solutions-grid-block__grid">
        @foreach ($solutionIds as $index => $solutionId)
          @php
            $mediaType = function_exists('get_field') ? (string) get_field('solution_tile_media_type', $solutionId) : 'image';
            $imageId = function_exists('get_field') ? absint(get_field('solution_tile_image', $solutionId) ?: 0) : 0;
            $videoId = function_exists('get_field') ? absint(get_field('solution_tile_video', $solutionId) ?: 0) : 0;
            $mediaUrl = $mediaType === 'video' && $videoId
              ? wp_get_attachment_url($videoId)
              : ($imageId ? wp_get_attachment_image_url($imageId, 'content-wide') : '');
          @endphp
          <x-solution-tile
            :title="get_the_title($solutionId)"
            :href="get_permalink($solutionId)"
            :featured="$index % 2 === 0"
            :media-url="$mediaUrl"
            :media-type="$mediaType"
          />
        @endforeach
      </div>
    @endif
  </x-container>
</section>
