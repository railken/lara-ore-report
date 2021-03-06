<?php

namespace Railken\LaraOre\Report\Attributes\UpdatedAt\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportUpdatedAtNotValidException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'updated_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_UPDATED_AT_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
