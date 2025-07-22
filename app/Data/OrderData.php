<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class OrderData extends Data
{
    public function __construct(
        public string $user_id,
        public array $list_products,
        public string|Optional|null $comment = null,
    ) {}

    public static function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'list_products' => ['required'],
            'list_products.product_id' => ['required', 'string', 'exists:products,id'],
            'list_products.availability' => ['required', 'string', 'min:1'],
            'comment' => ['nullable', 'string', 'max:500'],
        ];
    }

    public static function messages(): array
    {
        return [
            'user_id.required' => 'ID пользователя обязателен для заполнения.',
            'user_id.integer' => 'ID пользователя должен быть целым числом.',
            'user_id.exists' => 'Указанный ID пользователя не существует.',
            'list_products.*.required' => 'Список продуктов обязателен для заполнения.',
            'list_products.*.array' => 'Список продуктов должен быть массивом.',
            'list_products.*.product_id.required' => 'ID продукта обязателен для заполнения в каждом товаре.',
            'list_products.*.product_id.integer' => 'ID продукта должен быть целым числом.',
            'list_products.*.product_id.exists' => 'Указанный ID продукта не существует.',
            'list_products.*.availability.required' => 'Количество товара обязательно для заполнения.',
            'list_products.*.availability.integer' => 'Количество товара должно быть целым числом.',
            'list_products.*.availability.min' => 'Количество товара не может быть меньше 1.',
            'comment.string' => 'Комментарий должен быть строкой.',
            'comment.max' => 'Комментарий не должен превышать 500 символов.',
        ];
    }
}
