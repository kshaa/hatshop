<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Facades\App;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $exceptionClass = get_class($exception);
        switch ($exceptionClass) {
            case UnauthorizedException::class:
                return response()->view('errors.custom', ['message' => 'Unauthorized request!'], 401);
                break;
            case MethodNotAllowedHttpException::class:
                return response()->view('errors.custom', ['message' => 'The HTTP verb you used is not allowed here'], 405);
                break;
        }

        $env = App::environment();
        if ($env === 'production' || $env == 'staging') {
            return response()->view('errors.custom', ['message' => 'There were problems serving this page :('], 500);
        }

        return parent::render($request, $exception);
    }
}
