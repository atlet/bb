<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TournamentEvent Entity
 *
 * @property int $id
 * @property int $tournament_id
 * @property string $name
 * @property string|null $code
 * @property string $format
 * @property int $best_of_games
 * @property int $points_per_game
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Tournament $tournament
 * @property \App\Model\Entity\Competitor[] $competitors
 * @property \App\Model\Entity\TournamentMatch[] $tournament_matches
 */
class TournamentEvent extends Entity
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
        'tournament_id' => true,
        'name' => true,
        'code' => true,
        'format' => true,
        'best_of_games' => true,
        'points_per_game' => true,
        'created' => true,
        'modified' => true,
        'tournament' => true,
        'competitors' => true,
        'tournament_matches' => true,
    ];
}
