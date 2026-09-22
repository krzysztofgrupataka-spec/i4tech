@props([
  'container' => 'default',
  'tone' => 'default',
])

<section {{ $attributes->class(['section', "section--{$tone}"]) }}>
  <x-container :size="$container">
    {{ $slot }}
  </x-container>
</section>
