@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <article @php(post_class('entry entry--block-layout'))>
      @php(the_content())
    </article>
  @endwhile
@endsection
