<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Competitors Model
 *
 * @property \App\Model\Table\TournamentEventsTable&\Cake\ORM\Association\BelongsTo $TournamentEvents
 * @property \App\Model\Table\CompetitorPlayersTable&\Cake\ORM\Association\HasMany $CompetitorPlayers
 *
 * @method \App\Model\Entity\Competitor newEmptyEntity()
 * @method \App\Model\Entity\Competitor newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Competitor> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Competitor get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Competitor findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Competitor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Competitor> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Competitor|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Competitor saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Competitor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Competitor>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Competitor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Competitor> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Competitor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Competitor>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Competitor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Competitor> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompetitorsTable extends Table {
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('competitors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TournamentEvents', [
            'foreignKey' => 'tournament_event_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('CompetitorPlayers', [
            'foreignKey' => 'competitor_id',
        ]);       
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {
        $validator
            ->integer('tournament_event_id')
            ->notEmptyString('tournament_event_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->boolean('is_team')
            ->notEmptyString('is_team');

        $validator
            ->integer('seed')
            ->allowEmptyString('seed');

        $validator
            ->integer('wins')
            ->notEmptyString('wins');

        $validator
            ->integer('losses')
            ->notEmptyString('losses');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {
        $rules->add($rules->existsIn(['tournament_event_id'], 'TournamentEvents'), ['errorField' => 'tournament_event_id']);

        return $rules;
    }

    public function getCompetitorsForEvent(int $tournamentEventId): SelectQuery {
        return $this->find('list')
            ->where(['tournament_event_id' => $tournamentEventId])
            ->orderByAsc('seed');
    }
}
