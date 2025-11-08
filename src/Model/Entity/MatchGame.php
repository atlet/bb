<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MatchGame Entity
 *
 * @property int $id
 * @property int $match_id
 * @property int $sequence
 * @property int $score1
 * @property int $score2
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Match $match
 */
class MatchGame extends Entity
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
        'match_id' => true,
        'sequence' => true,
        'score1' => true,
        'score2' => true,
        'created' => true,
        'modified' => true,
        'match' => true,
    ];
}
