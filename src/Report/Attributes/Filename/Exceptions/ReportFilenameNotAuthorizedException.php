<?php

namespace Railken\LaraOre\Report\Attributes\Filename\Exceptions;

use Railken\LaraOre\Report\Exceptions\ReportAttributeException;

class ReportFilenameNotAuthorizedException extends ReportAttributeException
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
    protected $code = 'REPORT_FILENAME_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
