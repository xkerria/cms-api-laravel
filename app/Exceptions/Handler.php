<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthenticationException)
            return response()->json([
                'status' => 401,
                'message' => '用户认证失效，请重新登录',
            ], 401);

        if ($e instanceof ModelNotFoundException)
            return response()->json([
                'status' => 404,
                'message' => '数据不存在',
            ], 404);

        if ($e instanceof NotFoundHttpException)
            return response()->json([
                'status' => 404,
                'message' => '接口不存在',
            ], 404);

        if ($e instanceof ValidationException) {
            $errors = join(' | ', array_map(function ($i) {
                return $i[0];
            }, array_values($e->errors())));
            return response()->json([
                'status' => 422,
                'message' => $errors,
            ], 422);
        }

        if ($e instanceof ApiException)
            return response()->json([
                'status' => $e->getStatus(),
                'message' => $e->getMessage(),
            ], $e->getStatus());


        $status = 500;
        if (env('APP_DEBUG', false)) {
            return response()->json([
                'status' => $status,
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => explode(PHP_EOL, $e->getTraceAsString())
            ], $status);
        }

        return response()->json([
            'status' => $status,
            'message' => $e->getMessage(),
        ], $status);

//        return parent::render($request, $exception);
    }
}
