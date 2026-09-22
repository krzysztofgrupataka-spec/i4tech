@extends('layouts.app')

@section('content')
  @while (have_posts())
    @php
      the_post();
    @endphp

    <article @php(post_class('entry entry--block-layout entry--case-study'))>
      @php(the_content())
    </article>
  @endwhile
@endsection
