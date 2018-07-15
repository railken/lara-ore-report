<?php

namespace Railken\LaraOre\Report\Attributes\Filter\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportFilterNotUniqueException extends ReportAttributeException
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
    protected $code = 'REPORT_FILTER_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
