@props([
  'items' => [],
  'schema' => [],
])

@if ($items)
  <nav class="breadcrumbs" aria-label="{{ esc_attr__('Okruszki nawigacyjne', 'i4tech') }}">
    <x-container>
      <ol class="breadcrumbs__list">
        @foreach ($items as $item)
          <li class="breadcrumbs__item">
            @if (! $item['current'])
              <a href="{{ esc_url($item['url']) }}">{{ $item['title'] }}</a>
              <span class="breadcrumbs__separator" aria-hidden="true">›</span>
            @else
              <span aria-current="page">{{ $item['title'] }}</span>
            @endif
          </li>
        @endforeach
      </ol>
    </x-container>
  </nav>

  @if ($schema)
    <script type="application/ld+json">{!! wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
  @endif
@endif
