<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Ação', 'slug' => 'acao'],
            ['name' => 'Aventura', 'slug' => 'aventura'],
            ['name' => 'RPG', 'slug' => 'rpg'],
            ['name' => 'Esportes', 'slug' => 'esportes'],
            ['name' => 'Corrida', 'slug' => 'corrida'],
            ['name' => 'Tiro', 'slug' => 'tiro'],
            ['name' => 'Simulação', 'slug' => 'simulacao'],
            ['name' => 'Estratégia', 'slug' => 'estrategia'],
            ['name' => 'Terror', 'slug' => 'terror'],
            ['name' => 'Plataforma', 'slug' => 'plataforma'],
        ]);
    }
}
