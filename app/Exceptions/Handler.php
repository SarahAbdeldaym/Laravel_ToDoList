<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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
        if ($e instanceof ValidationException) {
            return response()->json([
                'status' => false,
                'errors' => $e->validator->errors()->messages()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => false,
                'errors' => 'Route not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $httpStatusCode = match (get_class($e)) {
            RouteNotFoundException::class => Response::HTTP_NOT_FOUND,

            EntityNotFoundException::class => Response::HTTP_NOT_FOUND,

            InvalidUserCredentialsException::class,
            UserNotAuthenticatedException::class,
            UnauthorizedException::class => Response::HTTP_UNAUTHORIZED,

            TodoAlreadyDoneException::class,
            TodoAlreadyOpenedException::class => Response::HTTP_UNPROCESSABLE_ENTITY,

            default => Response::HTTP_INTERNAL_SERVER_ERROR
        };

        return response()->json([
            'status' => false,
            'errors' => $e->getMessage()
        ], $httpStatusCode);
    }
}
