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
        // User::factory(10)->create();

        // Create Admin
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('111'),
            'role' => 'admin',
        ]);

        // Create Rooms a1 to a30
        for ($i = 1; $i <= 30; $i++) {
            \App\Models\Room::create([
                'name' => 'a' . $i,
                'price' => 2500,
            ]);
        }
    }
}
