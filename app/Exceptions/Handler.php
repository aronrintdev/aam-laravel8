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
        /*
        if (app()->bound('sentry') && $this->shouldReport($exception) && config('app.debug') == true){
            //sentry people are django people, so they
            //don't get Laravel
            //the IP Address is not taken from Laravel / Symfony
            //after it has done the trusted proxy check, it's only
            //taken from  $_SERVER
            \Sentry\Laravel\Integration::configureScope(function (\Sentry\State\Scope $scope): void {
                $u = \Auth()->user();
                $scope->setUser([
                    'email' => optional($u)->Email,
                    'id' => optional($u)->AccountID,
                    'ip_address' => Request()->ip(),
                ]);
            });
            app('sentry')->captureException($exception);
        }
        */
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
                $err = ['status'=>403, 'title'=>'Forbidden'];
                if ( $exception->getMessage() != '' ) {
                    $err['detail'] = $exception->getMessage();
                }
                return response()->json(['errors'=>[ $err ]], 403);
            }
            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json(['errors'=>[ ['status'=>404, 'title'=>'Not Found'] ]], 404);
            }
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                $errors = [];
                foreach($exception->errors() as $field => $err) {
                    $errors[] = ['status'=>422, 'source'=>$field, 'title'=>'Validation Exception', 'message'=>$err[0]];
                }
                return response()->json(['errors'=> $errors ], 422);
            }

        }
        return parent::render($request, $exception);
    }
}
