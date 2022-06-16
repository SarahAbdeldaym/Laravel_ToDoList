<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
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

    public function render($request, Throwable $e){
        $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($e instanceof ValidationException) {
            $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
            return response()->json([
                'status' => false,
                'errors' => $e->validator->errors()->messages()
            ], $httpStatusCode);
        }

        if ($e instanceof EntityNotFoundException) {
            $httpStatusCode = Response::HTTP_NOT_FOUND;
        }

        return response()->json([
            'status' => false,
            'errors' => $e->getMessage()
        ], $httpStatusCode);
    }
}
