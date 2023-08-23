<?php

namespace App\Providers;

use App\Models\Footer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $websiteSetting = Footer::first();
        View::share('appSetting', $websiteSetting);

        // add Str::currency macro
        Str::macro('currency', function ($price) {
            return number_format($price, 2, '.', ',');
        });
    }
}
