<?php

namespace App\Exceptions;

use App\Trait\Response;
use Exception;

class ParentException extends Exception
{
    use Response;
    public function render()
    {
        return $this->ErrorResponse(
            'Error',
            $this->getMessage(),
            null,
            $this->getCode() ?: 400
        );
    }
}
