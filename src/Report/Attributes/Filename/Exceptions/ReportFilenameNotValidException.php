<?php

namespace Railken\LaraOre\Report\Attributes\Filename\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportFilenameNotValidException extends ReportAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'filename';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'REPORT_FILENAME_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
