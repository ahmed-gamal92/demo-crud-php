<?php

namespace App\Transformers\V1;

use League\Fractal\TransformerAbstract;
use Models\Book;

/**
 * Class BooksTransformer
 * @package App\Transformers\V1
 */
class BooksTransformer extends TransformerAbstract
{
    /**
     * @param Book $book
     * @return mixed
     */
    public function transform(Book $book)
    {
        $response['id'] = $book->uuid;
        $response['name'] = $book->name;
        $response['price'] = $book->price;
        $response['author'] = $book->author;
        $response['category'] = $book->category;

        return $response;
    }
}