@php
  $wrapper = ['class' => 'blog-table-block'];
  if (! empty($attributes['anchor'])) $wrapper['id'] = sanitize_title($attributes['anchor']);
  if (! empty($attributes['className'])) $wrapper['class'] .= ' ' . sanitize_html_class($attributes['className']);
  $columnCount = count($headings);
  $firstColumnWidth = $columnCount === 2 ? 60 : ($columnCount === 3 ? 50 : 40);
@endphp

<figure {!! get_block_wrapper_attributes($wrapper) !!}>
  <div class="blog-table-block__scroll">
    <table style="--blog-table-first-column: {{ $firstColumnWidth }}%; --blog-table-columns: {{ $columnCount }}">
      <colgroup>
        <col class="blog-table-block__first-column">
        @for ($column = 1; $column < $columnCount; $column++)
          <col>
        @endfor
      </colgroup>
      <thead>
        <tr>
          @foreach ($headings as $heading)
            <th scope="col">{{ $heading }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($rows as $row)
          <tr>
            @foreach ($row as $cell)
              <td>{!! nl2br(e($cell)) !!}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @if ($caption)
    <figcaption>{{ $caption }}</figcaption>
  @endif
</figure>
