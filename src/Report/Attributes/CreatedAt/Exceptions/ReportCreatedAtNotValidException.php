<?php

namespace Railken\LaraOre\Report\Attributes\CreatedAt\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportCreatedAtNotValidException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'created_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_CREATED_AT_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
