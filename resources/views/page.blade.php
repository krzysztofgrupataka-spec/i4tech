@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <?php
      $contentBlocks = parse_blocks((string) get_the_content());
      $usesCustomBlocks = false;

      foreach ($contentBlocks as $contentBlock) {
          $blockName = isset($contentBlock['blockName']) ? (string) $contentBlock['blockName'] : '';

          if (strpos($blockName, 'acf/') === 0) {
              $usesCustomBlocks = true;
              break;
          }
      }
    ?>

    @if ($usesCustomBlocks)
      <article @php(post_class('entry entry--block-layout'))>
        @php(the_content())
      </article>
    @else
      <article @php(post_class('content-page'))>
        <header class="content-page__header">
          <x-container>
            <h1 class="content-page__title">{{ get_the_title() }}</h1>
          </x-container>
        </header>

        <div class="content-page__body">
          <x-container>
            <div class="content-page__prose">
              @php(the_content())
            </div>
          </x-container>
        </div>
      </article>
    @endif
  @endwhile
@endsection
