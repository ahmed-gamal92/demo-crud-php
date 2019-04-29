<?php

namespace Business\Services\Books;

/**
 * Interface BooksServiceInterface
 * @package Business\Services\Books
 */
interface BooksServiceInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createBook(array $data);

    /**
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function updateBook(string $id, array $data);

    /**
     * @param string $id
     * @return mixed
     */
    public function deleteBook(string $id);

    /**
     * @param string $id
     * @return mixed
     */
    public function getBook(string $id);

    /**
     * @return mixed
     */
    public function listBooks();
}