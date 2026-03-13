<?php

use App\Exceptions\GlobalExceptionHandler;
use App\Exceptions\ParentException;
use App\Http\Middleware\ApiLocalization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Add our middleware to the 'api' group
        $middleware->api(append: [ ApiLocalization::class ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e , Request $request) {

        $className = get_class($e);
        $handlers = GlobalExceptionHandler::$globalExceptions;

        if ($e instanceof ParentException){
            return $e->render();
        }
        
        elseif (array_key_exists($className, $handlers)) {
            $method = $handlers[$className];
            $apiException = new GlobalExceptionHandler();
            return $apiException->$method($e, $request);
        }

        // Fallback to default error response
        return response()->json([
            'error' => [
                'type' => basename(get_class($e)),
                'message' => $e->getMessage() ?: 'An unexpected error occurred',
            ]
        ], $e->getCode() ?: 500);   
        
    });


})->create();
