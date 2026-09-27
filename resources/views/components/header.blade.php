@props([
  'variant' => 'solid',
])

@php
  $customLogoId = get_theme_mod('custom_logo');
  $customLogo = $customLogoId
    ? wp_get_attachment_image($customLogoId, 'full', false, [
        'class' => 'site-header__logo-image',
        'loading' => false,
      ])
    : '';

  $menuItems = $primaryNavigationItems ?? [];

  if (! $menuItems) {
    $solutionArchive = get_post_type_archive_link('solution') ?: '#';
    $technologyArchive = get_post_type_archive_link('technology') ?: '#';
    $caseStudyArchive = get_post_type_archive_link('case_study') ?: '#';

    $menuItems = [
      [
        'id' => 1,
        'parent' => 0,
        'title' => __('Rozwiązania', 'i4tech'),
        'url' => $solutionArchive,
        'target' => '',
        'description' => __('Specjalizujemy się w tych obszarach', 'i4tech'),
        'classes' => [],
        'children' => [
          ['id' => 11, 'parent' => 1, 'title' => __('Oczyszczanie spalin', 'i4tech'), 'url' => $solutionArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
          ['id' => 12, 'parent' => 1, 'title' => __('Oczyszczanie powietrza', 'i4tech'), 'url' => $solutionArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
          ['id' => 13, 'parent' => 1, 'title' => __('Oczyszczanie ścieków przemysłowych', 'i4tech'), 'url' => $solutionArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
          ['id' => 14, 'parent' => 1, 'title' => __('Magazynowanie i dozowanie chemii', 'i4tech'), 'url' => $solutionArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
          ['id' => 15, 'parent' => 1, 'title' => __('Linie technologiczne', 'i4tech'), 'url' => $solutionArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
          ['id' => 16, 'parent' => 1, 'title' => __('Koncepcje i projektowanie', 'i4tech'), 'url' => $solutionArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
          ['id' => 17, 'parent' => 1, 'title' => __('Automatyzacja procesów', 'i4tech'), 'url' => $solutionArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
          ['id' => 18, 'parent' => 1, 'title' => __('Badanie pilotażowe i laboratoryjne', 'i4tech'), 'url' => $solutionArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
        ],
      ],
      [
        'id' => 2,
        'parent' => 0,
        'title' => __('Technologie', 'i4tech'),
        'url' => $technologyArchive,
        'target' => '',
        'description' => __('Projektujemy i budujemy instalacje od A do Z', 'i4tech'),
        'classes' => [],
        'children' => [
          [
            'id' => 21,
            'parent' => 2,
            'title' => __('Ochrona powietrza', 'i4tech'),
            'url' => $technologyArchive,
            'target' => '',
            'description' => '',
            'classes' => [],
            'children' => [
              ['id' => 211, 'parent' => 21, 'title' => __('Odsiarczanie spalin', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
              ['id' => 212, 'parent' => 21, 'title' => __('Odpylanie spalin', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
              ['id' => 213, 'parent' => 21, 'title' => __('Odazotowanie spalin', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
              ['id' => 214, 'parent' => 21, 'title' => __('Usuwanie rtęci i LZO', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
            ],
          ],
          [
            'id' => 22,
            'parent' => 2,
            'title' => __('Uzdatnianie wody', 'i4tech'),
            'url' => $technologyArchive,
            'target' => '',
            'description' => '',
            'classes' => [],
            'children' => [
              ['id' => 221, 'parent' => 22, 'title' => __('Filtracja', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
              ['id' => 222, 'parent' => 22, 'title' => __('Dezynfekcja', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
              ['id' => 223, 'parent' => 22, 'title' => __('Techniki membranowe', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
            ],
          ],
          [
            'id' => 23,
            'parent' => 2,
            'title' => __('Oczyszczanie ścieków przemysłowych', 'i4tech'),
            'url' => $technologyArchive,
            'target' => '',
            'description' => '',
            'classes' => [],
            'children' => [
              ['id' => 231, 'parent' => 23, 'title' => __('Odzysk wody i odzysk surowców', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
              ['id' => 232, 'parent' => 23, 'title' => __('Procesy wyparne', 'i4tech'), 'url' => $technologyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
            ],
          ],
        ],
      ],
      ['id' => 3, 'parent' => 0, 'title' => __('Case study', 'i4tech'), 'url' => $caseStudyArchive, 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
      ['id' => 4, 'parent' => 0, 'title' => __('Jak działamy', 'i4tech'), 'url' => '#', 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
      ['id' => 5, 'parent' => 0, 'title' => __('O firmie', 'i4tech'), 'url' => '#', 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
      ['id' => 6, 'parent' => 0, 'title' => __('Kariera', 'i4tech'), 'url' => '#', 'target' => '', 'description' => '', 'classes' => [], 'children' => []],
    ];
  }

  $megaIntro = function (array $item): string {
    if (! empty($item['description'])) {
      return $item['description'];
    }

    $title = mb_strtolower($item['title']);

    if (str_contains($title, 'technologie')) {
      return __('Projektujemy i budujemy instalacje od A do Z', 'i4tech');
    }

    if (str_contains($title, 'rozwiązania') || str_contains($title, 'rozwiazania')) {
      return __('Specjalizujemy się w tych obszarach', 'i4tech');
    }

    return $item['title'];
  };

  $currentUrl = untrailingslashit((string) home_url(add_query_arg([], $GLOBALS['wp']->request ?? '')));
  $isCurrentItem = function (array $item) use (&$isCurrentItem, $currentUrl): bool {
    $itemUrl = untrailingslashit((string) ($item['url'] ?? ''));

    if ($itemUrl !== '' && $itemUrl !== '#' && $itemUrl === $currentUrl) {
      return true;
    }

    foreach ($item['children'] ?? [] as $child) {
      if ($isCurrentItem($child)) {
        return true;
      }
    }

    return false;
  };
@endphp

<header class="site-header site-header--{{ $variant }}" data-site-header>
  <x-container size="wide">
    <div class="site-header__inner">
      <a class="site-header__brand" href="{{ esc_url(home_url('/')) }}" rel="home">
        @if ($customLogo)
          {!! $customLogo !!}
          @include('components.logo-white')
        @else
          <span class="site-header__logo-mark" aria-hidden="true">i</span>
          <span class="site-header__logo-bolt" aria-hidden="true"></span>
          <span class="site-header__logo-text">tech</span>
        @endif
        <span class="screen-reader-text">{{ get_bloginfo('name') }}</span>
      </a>

      <button
        class="site-header__toggle"
        type="button"
        aria-controls="primary-navigation"
        aria-expanded="false"
        data-nav-toggle
      >
        <span class="site-header__toggle-label">{{ __('Menu', 'i4tech') }}</span>
        <span class="site-header__toggle-close" aria-hidden="true">{{ __('Zamknij', 'i4tech') }}</span>
      </button>

      <div class="site-header__panel" data-nav>
        <nav
          id="primary-navigation"
          class="site-header__nav"
          aria-label="{{ esc_attr__('Primary navigation', 'i4tech') }}"
        >
          @if ($menuItems)
            <ul class="site-header__menu">
              @foreach ($menuItems as $item)
                @php
                  $hasChildren = ! empty($item['children']);
                  $isCurrent = $isCurrentItem($item);
                  $itemClasses = implode(' ', array_map('sanitize_html_class', $item['classes']));
                @endphp

                <li @class([
                  'site-header__item',
                  'site-header__item--mega' => $hasChildren,
                  'site-header__item--current' => $isCurrent,
                  $itemClasses,
                ])>
                  @if ($hasChildren)
                    @php
                      $hasNestedChildren = collect($item['children'])->contains(fn ($child) => ! empty($child['children']));
                      $normalizedItemTitle = mb_strtolower($item['title']);
                      $isSolutionsMega = str_contains($normalizedItemTitle, 'rozwiąz') || str_contains($normalizedItemTitle, 'rozwiaz');
                    @endphp
                    <button
                      class="site-header__link site-header__link--button"
                      type="button"
                      aria-expanded="false"
                      data-submenu-toggle
                    >
                      {{ $item['title'] }}
                      <span
                        class="site-header__chevron"
                        style="--chevron-icon: url('{{ get_theme_file_uri('public/images/arrow-small-menu.svg') }}')"
                        aria-hidden="true"
                      ></span>
                    </button>

                    <div class="site-header__mega site-header__mega--{{ $hasNestedChildren ? 'columns' : 'links' }}" data-submenu>
                      <div class="site-header__mega-intro">
                        <p>{{ $item['title'] }}</p>
                        <strong>{{ $megaIntro($item) }}</strong>
                      </div>

                      @if ($hasNestedChildren)
                        <div class="site-header__mega-columns">
                          @foreach ($item['children'] as $child)
                            <div class="site-header__mega-column">
                              <a
                                class="site-header__mega-title"
                                href="{{ esc_url($child['url']) }}"
                                @if ($child['target']) target="{{ esc_attr($child['target']) }}" rel="noopener" @endif
                              >
                                {{ $child['title'] }}
                              </a>

                              @foreach ($child['children'] as $grandchild)
                                <a
                                  class="site-header__mega-sublink"
                                  href="{{ esc_url($grandchild['url']) }}"
                                  @if ($grandchild['target']) target="{{ esc_attr($grandchild['target']) }}" rel="noopener" @endif
                                >
                                  {{ $grandchild['title'] }}
                                </a>
                              @endforeach
                            </div>
                          @endforeach
                        </div>
                      @else
                        <div class="site-header__mega-links">
                          @foreach ($item['children'] as $child)
                            <a
                              class="site-header__mega-link"
                              href="{{ esc_url($child['url']) }}"
                              @if ($child['target']) target="{{ esc_attr($child['target']) }}" rel="noopener" @endif
                            >
                              <span>{{ $child['title'] }}</span>
                              @if ($isSolutionsMega)
                                <x-menu-arrow-icon class="site-header__mega-link-icon" />
                              @else
                                <span class="icon-button icon-button--primary icon-button--md icon-button--menu-arrow" aria-hidden="true">
                                  <x-arrow-icon />
                                </span>
                              @endif
                            </a>
                          @endforeach
                        </div>
                      @endif
                    </div>
                  @else
                    <a
                      class="site-header__link"
                      href="{{ esc_url($item['url']) }}"
                      @if ($isCurrent) aria-current="page" @endif
                      @if ($item['target']) target="{{ esc_attr($item['target']) }}" rel="noopener" @endif
                    >
                      {{ $item['title'] }}
                    </a>
                  @endif
                </li>
              @endforeach
            </ul>
          @endif
        </nav>

        <x-button class="site-header__cta" href="{{ esc_url(home_url('/kontakt/')) }}" size="sm">
          {{ __('Kontakt', 'i4tech') }}
        </x-button>
      </div>
    </div>
  </x-container>
</header>
