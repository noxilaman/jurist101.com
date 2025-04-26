<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
{
    if ($exception instanceof TokenExpiredException) {
        return response()->json(['error' => 'Token has expired'], 401);
    } elseif ($exception instanceof TokenInvalidException) {
        return response()->json(['error' => 'Token is invalid'], 401);
    } elseif ($exception instanceof JWTException) {
        return response()->json(['error' => 'Token is missing or invalid'], 401);
    } elseif ($exception instanceof UnauthorizedHttpException && $exception->getPrevious() instanceof TokenExpiredException) {
        return response()->json(['error' => 'Token has expired (wrapped)'], 401);
    }

    return parent::render($request, $exception);
}
}
