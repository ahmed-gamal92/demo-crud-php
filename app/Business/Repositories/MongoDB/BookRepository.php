<?php

namespace Business\Repositories\MongoDB;

use Business\Repositories\BookRepositoryInterface;
use Models\Book;

/**
 * Class BookRepository
 * @package Business\Repositories\MongoDB
 */
class BookRepository extends BaseMongoDBRepository implements BookRepositoryInterface
{
    /**
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        parent::__construct($book);
    }
}