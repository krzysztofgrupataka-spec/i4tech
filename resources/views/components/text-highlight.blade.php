@props([
  'tone' => 'yellow',
])

<span {{ $attributes->class(['text-highlight', "text-highlight--{$tone}"]) }}>{{ $slot }}</span>
