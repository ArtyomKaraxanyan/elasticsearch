<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Article::factory(50)->create();
        $user=User::where('email','test@example.com')->first();

        if (!$user){
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'test',
            ]);
        }

    }
}
