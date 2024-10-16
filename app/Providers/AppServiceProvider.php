<?php

namespace App\Providers;


use App\Models\Cif;
use App\Observers\CifObserver;
use App\View\Components\PreloaderComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        Cif::observe(CifObserver::class);
        Blade::component('preloader', PreloaderComponent::class);
    }

}
