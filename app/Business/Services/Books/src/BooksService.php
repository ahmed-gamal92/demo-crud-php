<?php

namespace Business\Services\Books\src;

use Business\Repositories\BookRepositoryInterface;
use Business\Services\Books\BooksServiceInterface;
use Business\Services\Books\Validation\BooksValidatorInterface;
use Webpatser\Uuid\Uuid;

/**
 * Class BooksService
 * @package Business\Services\Books\src
 */
class BooksService implements BooksServiceInterface
{
    /**
     * @var BookRepositoryInterface
     */
    private $booksRepo;

    /**
     * @var BooksValidatorInterface
     */
    private $booksValidator;

    /**
     * @param BookRepositoryInterface $booksRepo
     * @param BooksValidatorInterface $booksValidator
     */
    public function __construct(
        BookRepositoryInterface $booksRepo,
        BooksValidatorInterface $booksValidator
    )
    {
        $this->booksRepo = $booksRepo;
        $this->booksValidator = $booksValidator;
    }

    /**
     * Create a book
     *
     * @param array $data
     *
     * @return array|mixed
     */
    public function createBook(array $data)
    {
        $data['uuid'] = Uuid::generate()->string;

        if ($this->booksValidator->with($data)->passes(BooksValidatorInterface::VALID_FOR_CREATION)) {
            $book = $this->booksRepo->create($data);

            return $book;
        }

        return $this->booksValidator->errors();
    }

    /**
     * Update a book
     *
     * @param string $id
     * @param array $data
     *
     * @return array|mixed
     */
    public function updateBook(string $id, array $data)
    {
        $data['uuid'] = $id;
        if ($this->booksValidator->with($data)->passes(BooksValidatorInterface::VALID_FOR_UPDATE)) {
            $this->booksRepo->updateBy($data, $id, 'uuid');

            return $this->booksRepo->findOneBy($id, 'uuid');
        }

        return $this->booksValidator->errors();
    }

    /**
     * Delete a book
     *
     * @param string $id
     *
     * @return array|bool
     */
    public function deleteBook(string $id)
    {
        $data['uuid'] = $id;

        if ($this->booksValidator->with($data)->passes(BooksValidatorInterface::EXISTS_BY_ID)) {

            return $this->booksRepo->delete($id, 'uuid');
        }

        return $this->booksValidator->errors();
    }

    /**
     * Retrieve a book
     *
     * @param string $id
     *
     * @return array|mixed
     */
    public function getBook(string $id)
    {
        $data['uuid'] = $id;

        if ($this->booksValidator->with($data)->passes(BooksValidatorInterface::EXISTS_BY_ID)) {

            return $this->booksRepo->findOneBy($id, 'uuid');
        }

        return $this->booksValidator->errors();
    }

    /**
     * List all books
     *
     * @return mixed
     */
    public function listBooks()
    {
        return $this->booksRepo->findAll();
    }
}