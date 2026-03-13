<?php

namespace App\Exceptions;

use App\Trait\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GlobalExceptionHandler
{
    use Response;
    
    public static array $globalExceptions = [
        AuthenticationException::class =>  'handleAccessDeniedHttpException',
        AccessDeniedHttpException::class => 'handleAccessDeniedHttpException',
        AuthorizationException::class =>  'handleAuthorizationException',
        ValidationException::class =>  'handleValidationException',
        ModelNotFoundException::class =>  'handleNotFoundException',
        NotFoundHttpException::class =>   'handleNotFoundException',
        MethodNotAllowedHttpException::class => 'handleMethodNotAllowedHttpException',
        HttpException::class => 'handleHttpException',
        QueryException::class => 'handleQueryException',
    ];
    //----------------------------------------------------------------------------
    public function handleAccessDeniedHttpException(AccessDeniedHttpException|AuthenticationException $e)
    {
        return $this->ErrorResponse(
            'Error',
            'Authentication required. Please provide valid credentials.',
            null,
            401
        );
    }
    //----------------------------------------------------------------------------
    public function handleAuthorizationException(AuthorizationException $e)
    {
        return $this->ErrorResponse(
            'Error',
            'You do not have permission to perform this action.',
            null,
            403
        );
    }
    //----------------------------------------------------------------------------
    public function handleValidationException(ValidationException $e)
    {
        $errors = [];

        foreach ($e->errors() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'field' => $field,
                    'message' => $message,
                ];
            }
        }

        return $this->ErrorResponse(
            'Error',
            'The provided data is invalid.',
            $errors,
            422
        );
    }
    //------------------------------------------------------------------------------
    public function handleNotFoundException(ModelNotFoundException|NotFoundHttpException $e)
    {
        return $this->ErrorResponse(
            'Error',
            'The requested resource was not found.',
            null,
            404
        );
    }
    //-------------------------------------------------------------------------------
    public function handleMethodNotAllowedHttpException(MethodNotAllowedHttpException $e)
    {
        return $this->ErrorResponse(
            'Error',
            'This method is not allowed for this endpoint.',
            null,
            405
        );
    }
    //----------------------------------------------------------------------------
    public function handleHttpException(HttpException $e)
    {
        return $this->ErrorResponse(
            'Error',
            'An HTTP error occurred.',
            null,
            $e->getStatusCode()
        );
    }
    //----------------------------------------------------------------------------
    public function handleQueryException(QueryException $e)
    {
        return $this->ErrorResponse(
            'Error',
            'A database error occurred!',
            null,
            500
        );
    }    
}

