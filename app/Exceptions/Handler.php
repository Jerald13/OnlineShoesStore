<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

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

     public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->view(
                "page-404",
                [],
                Response::HTTP_NOT_FOUND
            );
 
        } elseif (
            $exception instanceof NotFoundHttpException ||
            $exception instanceof ModelNotFoundException
        ) {
            return response()->view(
                "page-404",
                [],
                Response::HTTP_NOT_FOUND
            );
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            return response()->view(
                "page-404",
                [],
                Response::HTTP_METHOD_NOT_ALLOWED
            );
        } else {
            return response()->view(
                "page-404",
                [],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
