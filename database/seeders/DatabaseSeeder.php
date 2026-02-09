<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@desawisata.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);

        // Seed other data
        $this->call([
            ProductSeeder::class,
            ArticleSeeder::class,
            EventSeeder::class,
        ]);
    }
}
