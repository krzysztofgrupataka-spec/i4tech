<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="{{ get_bloginfo('charset') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(wp_head())
  </head>

  <body @php(body_class())>
    @php(wp_body_open())

    <?php
      $currentPostId = get_queried_object_id();
      $pageBlocks = $currentPostId ? parse_blocks((string) get_post_field('post_content', $currentPostId)) : [];
      $firstContentBlock = collect($pageBlocks)->first(fn ($pageBlock) => ! empty($pageBlock['blockName']));
      $firstBlockName = $firstContentBlock['blockName'] ?? null;
      $hasOverlayHero = in_array($firstBlockName, ['acf/image-hero', 'acf/hero-section'], true);
      $navigationSetting = $currentPostId && function_exists('get_field')
        ? (string) get_field('page_navigation_variant', $currentPostId)
        : 'auto';
      $headerVariant = $hasOverlayHero ? 'transparent' : 'solid';

      if ($navigationSetting === 'solid') {
        $headerVariant = 'solid';
      } elseif ($hasOverlayHero && $navigationSetting === 'dark') {
        $headerVariant = 'transparent-dark';
      } elseif ($hasOverlayHero && $navigationSetting === 'light') {
        $headerVariant = 'transparent';
      }
    ?>
    @php($hasContactPage = $currentPostId && has_block('acf/contact-page', $currentPostId))

    <a class="skip-link" href="#main">{{ __('Skip to content', 'i4tech') }}</a>

    <x-header :variant="$headerVariant" />

    <main id="main" class="site-main" tabindex="-1">
      @yield('content')
    </main>

    <x-footer :variant="$hasContactPage ? 'compact' : 'default'" />

    @php(wp_footer())
  </body>
</html>
