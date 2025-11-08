<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Competitor Entity
 *
 * @property int $id
 * @property int $tournament_event_id
 * @property string $name
 * @property bool $is_team
 * @property int|null $seed
 * @property int $wins
 * @property int $losses
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\TournamentEvent $tournament_event
 * @property \App\Model\Entity\CompetitorPlayer[] $competitor_players
 */
class Competitor extends Entity
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
        'name' => true,
        'is_team' => true,
        'seed' => true,
        'wins' => true,
        'losses' => true,
        'created' => true,
        'modified' => true,
        'tournament_event' => true,
        'competitor_players' => true,
    ];
}
