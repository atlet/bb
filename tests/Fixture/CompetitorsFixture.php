<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompetitorsFixture
 */
class CompetitorsFixture extends TestFixture
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
                'tournament_event_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'is_team' => 1,
                'seed' => 1,
                'wins' => 1,
                'losses' => 1,
                'created' => '2025-11-08 21:42:52',
                'modified' => '2025-11-08 21:42:52',
            ],
        ];
        parent::init();
    }
}
