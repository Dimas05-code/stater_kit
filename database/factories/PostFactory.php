<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // sencetence kalimat acak
        $post = fake()->sentence(rand(6, 8));
        return [
            'tittle' => $post,
            // slug akan mengambil nama yang samma dengan tittle
            'slug' => Str::slug($post),

            // 'author' => fake()->name(),

            // buat data post sekalian data user dibuatkan
            'author_id' => User::factory(),
            'category_id' => Category::factory(),

            'isi' => fake()->text(),
        ];
    }
}
