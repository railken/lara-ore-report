<?php

namespace Railken\LaraOre\Report\Attributes\Filter\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportFilterNotAuthorizedException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'filter';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_FILTER_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
