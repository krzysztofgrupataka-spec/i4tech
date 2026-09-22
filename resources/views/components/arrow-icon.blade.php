@props([
  'direction' => 'right',
])

<span {{ $attributes->class(['arrow-icon', "arrow-icon--{$direction}"]) }} aria-hidden="true"></span>
