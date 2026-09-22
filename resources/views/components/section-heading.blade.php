@props([
  'align' => 'start',
  'as' => 'h2',
  'eyebrow' => null,
  'lead' => null,
  'size' => 'xl',
])

@php
  $tag = in_array($as, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? $as : 'h2';
@endphp

<div {{ $attributes->class(['section-heading', "section-heading--{$align}", "section-heading--{$size}"]) }}>
  @if ($eyebrow)
    <p class="section-heading__eyebrow">{{ $eyebrow }}</p>
  @endif

  <{{ $tag }} class="section-heading__title">{{ $slot }}</{{ $tag }}>

  @if ($lead)
    <p class="section-heading__lead">{{ $lead }}</p>
  @endif
</div>
