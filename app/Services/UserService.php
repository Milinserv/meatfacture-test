<?php
namespace App\Services;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService extends Service
{
    public static function create(UserData $data): string|array
    {
        try {
            // Создаем массив данных пользователя, исключая пароль.
            $userData = $data->toArray();

            // Хешируем пароль, используя bcrypt.
            $userData['password'] = Hash::make($userData['password']);

            // Создаем пользователя в базе данных.
            $user = User::create($userData);

            // Генерируем JWT токен для созданного пользователя.
            $token = JWTAuth::fromUser($user);

            // Возвращаем пользователя и токен в виде массива.
            return [
                'user' => $user,
                'token' => $token
            ];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function auth(UserData $data)
    {
        // Получаем phone и пароль из объекта $data
        $credentials = [
            'phone' => $data->phone,
            'password' => $data->password,
        ];

        return JWTAuth::attempt($credentials);
    }
}
