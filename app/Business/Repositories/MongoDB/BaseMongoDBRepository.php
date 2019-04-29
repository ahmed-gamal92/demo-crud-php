<?php

namespace Business\Repositories\MongoDB;

use Jenssegers\Mongodb\Eloquent\Model;
use LOOP\LaravelRepositories\src\EloquentRepository;

/**
 * Class BaseMongoDBRepository
 * @package Business\Repositories\MongoDB
 */
abstract class BaseMongoDBRepository extends EloquentRepository
{
    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}