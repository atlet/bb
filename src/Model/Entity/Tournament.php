<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tournament Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $location
 * @property \Cake\I18n\Date|null $starts_on
 * @property \Cake\I18n\Date|null $ends_on
 * @property string $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Court[] $courts
 * @property \App\Model\Entity\TournamentEvent[] $tournament_events
 */
class Tournament extends Entity
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
        'name' => true,
        'location' => true,
        'starts_on' => true,
        'ends_on' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'courts' => true,
        'tournament_events' => true,
    ];
}
