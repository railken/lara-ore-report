<?php

namespace Railken\LaraOre\Report\Attributes\DeletedAt;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class DeletedAtAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'deleted_at';

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
        Tokens::NOT_DEFINED    => Exceptions\ReportDeletedAtNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\ReportDeletedAtNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\ReportDeletedAtNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\ReportDeletedAtNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'report.attributes.deleted_at.fill',
        Tokens::PERMISSION_SHOW => 'report.attributes.deleted_at.show',
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
        return v::length(1, 255)->validate($value);
    }
}
