<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class InitialDataSeed extends AbstractSeed
{
    public function run(): void
    {
        // PLAYERS
        $this->table('players')->insert([
            ['first_name' => 'Luka',   'last_name' => 'Novak',  'gender' => 'M', 'rating' => 92.5],
            ['first_name' => 'Marko',  'last_name' => 'Bizjak', 'gender' => 'M', 'rating' => 85.0],
            ['first_name' => 'Ana',    'last_name' => 'Kovač',  'gender' => 'F', 'rating' => 88.0],
            ['first_name' => 'Tine',   'last_name' => 'Horvat', 'gender' => 'M', 'rating' => 80.0],
            ['first_name' => 'Maja',   'last_name' => 'Zupan',  'gender' => 'F', 'rating' => 78.0],
            ['first_name' => 'Sara',   'last_name' => 'Vidmar', 'gender' => 'F', 'rating' => 76.0],
            ['first_name' => 'Jože',   'last_name' => 'Kralj',  'gender' => 'M', 'rating' => 82.0],
            ['first_name' => 'Nejc',   'last_name' => 'Potočnik','gender' => 'M', 'rating' => 79.0],
        ])->saveData();

        // TOURNAMENT
        $this->table('tournaments')->insert([
            [
                'name' => 'Badminton Open DEMO',
                'location' => 'Lokalna dvorana',
                'starts_on' => '2025-11-08',
                'ends_on' => '2025-11-08',
                'status' => 'active',
            ],
        ])->saveData();

        // COURTS (3 igrišča)
        $this->table('courts')->insert([
            ['tournament_id' => 1, 'name' => 'Court 1', 'sort_order' => 1],
            ['tournament_id' => 1, 'name' => 'Court 2', 'sort_order' => 2],
            ['tournament_id' => 1, 'name' => 'Court 3', 'sort_order' => 3],
        ])->saveData();

        // EVENT (dvojice)
        $this->table('tournament_events')->insert([
            [
                'tournament_id' => 1,
                'name' => 'Moške / mešane dvojice DEMO',
                'code' => 'MD/MXD',
                'status' => 'active',
                'best_of_games' => 3,
                'points_per_game' => 21,
            ],
        ])->saveData();

        // COMPETITORS – 4 para iz 8 igralcev
        $this->table('competitors')->insert([
            ['tournament_event_id' => 1, 'name' => 'Novak / Bizjak',   'is_team' => 1, 'seed' => 1],
            ['tournament_event_id' => 1, 'name' => 'Kovač / Horvat',   'is_team' => 1, 'seed' => 2],
            ['tournament_event_id' => 1, 'name' => 'Zupan / Vidmar',   'is_team' => 1, 'seed' => 3],
            ['tournament_event_id' => 1, 'name' => 'Kralj / Potočnik', 'is_team' => 1, 'seed' => 4],
        ])->saveData();

        // COMPETITOR_PLAYERS – povezava parov z igralci
        $this->table('competitor_players')->insert([
            ['competitor_id' => 1, 'player_id' => 1, 'position' => 1],
            ['competitor_id' => 1, 'player_id' => 2, 'position' => 2],

            ['competitor_id' => 2, 'player_id' => 3, 'position' => 1],
            ['competitor_id' => 2, 'player_id' => 4, 'position' => 2],

            ['competitor_id' => 3, 'player_id' => 5, 'position' => 1],
            ['competitor_id' => 3, 'player_id' => 6, 'position' => 2],

            ['competitor_id' => 4, 'player_id' => 7, 'position' => 1],
            ['competitor_id' => 4, 'player_id' => 8, 'position' => 2],
        ])->saveData();

        // nobenih tekem v seed-u – te bodo nastajale dinamično
    }
}
