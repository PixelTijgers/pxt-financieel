<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'season_id'     => 1,
                'name'          => 'Drankenhandel \'t Sas',
            ],
            [
                'season_id'     => 1,
                'name'          => 'Geen punt, komt goed',
            ],
            [
                'season_id'     => 1,
                'name'          => 'De Zwabberteuten',
            ],
            [
                'season_id'     => 1,
                'name'          => 'De Waterneuzen',
            ],
            [
                'season_id'     => 1,
                'name'          => '100% Sas',
            ],
            [
                'season_id'     => 1,
                'name'          => 'CHEV',
            ],
            [
                'season_id'     => 1,
                'name'          => 'Nederdesign',
            ],
            [
                'season_id'     => 2,
                'name'          => 'Drankenhandel \'t Sas',
            ],
            [
                'season_id'     => 2,
                'name'          => 'Geen punt, komt goed',
            ],
            [
                'season_id'     => 2,
                'name'          => 'De Zwabberteuten',
            ],
            [
                'season_id'     => 2,
                'name'          => 'De Waterneuzen',
            ],
            [
                'season_id'     => 2,
                'name'          => '100% Sas',
            ],
            [
                'season_id'     => 2,
                'name'          => 'CHEV',
            ],
            [
                'season_id'     => 2,
                'name'          => 'Samengeraapt Z',
            ],
        ];

        foreach($teams as $team)
            Team::create($team);
    }
}
