<?php
namespace App\Helpers;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class Response
{
    /**
     * Формирует JSON-ответ с JWT-токеном.
     *
     * @param bool|string $token JWT-токен или false в случае неудачи.
     * @param mixed|null $data Данные для включения в ответ. Может быть массивом или объектом.
     * @param int $statusCode HTTP-код статуса ответа.
     *
     * @return JsonResponse
     */
    public static function respondWithToken(bool|string $token, mixed $data = null, int $statusCode = 200): JsonResponse
    {
        if ($token !== false) {
            $response = [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            ];

            // Если есть дополнительные данные, добавляем их в корень ответа.
            if ($data) {
                if (is_array($data)) {
                    $response = array_merge($response, $data); // Объединяем массивы
                } else {
                    $response['data'] = $data; // Добавляем объект под ключом 'data'
                }
            }

            return response()->json(['res' => $response, 'status_code' => $statusCode]);
        } else {
            // Обработка случая, когда токен не был получен
            return response()->json(['error' => 'Ошибка аутентификации или регистрации', $data, 'status_code' => 401]);
        }
    }

    /**
     * Формирует JSON-ответ без JWT-токена.
     *
     * @param mixed|null $data Данные для включения в ответ.
     * @param int $statusCode HTTP-код статуса ответа.
     *
     * @return JsonResponse
     */
    public static function respond(mixed $data = null, int $statusCode = 200): JsonResponse
    {
        if ($data !== null) {
            $response = ['data' => $data];

            return response()->json(['res' => $response, 'status_code' => $statusCode]);
        } else {
            $response = ['error' => $data];

            return response()->json(['res' => $response, 'status_code' => 500]);
        }
    }
}
