<?php

namespace App\Providers;

use App\Entities\ProductRepository;
use App\Repositories\ProductRepositoryEloquent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        App::bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductRepository::class, \App\Repositories\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ImageRepository::class, \App\Repositories\ImageRepositoryEloquent::class);
        //:end-bindings:
    }
}
