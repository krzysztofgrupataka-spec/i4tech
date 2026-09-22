@extends('layouts.app')

@section('content')
  <section class="error-page" aria-labelledby="error-page-title">
    <x-container>
      <div class="error-page__grid">
        <div class="error-page__content">
          <p class="error-page__eyebrow">{{ __('Błąd 404', 'i4tech') }}</p>
          <h1 id="error-page-title" class="error-page__title">
            {{ __('Tej strony tutaj nie ma.', 'i4tech') }}
          </h1>
          <p class="error-page__description">
            {{ __('Wygląda na to, że podany adres jest nieprawidłowy albo strona została przeniesiona. Wróć na stronę główną i znajdźmy właściwe rozwiązanie.', 'i4tech') }}
          </p>
          <x-button href="{{ esc_url(home_url('/')) }}" :icon="true">
            {{ __('Wróć na stronę główną', 'i4tech') }}
          </x-button>
        </div>

        <div class="error-page__visual" aria-hidden="true">
          <span class="error-page__code">404</span>
          <span class="error-page__orbit error-page__orbit--one"></span>
          <span class="error-page__orbit error-page__orbit--two"></span>
          <span class="error-page__bolt"></span>
        </div>
      </div>
    </x-container>
  </section>
@endsection
