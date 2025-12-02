<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Mantém o factory do usuário como você quer
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Chama os seeders fixos
        $this->call([
            CategorySeeder::class,
            GameSeeder::class,
        ]);
    }
}
