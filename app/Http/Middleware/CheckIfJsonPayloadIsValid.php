<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfJsonPayloadIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      /*  if (empty($request->json()->all())) {
            return response()->json([
                'success' => false,
                'data' => [
                    'error' => 'The request is not a valid JSON.'
                ]
            ], 400);
        }*/

        return $next($request);
    }
}
