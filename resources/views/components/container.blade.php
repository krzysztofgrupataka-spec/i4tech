@props([
  'size' => 'default',
])

<div {{ $attributes->class(['container', "container--{$size}"]) }}>
  {{ $slot }}
</div>
