<?php

namespace App\Providers;

use App\Services\Blog_api\Client;
use Illuminate\Support\ServiceProvider;

class BlogApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client(
                config('services.blogApi.uri'),
                config('services.blogApi.token'),
                config('services.blogApi.timeout'),
                config('services.blogApi.retry_times'),
                config('services.blogApi.retry_milliseconds')
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
