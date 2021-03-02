<?php

namespace App\Traits;

use App\Exceptions\CustomException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Throwable;

/**
 * Trait HasExceptionApiResponse
 *
 * @package App\Http\Concerns
 */
trait HasExceptionApiResponse
{
    use HasApiResponse;

    /**
     * Response Exception
     *
     * @param Request   $request   Request
     * @param Throwable $exception Throwable\Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseException($request, Throwable $exception)
    {
        switch (true) {
            case $exception instanceof UnauthorizedException:
            case $exception instanceof AuthenticationException:
                return $this->responseError(__('exception.unauthorized'), [], Response::HTTP_UNAUTHORIZED);

            case $exception instanceof ValidationException:
                return $this->responseError(
                    __('exception.validation_error'),
                    $this->beautifyErrorValidate($exception->validator->errors()->toArray()),
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );

            case $exception instanceof NotFoundHttpException:
                return $this->responseError(__('exception.not_found_error'), [], Response::HTTP_NOT_FOUND);

            case $exception instanceof ModelNotFoundException:
                return $this->responseError(__('exception.not_found_model'), [], Response::HTTP_NOT_FOUND);

            case $exception instanceof CustomException:
                return $this->responseError($exception->getMessage(), $exception->getErrors(), $exception->getCode());

            case $exception instanceof ServiceUnavailableHttpException:
                return $this->responseError(__('exception.maintenance'), [], $exception->getStatusCode());

            case $exception instanceof HttpException:
                return $this->responseError($exception->getMessage(), [], $exception->getStatusCode());

            case $exception instanceof AuthorizationException:
                return $this->responseError($exception->getMessage(), [], Response::HTTP_FORBIDDEN);

            case $exception instanceof MethodNotAllowedHttpException:
                return $this->responseError($exception->getMessage(), [], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return $this->responseError($exception, [], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Beautiful Error validate
     *
     * @param array $errors
     *
     * @return array
     */
    private function beautifyErrorValidate(array $errors)
    {
        $errorResponses = [];
        foreach ($errors as $key => $error) {
            foreach ($error as $detail) {
                $errorResponses[] = [
                    'title'   => __('exception.field_error', ['field' => $key]),
                    'detail'  => $detail,
                    'pointer' => $key
                ];
            }
        }

        return $errorResponses;
    }
}
