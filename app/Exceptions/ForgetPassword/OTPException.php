<?php

namespace App\Exceptions\ForgetPassword;

use App\Exceptions\ParentException;

class OTPException extends ParentException
{
    protected $message = 'Invalid OTP!';
    protected $code = 400;
}