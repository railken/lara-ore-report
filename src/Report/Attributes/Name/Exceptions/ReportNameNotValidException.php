<?php

namespace Railken\LaraOre\Report\Attributes\Name\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportNameNotValidException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'name';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_NAME_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
