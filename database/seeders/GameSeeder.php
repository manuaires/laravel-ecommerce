<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        Game::insert([
            [
                'name' => 'The Witcher 3: Wild Hunt',
                'description' => 'Um RPG de mundo aberto com uma narrativa profunda.',
                'price' => 199.90,
                'release_date' => '2015-05-19',
                'image' => 'witcher3.jpg',
                'category_id' => 3
            ],
            [
                'name' => 'GTA V',
                'description' => 'Ação e mundo aberto com múltiplos protagonistas.',
                'price' => 249.90,
                'release_date' => '2013-09-17',
                'image' => 'gtav.jpg',
                'category_id' => 1
            ],
            [
                'name' => 'FIFA 24',
                'description' => 'O mais recente jogo de futebol com gráficos realistas.',
                'price' => 299.90,
                'release_date' => '2023-09-29',
                'image' => 'fifa24.jpg',
                'category_id' => 4
            ],
            [
                'name' => 'Forza Horizon 5',
                'description' => 'Jogo de corrida em mundo aberto no México.',
                'price' => 349.90,
                'release_date' => '2021-11-09',
                'image' => 'forzah5.jpg',
                'category_id' => 5
            ],
            [
                'name' => 'Resident Evil Village',
                'description' => 'Terror e sobrevivência em primeira pessoa.',
                'price' => 239.90,
                'release_date' => '2021-05-07',
                'image' => 'revillage.jpg',
                'category_id' => 9
            ],
            [
                'name' => 'Minecraft',
                'description' => 'Jogo de simulação e sobrevivência em mundos aleatórios.',
                'price' => 129.90,
                'release_date' => '2011-11-18',
                'image' => 'minecraft.jpg',
                'category_id' => 7
            ],
            [
                'name' => 'Fortnite',
                'description' => 'Battle Royale popular com construção e ação intensa.',
                'price' => 0,
                'release_date' => '2017-07-21',
                'image' => 'fortnite.jpg',
                'category_id' => 1
            ],
            [
                'name' => 'League of Legends',
                'description' => 'MOBA competitivo com dezenas de campeões.',
                'price' => 0,
                'release_date' => '2009-10-27',
                'image' => 'lol.jpg',
                'category_id' => 8
            ],
            [
                'name' => 'Dark Souls III',
                'description' => 'RPG de ação desafiador com combates intensos.',
                'price' => 199.90,
                'release_date' => '2016-04-12',
                'image' => 'darksouls3.jpg',
                'category_id' => 3
            ],
            [
                'name' => 'Super Mario Odyssey',
                'description' => 'Plataforma em 3D com mundos vibrantes e criativos.',
                'price' => 299.90,
                'release_date' => '2017-10-27',
                'image' => 'marioodyssey.jpg',
                'category_id' => 10
            ],
            [
                'name' => 'Call of Duty: Modern Warfare II',
                'description' => 'FPS tático com multiplayer frenético.',
                'price' => 349.90,
                'release_date' => '2022-10-28',
                'image' => 'codmw2.jpg',
                'category_id' => 6
            ],
            [
                'name' => 'Zelda: Breath of the Wild',
                'description' => 'Aventura épica em um vasto mundo aberto.',
                'price' => 299.90,
                'release_date' => '2017-03-03',
                'image' => 'zelda_botw.jpg',
                'category_id' => 2
            ],
        ]);
    }
}
