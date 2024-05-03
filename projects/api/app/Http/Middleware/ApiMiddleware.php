<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accept = $request->header('Accept');

        if (!Str::is('application/json', $accept)) {
            return new JsonResponse([
                'status' => false,
                'data' => null,
                'errors' => [
                    'Accept header is incorrect'
                ],
                'message' => 'Fail'
            ],
                options: JSON_PRETTY_PRINT,
            );
        }

        return $next($request);
    }
}
