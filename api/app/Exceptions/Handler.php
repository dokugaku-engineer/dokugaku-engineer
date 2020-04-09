<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\JsonRespondController;

class Handler extends ExceptionHandler
{
    use JsonRespondController;

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
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
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
        if (!config('app.debug') && ($request->ajax() || $request->is('api/*'))) {
            $status = 400;
            if ($this->isHttpException($exception)) {
                $status = $exception->getStatusCode();
            }

            // 非HTTPアクセスの場合は500エラーにする
            if ($this->shouldReport($exception) && !$this->isHttpException($exception)) {
                $status = 500;
            }

            return $this->setHTTPStatusCode($status)
                ->setErrorCode(40)
                ->respondWithError($exception->getMessage());
        }
        return parent::render($request, $exception);
    }
}
