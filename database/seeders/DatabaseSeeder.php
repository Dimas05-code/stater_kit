<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Kalau Ini Data Masih Dibuat Otomatis Oleh Tinker
        // Post::factory(100)->recycle([User::factory(5)->create(), Category::factory(3)->create()])->create();

        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            PostSeeder::class,
        ]);

        // Post::factory(100)->recycle([Category::all(), User::factory(3)->create()])->create();
    }
}
