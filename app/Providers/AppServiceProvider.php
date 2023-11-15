<?php

namespace App\Providers;

use App\Repository\Eloquent\ArticlesRepository;
use App\Repository\Eloquent\EloquentRepository;
use Elastic\Elasticsearch\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(ArticlesRepository::class, function () {
//
//            if (! config('services.search.enabled')) {
//                return new EloquentRepository();
//            }
//            return new EloquentRepository(
//                $this->app->make(Client::class)
//            );
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
