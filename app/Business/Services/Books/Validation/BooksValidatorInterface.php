<?php

namespace Business\Services\Books\Validation;

use LOOP\ValidationService\ValidatorInterface;

/**
 * Interface BooksValidatorInterface
 * @package Business\Services\Books\Validation
 */
interface BooksValidatorInterface extends ValidatorInterface
{
    const EXISTS_BY_ID = 'existsById';
    const VALID_FOR_CREATION = 'validForCreation';
    const VALID_FOR_UPDATE = 'validForUpdate';

    /**
     * Checks exist by id
     * @return array
     */
    public function existsById(): array;

    /**
     * Checks attributes a valid for creation
     * @return array
     */
    public function validForCreation(): array;

    /**
     * Checks attributes a valid for update
     * @return array
     */
    public function validForUpdate(): array;

}