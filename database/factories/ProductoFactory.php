<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=> $this->faker->unique()->sentence(),
            'descripcion' => $this->faker->text(),
            'url' => $this->faker->imageUrl($width = 640, $height = 480,),
            'precio' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100)
        ];
    }
}
