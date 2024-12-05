<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

    //coustom validation error massage

    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof \Illuminate\Validation\ValidationException) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Validation failed',
    //             'errors' => $exception->errors(),
    //         ], 422);
    //     }

    //     return parent::render($request, $exception);
    // }

    //for login another device show the error

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Laravel\Sanctum\Exceptions\MissingAbilityException) {
            return response()->json(['message' => 'Invalid token. Sorry! Another device is logged in.'], 401);
        }
    
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json(['message' => 'Unauthenticated. Sorry! Another device is logged in.'], 401);
        }
    
        return parent::render($request, $exception);
    }
}