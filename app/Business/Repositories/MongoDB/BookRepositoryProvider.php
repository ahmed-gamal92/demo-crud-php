<?php

namespace Business\Repositories\MongoDB;

use Illuminate\Support\ServiceProvider;

/**
 * Class BookRepositoryProvider
 * @package Business\Repositories\MongoDB
 */
class BookRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Business\Repositories\BookRepositoryInterface', function ($app) {
            return $app->make('Business\Repositories\MongoDB\BookRepository');
        });
    }

}