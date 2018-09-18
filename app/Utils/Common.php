<?php

namespace App\Utils;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: Mannyluccio
 * Date: 07/09/2018
 * Time: 12:51
 */

class Common{

    const TIMEZONE = 'Europe/Rome';

    public static function response($status, $data = [], $errors = [], $code = 200, $httpCode = 200)
    {
        if (!is_array($errors)) {
            $errors = [
                'error' => $errors,
            ];
        }
        if ($status == false) {
            $httpCode = $httpCode != 200 ? $httpCode : $code;
        }

        return response()->json([
            'status' => $status,
            'time' => Carbon::now(self::TIMEZONE)->toDateTimeString(),
            'code' => $code,
            'data' => $data,
            'errors' => $errors,
        ], $httpCode);
    }
}