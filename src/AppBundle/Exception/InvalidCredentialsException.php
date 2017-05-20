<?php

namespace AppBundle\Exception;

class InvalidCredentialsException extends \Exception
{
    public function __construct($message = 'Invalid credentials.', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}