<?php

namespace App\Exceptions;

use App\DataModels\BaseResponse;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

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
        if($request->wantsJson()){
            $baseResponse = new BaseResponse(BaseResponse::CODE_EXCEPTION,null, $exception->getMessage());
            switch(true){
                case $exception instanceof AuthenticationException:
                    $baseResponse->setCode(BaseResponse::CODE_UNAUTHORIZED)->setMessage($exception->getMessage())->setException($exception);
                    break;
                case ($exception instanceof ValidationException):
                case ($exception instanceof ValidationCustomException):

                    $baseResponse->setCode(BaseResponse::CODE_VALIDATION)->setData($exception->errors());
                    break;
            }
            return response($baseResponse->toArray(), $baseResponse->getCode()==BaseResponse::CODE_EXCEPTION
                ? BaseResponse::CODE_EXCEPTION
                : BaseResponse::CODE_SUCCESS);
        }
        return parent::render($request, $exception);
    }
}
