<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'v1/books'
], function () {

    Route::post('/', [
        'uses' => 'BooksController@createBook'
    ]);

    Route::get('/', [
        'uses' => 'BooksController@listBooks'
    ]);

    Route::group([
        'prefix' => '{id}'
    ], function () {
        Route::get('/', [
            'uses' => 'BooksController@getBook'
        ]);

        Route::put('/', [
            'uses' => 'BooksController@updateBook'
        ]);

        Route::delete('/', [
            'uses' => 'BooksController@deleteBook'
        ]);
    });
});

