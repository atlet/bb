<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MatchGamesFixture
 */
class MatchGamesFixture extends TestFixture
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
                'match_id' => 1,
                'sequence' => 1,
                'score1' => 1,
                'score2' => 1,
                'created' => 1762542379,
                'modified' => 1762542379,
            ],
        ];
        parent::init();
    }
}
