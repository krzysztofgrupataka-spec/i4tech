@props([
  'id',
  'size' => 'large',
  'sizes' => '(min-width: 80rem) 72rem, 100vw',
  'loading' => 'lazy',
])

@php
  $imageId = absint($id);
  $alt = get_post_meta($imageId, '_wp_attachment_image_alt', true) ?: '';
@endphp

@if ($imageId)
  {!! wp_get_attachment_image($imageId, $size, false, [
    'class' => $attributes->get('class'),
    'loading' => $loading,
    'decoding' => 'async',
    'sizes' => $sizes,
    'alt' => $alt,
  ]) !!}
@endif
