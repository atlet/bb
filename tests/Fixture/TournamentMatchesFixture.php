<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TournamentMatchesFixture
 */
class TournamentMatchesFixture extends TestFixture
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
                'competitor1_id' => 1,
                'competitor2_id' => 1,
                'winner_id' => 1,
                'round' => 1,
                'round_name' => 'Lorem ipsum dolor sit amet',
                'match_number' => 1,
                'stage' => 'Lorem ipsum dolor ',
                'court_id' => 1,
                'scheduled_at' => '2025-11-07 19:20:34',
                'started_at' => '2025-11-07 19:20:34',
                'finished_at' => '2025-11-07 19:20:34',
                'status' => 'Lorem ipsum dolor ',
                'winner_next_match_id' => 1,
                'winner_next_slot' => 1,
                'loser_next_match_id' => 1,
                'loser_next_slot' => 1,
                'placement_rank_winner' => 1,
                'placement_rank_loser' => 1,
                'current_game' => 1,
                'current_score1' => 1,
                'current_score2' => 1,
                'serving_competitor' => 1,
                'last_point_at' => '2025-11-07 19:20:34',
                'created' => '2025-11-07 19:20:34',
                'modified' => '2025-11-07 19:20:34',
            ],
        ];
        parent::init();
    }
}
