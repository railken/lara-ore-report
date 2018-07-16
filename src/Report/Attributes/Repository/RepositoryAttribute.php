<?php

namespace Railken\LaraOre\Report\Attributes\Repository;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

class RepositoryAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'repository';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = false;

    /**
     * Is the attribute unique.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * List of all exceptions used in validation.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_DEFINED    => Exceptions\ReportRepositoryNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\ReportRepositoryNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\ReportRepositoryNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\ReportRepositoryNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'report.attributes.repository.fill',
        Tokens::PERMISSION_SHOW => 'report.attributes.repository.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param \Railken\Laravel\Manager\Contracts\EntityContract $entity
     * @param mixed                                             $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return class_exists($value);
    }
}
