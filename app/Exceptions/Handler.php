<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use App\Traits\ApiResponse;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{

    use ApiResponse;
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


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('employee') || $request->is('employee/*')) {
            return redirect()->guest('/login/employee');
        }
        return redirect()->guest(route('login'));
    }

    // /**
    //  * Render an exception into an HTTP response.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \Exception  $exception
    //  * @return \Illuminate\Http\Response
    //  */
    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof ValidationException) {
    //         return $this->convertValidationExceptionToResponse($exception, $request);
    //     }

    //     if ($exception instanceof ModelNotFoundException) {
    //         $modelName = strtolower(class_basename($exception->getModel()));

    //         return $this->errorResponse("Dose not exists any {$modelName} with the specified identificator", 404);
    //     }

    //     if ($exception instanceof AuthenticationException) {
    //         return $this->unauthenticated($request , $exception );
    //     }

    //     if ($exception instanceof AuthorizationException) {
    //         return $this->errorResponse($exception->getMessage(), 403);
    //     }

    //     if ($exception instanceof MethodNotAllowedHttpException) {
    //         return $this->errorResponse('The specified method for the requestes is invalid', 405);
    //     }

    //     if ($exception instanceof MethodNotAllowedHttpException) {
    //         return $this->errorResponse('The specified method for the requestes is invalid', 405);
    //     }

    //     if ($exception instanceof HttpException) {
    //         return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
    //     }

    //     if ($exception instanceof QueryException) {

    //         $errorCode = $exception->errorInfo[1];

    //         if ($errorCode == 1451) {
    //            return $this->errorResponse('can not remove this resource permanently. It is related whit any other resource', 409); 
    //         }
            
    //     }

    //     if ($exception instanceOf TokenMisMatchException) {
    //         return redirect()->back()->withInput($request->input());
    //     }

    //     if (config('app.debug')) {
    //         return parent::render($request, $exception);
    //     }

    //     return $this->errorResponse('Unexpected Exception. Try Later', 500);

    // }

    // protected function unauthenticated($request, AuthenticationException $exception){

    //     if ($this->isFrontend($request)) {
    //         return redirect()->guest('login');
    //     }

    //     return $this->errorResponse('Unauthenticated.' , 401);
    // }
      
    // protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    // {
    //     $errors = $e->validator->errors()->getMessages();

    //     if ($this->isFrontend($request)) {
    //         return $request->ajax() ? response()->json($error, 422) : redirect()
    //         ->back()
    //         ->withInput($request->input())
    //         ->withErrors($errors);
    //     }
    //     return $this->errorResponse($errors, 422);
    // }

    // private function isFrontend($request)
    // {
    //     return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    // }
}
