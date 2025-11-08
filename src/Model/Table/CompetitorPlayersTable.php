<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompetitorPlayers Model
 *
 * @property \App\Model\Table\CompetitorsTable&\Cake\ORM\Association\BelongsTo $Competitors
 * @property \App\Model\Table\PlayersTable&\Cake\ORM\Association\BelongsTo $Players
 *
 * @method \App\Model\Entity\CompetitorPlayer newEmptyEntity()
 * @method \App\Model\Entity\CompetitorPlayer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CompetitorPlayer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompetitorPlayer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CompetitorPlayer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CompetitorPlayer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CompetitorPlayer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitorPlayer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CompetitorPlayer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CompetitorPlayer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CompetitorPlayer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CompetitorPlayer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CompetitorPlayer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CompetitorPlayer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CompetitorPlayer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CompetitorPlayer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CompetitorPlayer> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompetitorPlayersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('competitor_players');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Competitors', [
            'foreignKey' => 'competitor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Players', [
            'foreignKey' => 'player_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('competitor_id');

        $validator
            ->notEmptyString('player_id');

        $validator
            ->notEmptyString('position');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['competitor_id', 'player_id']), ['errorField' => 'competitor_id']);
        $rules->add($rules->isUnique(['competitor_id', 'position']), ['errorField' => 'competitor_id']);
        $rules->add($rules->existsIn(['competitor_id'], 'Competitors'), ['errorField' => 'competitor_id']);
        $rules->add($rules->existsIn(['player_id'], 'Players'), ['errorField' => 'player_id']);

        return $rules;
    }
}
