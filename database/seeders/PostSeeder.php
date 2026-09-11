<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Идемпотентно: если посты уже есть (например, контейнер перезапустился
     * без пересоздания БД), ничего не делает — это нужно, потому что
     * migrate --seed --force гоняется при каждом старте на Render.
     */
    public function run(): void
    {
        if (Post::query()->exists()) {
            return;
        }

        $author = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo Author',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        Post::factory()
            ->for($author)
            ->count(12)
            ->create();

        Post::factory()
            ->for($author)
            ->draft()
            ->count(3)
            ->create();
    }
}
