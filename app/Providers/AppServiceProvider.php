<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

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
        Schema::defaultstringLength(255);
        Paginator::useBootstrap();

        view()->share('config', Config::find(1));
        Route::resourceVerbs([
                                'create' => 'olustur',
                                'edit'   => 'duzenle',
                             ]);
    }
}
