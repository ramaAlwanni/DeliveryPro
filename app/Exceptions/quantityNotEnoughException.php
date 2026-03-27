<?php

namespace App\Exceptions;

use Exception;

class quantityNotEnoughException extends Exception
{
    protected $message = 'quantity not enough!';
    protected $code = 400;
}
