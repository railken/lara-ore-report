<?php

namespace Railken\LaraOre\Report\Attributes\Body\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportBodyNotUniqueException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'body';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_BODY_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
