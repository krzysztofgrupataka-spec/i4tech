@props([
  'ariaLabel',
  'disabled' => false,
  'direction' => 'right',
  'href' => null,
  'size' => 'md',
  'type' => 'button',
  'variant' => 'primary',
])

@php
  $isDisabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
  $classes = $attributes->class([
    'icon-button',
    "icon-button--{$variant}",
    "icon-button--{$size}",
    'is-disabled' => $isDisabled,
  ]);
@endphp

@if ($href)
  <a
    {{ $classes }}
    href="{{ $isDisabled ? '#' : esc_url($href) }}"
    aria-label="{{ esc_attr($ariaLabel) }}"
    @if ($isDisabled) aria-disabled="true" tabindex="-1" @endif
  >
    <x-arrow-icon :direction="$direction" />
  </a>
@else
  <button
    {{ $classes }}
    type="{{ esc_attr($type) }}"
    aria-label="{{ esc_attr($ariaLabel) }}"
    @disabled($isDisabled)
  >
    <x-arrow-icon :direction="$direction" />
  </button>
@endif
