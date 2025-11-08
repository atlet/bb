<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompetitorPlayersFixture
 */
class CompetitorPlayersFixture extends TestFixture
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
                'competitor_id' => 1,
                'player_id' => 1,
                'position' => 1,
                'created' => '2025-11-07 19:26:12',
                'modified' => '2025-11-07 19:26:12',
            ],
        ];
        parent::init();
    }
}
