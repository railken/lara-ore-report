<?php

namespace Railken\LaraOre\Report\Attributes\Input\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportInputNotAuthorizedException extends ReportAttributeException
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
    protected $code = 'REPORT_INPUT_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
