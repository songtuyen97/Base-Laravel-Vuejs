<?php

namespace App\Traits;

use App\Exceptions\CustomException;
use App\Utils\LogsHelper;
use App\Utils\TransactionHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

/**
 * Trait HasApiResponse
 *
 * @package App\Http\Concerns
 */
trait HasApiResponse
{
    /**
     * Response
     *
     * @param bool   $success      Success?
     * @param array  $data         Data
     * @param string|null $message      Message
     * @param mixed  $status Custom Http Status
     * @param array  $errors
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function response($success, array $data = [], $message = null, $status = Response::HTTP_BAD_REQUEST, array $errors = [])
    {
        $status = !empty($status) ? $status : ($success ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        return response()->json([
            'status'  => $status,
            'success' => $success,
            'message' => $message,
            'data'    => $data,
            'errors'  => $errors,
        ], $status);
    }

    /**
     * Response Success
     *
     * @param mixed  $data         Data
     * @param string $message      Message
     * @param mixed  $status Custom Http Status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess(array $data = [], $message = null, $status = Response::HTTP_OK)
    {
        $message = empty($message) ? __('messages.request.request_success') : $message;

        return $this->response(true, $data, $message, $status);
    }

    /**
     * Response Error
     *
     * @param string $message      Message
     * @param mixed  $errors         Errors
     * @param mixed  $status Custom Status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError($message = null, array $errors = [], $status = null)
    {
        $message = empty($message) ? __('exception.bad_request') : $message;

        if ($message instanceof \Exception) {
            $exception = $message;
            $message   = $exception->getMessage();

            // show detail error in json format
            if (config('app.env') != 'production' && config('app.debug')) {
                $errors      = array_merge((array) $errors, [
                    'exception' => [
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'trace'   => explode(PHP_EOL, $exception->getTraceAsString())
                    ],
                ]);
            }
        }

        return $this->response(false, [], $message, $status, $errors);
    }
}
