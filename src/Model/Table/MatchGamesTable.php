<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MatchGames Model
 *
 * @property \App\Model\Table\MatchesTable&\Cake\ORM\Association\BelongsTo $Matches
 *
 * @method \App\Model\Entity\MatchGame newEmptyEntity()
 * @method \App\Model\Entity\MatchGame newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MatchGame> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MatchGame get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MatchGame findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MatchGame patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MatchGame> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MatchGame|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MatchGame saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MatchGame>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MatchGame>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MatchGame>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MatchGame> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MatchGame>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MatchGame>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MatchGame>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MatchGame> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MatchGamesTable extends Table
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

        $this->setTable('match_games');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Matches', [
            'foreignKey' => 'match_id',
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
            ->notEmptyString('match_id');

        $validator
            ->requirePresence('sequence', 'create')
            ->notEmptyString('sequence');

        $validator
            ->requirePresence('score1', 'create')
            ->notEmptyString('score1');

        $validator
            ->requirePresence('score2', 'create')
            ->notEmptyString('score2');

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
        $rules->add($rules->isUnique(['match_id', 'sequence']), ['errorField' => 'match_id']);
        $rules->add($rules->existsIn(['match_id'], 'Matches'), ['errorField' => 'match_id']);

        return $rules;
    }
}
