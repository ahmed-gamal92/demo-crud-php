<?php

namespace App\Http\Controllers;

use App\Transformers\V1\BooksTransformer;
use Business\Services\Books\BooksServiceInterface;

/**
 * Class BooksController
 * @package App\Http\Controllers
 */
class BooksController extends Controller
{
    /**
     * @var BooksServiceInterface
     */
    private $booksService;

    /**
     * @param BooksServiceInterface $booksService
     */
    public function __construct(
        BooksServiceInterface $booksService
    )
    {
        parent::__construct(app('Illuminate\Http\Request'));
        $this->booksService = $booksService;
    }

    /**
     * Create a book
     *
     * @return mixed
     */
    public function createBook()
    {
        $fields = [
            'name',
            'price',
            'author',
            'category',
        ];

        $data = $this->getDataFromFormRequest($fields, true);

        $creationResponse = $this->booksService->createBook($data);

        if (!is_array($creationResponse)) {
            return $this->response->withItem($creationResponse, new BooksTransformer());

        }

        return $this->response->errorWrongArgs($creationResponse);
    }

    /**
     * List books
     *
     * @return mixed
     */
    public function listBooks()
    {
        $listResponse = $this->booksService->listBooks();

        return $this->response->withCollection($listResponse, new BooksTransformer());
    }

    /**
     * Get a book
     *
     * @param $id
     *
     * @return mixed
     */
    public function getBook($id)
    {
        $response = $this->booksService->getBook($id);

        if (!is_array($response)) {
            return $this->response->withItem($response, new BooksTransformer());
        }

        return $this->response->errorWrongArgs($response);
    }

    /**
     * Update a book
     *
     * @param $id
     *
     * @return mixed
     */
    public function updateBook($id)
    {
        $fields = [
            'name',
            'price',
            'author',
            'category',
        ];

        $data = $this->getDataFromFormRequest($fields, true);

        $updateResponse = $this->booksService->updateBook($id, $data);

        if (!is_array($updateResponse)) {
            return $this->response->withItem($updateResponse, new BooksTransformer());
        }

        return $this->response->errorWrongArgs($updateResponse);
    }

    /**
     * Delete a book
     *
     * @param $id
     *
     * @return mixed
     */
    public function deleteBook($id)
    {
        $response = $this->booksService->deleteBook($id);

        if (!is_array($response)) {
            return $this->response->withArray([
                'status' => 'OK'
            ]);
        }

        return $this->response->errorWrongArgs($response);
    }
}
