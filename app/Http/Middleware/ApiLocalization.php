<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Grab the first two letters from the Accept-Language header
        $locale = substr($request->header('Accept-Language'), 0, 2);

        // If the header is missing or empty, fall back to the default app locale
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = config('app.locale');
        }

        // Set the locale for this request
        app()->setLocale($locale);
        
        return $next($request);
    }
}
