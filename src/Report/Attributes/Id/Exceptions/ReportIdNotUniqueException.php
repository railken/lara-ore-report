<?php

namespace Railken\LaraOre\Report\Attributes\Id\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportIdNotUniqueException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_ID_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
