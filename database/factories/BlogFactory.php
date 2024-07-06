<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = substr(fake()->sentence(),20),
            'slug' => str()->slug($title),
            'file' => fake()->imageUrl($width= 1920 ,$height= 1280),
            'short' => fake()->sentence(),
            'body' => fake()->realText(),
            'is_published' => true ,
            'user_id' => rand(5,6),
        ];
    }
}
