<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        logInfo($request);

        if ($this->isHttpException($e)) {

            if ($e->getStatusCode() === 404) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => '404 | Not found'
                    ]
                ], 404);
            }

            if ($e->getStatusCode() == 500) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => '500 | Server error'
                    ]
                ], 500);
            }

            if ($e->getStatusCode() == 405) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => '405 | Method not allowed'
                    ]
                ], 405);
            }


        }

        return parent::render($request, $e);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // Here you can return your own response or work with request
        // return response()->json(['status' : false], 401);

        // This is the default
        return $request->expectsJson()
            ? response()->json([
                'success' => false,
                'data' => [
                    'error' => $exception->getMessage()
                ]
            ], 401)
            : redirect()->guest($exception->redirectTo() ?? route('index'));
    }

}
