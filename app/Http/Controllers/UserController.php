<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Helpers\Response;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /**
     * Регистрация пользователя и выдача JWT токена.
     *
     * @param  UserData  $data
     * @return JsonResponse
     */
    public function register(UserData $data): JsonResponse
    {
        $service = UserService::create($data);
        try {
            $user = $service['user'];
            $token = $service['token'];

            return Response::respondWithToken($token, $user);
        } catch (\Throwable $th) {
            return Response::respondWithToken(false , $service);
        }
    }
    /**
     * Аутентификация пользователя и выдача JWT токена.
     *
     * @param  UserData  $data
     * @return JsonResponse
     */
    public function login(UserData $data): JsonResponse
    {
        $token = UserService::auth($data);

        return Response::respondWithToken($token);
    }

    /**
     * Выход пользователя (invalidate токен).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Успешно вышли из системы']);
    }
}
