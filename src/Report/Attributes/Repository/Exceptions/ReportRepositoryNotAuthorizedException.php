<?php

namespace Railken\LaraOre\Report\Attributes\Repository\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportRepositoryNotAuthorizedException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'repository';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_REPOSITORY_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
