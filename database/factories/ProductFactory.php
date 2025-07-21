<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Заполняем поле 'name' случайной строкой, имитирующей название продукта
            'name' => $this->faker->sentence(3), // 3 слова в названии
            // Заполняем поле 'description' случайным текстом, имитирующим описание продукта
            'description' => $this->faker->paragraph(5), // 5 предложений в описании
            // Заполняем поле 'price' случайным числом в диапазоне от 10 до 1000 с двумя знаками после запятой
            'price' => $this->faker->numberBetween(1000, 100000) / 100,
            // Заполняем поле 'category' случайным словом, имитирующим категорию продукта
            'category' => $this->faker->word(),
            // Заполняем поле 'availability' случайным целым числом в диапазоне от 0 до 100, имитирующим количество товара в наличии
            'availability' => $this->faker->numberBetween(0, 100),
        ];
    }
}
