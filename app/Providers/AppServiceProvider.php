<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Language;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $webSettings = Setting::latest()->first();
        View::share(['setting' => $webSettings]);

        $webLanguages = Language::latest()->get();
        View::share(['languages' => $webLanguages]);
    }
}
