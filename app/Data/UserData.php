<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $password,
        public string $address,
    ) {}

    public static function rules(): array
    {
        return [
            'name' => ['required'],
            'phone' => ['required', 'string', 'regex:/^\\+?[1-9]\\d{1,14}$/'],
            'address' => ['required', 'string', 'min:10'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'Имя обязателен для заполнения.',
            'phone.required' => 'Телефон обязателен для заполнения.',
            'phone.string' => 'Телефон должен быть строкой.',
            'phone.regex' => 'Неверный формат телефона.',
            'address.required' => 'Адрес обязателен для заполнения.',
            'address.string' => 'Адрес должен быть строкой.',
            'address.min' => 'Адрес должен содержать не менее 10 символов.',
            'password.required' => 'Пароль обязателен для заполнения.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
        ];
    }
}
