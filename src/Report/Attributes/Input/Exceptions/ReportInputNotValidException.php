<?php

namespace Railken\LaraOre\Report\Attributes\Input\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportInputNotValidException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'input';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_INPUT_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
