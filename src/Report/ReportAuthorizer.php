<?php

namespace Railken\LaraOre\Report;

use Railken\Laravel\Manager\ModelAuthorizer;
use Railken\Laravel\Manager\Tokens;

class ReportAuthorizer extends ModelAuthorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'report.create',
        Tokens::PERMISSION_UPDATE => 'report.update',
        Tokens::PERMISSION_SHOW   => 'report.show',
        Tokens::PERMISSION_REMOVE => 'report.remove',
    ];
}
