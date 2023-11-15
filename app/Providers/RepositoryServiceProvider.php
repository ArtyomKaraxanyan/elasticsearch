<?php

namespace App\Providers;

use App\Repository\Eloquent\ArticlesRepository;
use App\Repository\Eloquent\EloquentRepository;
use App\Repository\Interface\Articlesinterface;
use App\Repository\Interface\EloquentInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentInterface::class,EloquentRepository::class);
        $this->app->bind(Articlesinterface::class,ArticlesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
