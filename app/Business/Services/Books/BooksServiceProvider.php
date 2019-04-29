<?php

namespace Business\Services\Books;

use Illuminate\Support\ServiceProvider;

/**
 * Class BooksServiceProvider
 * @package Business\Services\Books
 */
class BooksServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Business\Services\Books\BooksServiceInterface', function ($app) {
            return $app->make('Business\Services\Books\src\BooksService');
        });

        $this->app->bind( 'Business\Services\Books\Validation\BooksValidatorInterface', function ( $app )
        {
            return $app->make( 'Business\Services\Books\Validation\src\BooksValidator' );
        });
    }

}