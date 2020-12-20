<?php


namespace App\Traits;


use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

trait ExceptionManagerCore
{
    public function handleApiException($request,\Exception $exception){
        $exception=$this->prepareException($exception);

        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }


    public function customApiResponse($exception){
        if(method_exists($exception,'getCode')){
            $statusCode=$exception->getCode();
        }elseif(method_exists($exception,'getStatusCode')){
            $statusCode=$exception->getStatusCode();
        }else{
            $statusCode=500;
        }

        $response=[
          'data'=>null,
          'message'=>$exception->getMessage(),
          'status'=>$statusCode
        ];
        if(config('app.debug')){
            $response['errors']['trace']=$exception->getTrace();
            $response['errors']['code']=$exception->getCode();
        }
        return response()->json($response,$statusCode);
    }
}
