<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ParentException;

class LoginException extends ParentException
{
    protected $message = 'Invalid email or password!';
    protected $code = 401 ;
}
