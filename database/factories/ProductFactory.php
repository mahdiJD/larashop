<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Fruits',
            'Vegetables',
            'Bread',
            'Meat',
        ];
        do{
            $title = substr(fake()->sentence(),20);
        }
        while(!$title);
        return [
            'name' => $title ,
            'slug' => str()->slug($title),
            'file' => fake()->imageUrl($width= 1920 ,$height= 1280),
            'weight' => rand(150,250),
            'description' => fake()->realText(),
            'bio' => fake()->sentence(),
            'price' => rand(3,16),
            'user_id' => rand(5,6),
        ];
    }
}
