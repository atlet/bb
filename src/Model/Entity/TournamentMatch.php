<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TournamentMatch Entity
 *
 * @property int $id
 * @property int $tournament_event_id
 * @property int|null $competitor1_id
 * @property int|null $competitor2_id
 * @property int|null $winner_id
 * @property int|null $round
 * @property string|null $round_name
 * @property int|null $match_number
 * @property string $stage
 * @property int|null $court_id
 * @property \Cake\I18n\DateTime|null $scheduled_at
 * @property \Cake\I18n\DateTime|null $started_at
 * @property \Cake\I18n\DateTime|null $finished_at
 * @property string $status
 * @property int|null $winner_next_slot
 * @property int|null $loser_next_slot
 * @property int|null $placement_rank_winner
 * @property int|null $placement_rank_loser
 * @property int $current_game
 * @property int $current_score1
 * @property int $current_score2
 * @property int|null $serving_competitor
 * @property \Cake\I18n\DateTime|null $last_point_at
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\TournamentEvent $tournament_event
 * @property \App\Model\Entity\Competitor $competitor1
 * @property \App\Model\Entity\Competitor $competitor2
 * @property \App\Model\Entity\Competitor $winner
 * @property \App\Model\Entity\Court $court
 * @property \App\Model\Entity\WinnerNextMatch $winner_next_match
 * @property \App\Model\Entity\LoserNextMatch $loser_next_match
 * @property \App\Model\Entity\MatchGame[] $match_games
 */
class TournamentMatch extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'tournament_event_id' => true,
        'competitor1_id' => true,
        'competitor2_id' => true,
        'winner_id' => true,
        'round' => true,
        'round_name' => true,
        'match_number' => true,
        'stage' => true,
        'court_id' => true,
        'scheduled_at' => true,
        'started_at' => true,
        'finished_at' => true,
        'status' => true,
        'winner_next_slot' => true,
        'loser_next_slot' => true,
        'placement_rank_winner' => true,
        'placement_rank_loser' => true,
        'current_game' => true,
        'current_score1' => true,
        'current_score2' => true,
        'serving_competitor' => true,
        'last_point_at' => true,
        'created' => true,
        'modified' => true,
        'tournament_event' => true,
        'competitor1' => true,
        'competitor2' => true,
        'winner' => true,
        'court' => true,
        'winner_next_match' => true,
        'loser_next_match' => true,
        'match_games' => true,
    ];
}
