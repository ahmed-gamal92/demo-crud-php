<?php

namespace Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * Class Book
 * @package Models
 */
class Book extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'uuid',
        'name',
        'author',
        'category',
        'price'
    ];

}