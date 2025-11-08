<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TournamentEventsFixture
 */
class TournamentEventsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'tournament_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'code' => 'Lorem ipsum dolor ',
                'format' => 'Lorem ipsum dolor sit amet',
                'best_of_games' => 1,
                'points_per_game' => 1,
                'created' => '2025-11-07 19:20:28',
                'modified' => '2025-11-07 19:20:28',
            ],
        ];
        parent::init();
    }
}
