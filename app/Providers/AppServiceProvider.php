<?php

namespace App\Providers;

use App\Events\NotificationEvent;
use App\Events\PostCreated;
use App\Listeners\NotifyUser;
use App\Models\Category;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $seconds = 86400; //24 hours
            $categories = cache()->remember('categories', $seconds, function () {
                return Category::whereActive(true)->latest()->get();
            });
            View::share('categories', $categories);

        });

        Paginator::useBootstrap();
    }
}
