@php
  $wrapper = ['class' => 'case-study-hero-block alignfull'];
  if (! empty($attributes['anchor'])) $wrapper['id'] = sanitize_title($attributes['anchor']);
  if (! empty($attributes['className'])) $wrapper['class'] .= ' ' . sanitize_html_class($attributes['className']);
  $details = array_filter([
    __('Sektor', 'i4tech') => $sector,
    __('Typ projektu:', 'i4tech') => $projectType,
    __('Inwestor:', 'i4tech') => $investor,
  ]);
@endphp

<section {!! get_block_wrapper_attributes($wrapper) !!}>
  <x-container>
    <div class="case-study-hero-block__grid">
      <div class="case-study-hero-block__content">
        @if ($heading)
          <h1 class="case-study-hero-block__heading">{!! nl2br(e($heading)) !!}</h1>
        @endif

        @if ($details)
          <dl class="case-study-hero-block__details">
            @foreach ($details as $label => $value)
              <div>
                <dt>{{ $label }}</dt>
                <dd>{{ $value }}</dd>
              </div>
            @endforeach
          </dl>
        @endif

        @if ($solutions)
          <div class="case-study-hero-block__solutions">
            <h2>{{ __('Zastosowane rozwiązania i technologie:', 'i4tech') }}</h2>
            <div class="case-study-hero-block__solution-list">
              @foreach ($solutions as $solution)
                @php
                  $solutionId = $solution instanceof WP_Post ? $solution->ID : absint($solution);
                @endphp
                @if ($solutionId)
                  <a href="{{ esc_url(get_permalink($solutionId)) }}">
                    {{ get_the_title($solutionId) }}
                    <x-arrow-icon />
                  </a>
                @endif
              @endforeach
            </div>
          </div>
        @endif
      </div>

      @if ($imageId)
        <div class="case-study-hero-block__media">
          <x-picture :id="$imageId" size="content-wide" />
        </div>
      @endif
    </div>
  </x-container>
</section>
