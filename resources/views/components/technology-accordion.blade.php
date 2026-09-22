@props([
  'technologyIds' => [],
  'columns' => 1,
  'openFirst' => false,
])

@php
  $technologyIds = array_values(array_filter(array_map('absint', $technologyIds)));
  $columnCount = max(1, min(2, (int) $columns));
  $columnSize = max(1, (int) ceil(count($technologyIds) / $columnCount));
  $technologyColumns = array_chunk($technologyIds, $columnSize);
@endphp

<div {{ $attributes->class(['technology-accordion', "technology-accordion--columns-{$columnCount}"]) }}>
  @foreach ($technologyColumns as $columnIds)
    <div class="technology-accordion__column">
      @foreach ($columnIds as $technologyId)
        @php
          $globalIndex = array_search($technologyId, $technologyIds, true);
          $children = get_posts([
            'post_type' => 'technology',
            'post_parent' => $technologyId,
            'posts_per_page' => -1,
            'orderby' => ['menu_order' => 'ASC', 'title' => 'ASC'],
            'order' => 'ASC',
            'post_status' => 'publish',
          ]);
        @endphp

        <details class="technology-accordion__item" @if ($openFirst && $globalIndex === 0) open @endif>
          <summary class="technology-accordion__summary">
            <span class="technology-accordion__title">{{ get_the_title($technologyId) }}</span>
            <span class="technology-accordion__toggle" aria-hidden="true">
              <span class="technology-accordion__chevron"></span>
            </span>
          </summary>
          <div class="technology-accordion__panel">
            <div class="technology-accordion__panel-inner">
              <a class="technology-accordion__link technology-accordion__link--parent" href="{{ get_permalink($technologyId) }}">
                <span>{{ get_the_title($technologyId) }}</span>
                <x-menu-arrow-icon class="technology-accordion__link-arrow" />
              </a>
              @foreach ($children as $child)
                <a class="technology-accordion__link" href="{{ get_permalink($child) }}">
                  {{ get_the_title($child) }}
                </a>
              @endforeach
            </div>
          </div>
        </details>
      @endforeach
    </div>
  @endforeach
</div>
