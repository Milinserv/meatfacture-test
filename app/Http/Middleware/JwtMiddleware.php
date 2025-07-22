<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Проверка наличие и валидность JWT-токена в каждом входящем запросе
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Попытка аутентифицировать пользователя с помощью JWT
            $user = JWTAuth::parseToken()->authenticate();

            // Если аутентификация не удалась
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

        } catch (Exception $e) {
            // Обработка различных ошибок JWT
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['message' => 'Token is Invalid'], 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['message' => 'Token is Expired'], 401);
            }else{
                return response()->json(['message' => 'Authorization Token not found'], 401);
            }
        }

        return $next($request);
    }
}
