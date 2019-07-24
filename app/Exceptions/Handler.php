<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        if (app()->bound('sentry') && $this->shouldReport($exception) && config('app.debug') == false){
            app('sentry')->captureException($exception);
        }
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
        if ($request->expectsJson() || $request->acceptsAnyContentType()) {
            if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return response()->json(['errors'=>[ ['status'=>403, 'title'=>'Forbidden'] ]], 403);
            }
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json(['errors'=>[ ['status'=>422, 'title'=>'Validation Exception', 'message'=>$exception->errorBag('default')->getMessage()] ]], 422);
            }

        }
        return parent::render($request, $exception);
    }
}
