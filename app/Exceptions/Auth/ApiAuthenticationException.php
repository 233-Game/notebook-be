<?php

namespace App\Exceptions\Auth;

use Exception;
use Throwable;

class ApiAuthenticationException extends Exception
{

    public function __construct($message = "", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
