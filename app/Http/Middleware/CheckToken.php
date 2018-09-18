<?php
/**
 * Created by PhpStorm.
 * User: Mannyluccio
 * Date: 17/09/2018
 * Time: 10:38
 */

namespace App\Http\Middleware;


use App\Utils\Common;
use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class CheckToken extends BaseMiddleware
{


    public function handle($request, Closure $next)
    {

        if (!$token = $request->bearerToken()) {
            return Common::response(false, '', 'Token not provided', 400);
        }




        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return Common::response(false, '', 'Token expired', 401);
        }

        return $next($request);
    }

}