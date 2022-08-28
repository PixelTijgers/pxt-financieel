<?php

namespace Database\Seeders;
// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            [
                'team_one_id' => 3,
                'team_two_id' => 4,
                'field' => 1,
                'game_date' => '2021-09-30 20:00'
            ],
            [
                'team_one_id' => 1,
                'team_two_id' => 2,
                'field' => 2,
                'game_date' => '2021-09-30 20:00'
            ],
            [
                'team_one_id' => 5,
                'team_two_id' => 6,
                'field' => 1,
                'game_date' => '2021-09-30 21:00'
            ],
        ];

        foreach($games as $game)
            Game::create($game);
    }
}
