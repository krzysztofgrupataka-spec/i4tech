@props([
  'disabled' => false,
  'href' => null,
  'icon' => false,
  'iconPosition' => 'end',
  'size' => 'md',
  'variant' => 'primary',
  'type' => 'button',
])

@php
  $hasIcon = filter_var($icon, FILTER_VALIDATE_BOOLEAN);
  $hasIconAsset = $hasIcon && $variant === 'primary';
  $isDisabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
  $classes = $attributes->class([
    'button',
    "button--{$variant}",
    "button--{$size}",
    'button--with-icon' => $hasIcon,
    'button--with-icon-asset' => $hasIconAsset,
    "button--icon-{$iconPosition}" => $hasIcon,
    'is-disabled' => $isDisabled,
  ]);
@endphp

@if ($href)
  <a
    {{ $classes }}
    href="{{ $isDisabled ? '#' : esc_url($href) }}"
    @if ($isDisabled) aria-disabled="true" tabindex="-1" @endif
  >
    @if ($hasIcon && $iconPosition === 'start')
      @if ($hasIconAsset)
        <x-menu-arrow-icon class="button__icon-asset" />
      @else
        <x-arrow-icon />
      @endif
    @endif
    <span class="button__label">{{ $slot }}</span>
    @if ($hasIcon && $iconPosition !== 'start')
      @if ($hasIconAsset)
        <x-menu-arrow-icon class="button__icon-asset" />
      @else
        <x-arrow-icon />
      @endif
    @endif
  </a>
@else
  <button {{ $classes }} type="{{ esc_attr($type) }}" @disabled($isDisabled)>
    @if ($hasIcon && $iconPosition === 'start')
      @if ($hasIconAsset)
        <x-menu-arrow-icon class="button__icon-asset" />
      @else
        <x-arrow-icon />
      @endif
    @endif
    <span class="button__label">{{ $slot }}</span>
    @if ($hasIcon && $iconPosition !== 'start')
      @if ($hasIconAsset)
        <x-menu-arrow-icon class="button__icon-asset" />
      @else
        <x-arrow-icon />
      @endif
    @endif
  </button>
@endif
