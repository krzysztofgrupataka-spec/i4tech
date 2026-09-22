<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->config->set('view.paths', [
            get_theme_file_path('resources/views'),
        ]);
    }
}
