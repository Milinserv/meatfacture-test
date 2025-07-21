<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public string $price,
        public string $category,
        public int $availability,
    ) {}

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string', 'regex:/^\d+(\.\d{1,2})?$/'],
            'category' => ['required', 'string', 'max:100'],
            'availability' => ['required', 'integer', 'min:0', 'max:1000'],
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'Название продукта обязательно для заполнения.',
            'name.string' => 'Название продукта должно быть строкой.',
            'name.max' => 'Название продукта не должно превышать 255 символов.',
            'description.required' => 'Описание продукта обязательно для заполнения.',
            'description.string' => 'Описание продукта должно быть строкой.',
            'price.required' => 'Цена продукта обязательна для заполнения.',
            'price.string' => 'Цена продукта должна быть строкой.',
            'price.regex' => 'Неверный формат цены. Используйте формат, например, 100.00',
            'category.required' => 'Категория продукта обязательна для заполнения.',
            'category.string' => 'Категория продукта должна быть строкой.',
            'category.max' => 'Категория продукта не должна превышать 100 символов.',
            'availability.required' => 'Наличие на складе обязательно для заполнения.',
            'availability.integer' => 'Наличие на складе должно быть целым числом.',
            'availability.min' => 'Наличие на складе не может быть меньше 0.',
            'availability.max' => 'Наличие на складе не может быть больше 1000.',
        ];
    }
}
