<?php

namespace Business\Services\Books\Validation\src;

use Business\Services\Books\Validation\BooksValidatorInterface;
use LOOP\ValidationService\src\LaravelValidator;

/**
 * Class BooksValidator
 * @package Business\Services\Books\Validation\src
 */
class BooksValidator extends LaravelValidator implements BooksValidatorInterface
{
    /**
     * @return array
     */
    public function existsById(): array
    {
        return [
            'uuid' => 'required|exists:books,uuid'
        ];
    }

    /**
     * @return array
     */
    public function validForCreation(): array
    {
        return [
            'name' => 'required|string|unique:books',
            'author' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
        ];
    }

    public function validForUpdate(): array
    {
        return [
            'uuid' => 'required|exists:books,uuid',
            'name' => 'string|unique:books,uuid',
            'author' => 'string',
            'category' => 'string',
            'price' => 'numeric',
        ];
    }
}