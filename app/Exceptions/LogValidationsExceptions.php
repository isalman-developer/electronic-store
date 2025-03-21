<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Throwable;

class LogValidationsExceptions
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * log an exception into an HTTP response.
     */
    public function logErrors($request, $errors)
    {
        Log::channel('validation')->info('URL ' . $request->method() . ' => '.$request->url());
        Log::channel('validation')->info('User ID ',  [request()->user()->id ?? 'Guest']);
        Log::channel('validation')->info('Validation Errors ');
        Log::channel('validation')->info($errors);
        Log::channel('validation')->info('Submitted Data ');
        Log::channel('validation')->info(json_encode($this->filterSensitiveData($request->all())));
    }

    /**
     * Filter sensitive data before logging
     */
    private function filterSensitiveData(array $data): array
    {
        $sensitiveFields = ['password', 'password_confirmation', 'credit_card', 'ssn'];

        foreach ($sensitiveFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = '********';
            }
        }

        return $data;
    }
}
