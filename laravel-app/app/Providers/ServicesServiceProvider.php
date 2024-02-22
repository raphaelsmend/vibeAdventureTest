<?php

namespace App\Providers;

use App\Services\SearchService;
use App\Services\Contracts\SearchServiceContract;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SearchServiceContract::class,
            SearchService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            SearchService::class,
        ];
    }
}
