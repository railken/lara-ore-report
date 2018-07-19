<?php

namespace Railken\LaraOre\Report\Attributes\RepositoryId\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportRepositoryIdNotValidException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'repository_id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_REPOSITORY_ID_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
