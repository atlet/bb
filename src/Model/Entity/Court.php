<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Court Entity
 *
 * @property int $id
 * @property int $tournament_id
 * @property string $name
 * @property int $sort_order
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Tournament $tournament
 * @property \App\Model\Entity\TournamentMatch[] $tournament_matches
 */
class Court extends Entity
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
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'tournament' => true,
        'tournament_matches' => true,
    ];
}
