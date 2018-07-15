<?php

namespace Railken\LaraOre\Report\Exceptions;

class ReportNotFoundException extends ReportException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Not found';
}
