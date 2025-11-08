<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TournamentEvents Model
 *
 * @property \App\Model\Table\TournamentsTable&\Cake\ORM\Association\BelongsTo $Tournaments
 * @property \App\Model\Table\CompetitorsTable&\Cake\ORM\Association\HasMany $Competitors
 * @property \App\Model\Table\TournamentMatchesTable&\Cake\ORM\Association\HasMany $TournamentMatches
 *
 * @method \App\Model\Entity\TournamentEvent newEmptyEntity()
 * @method \App\Model\Entity\TournamentEvent newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TournamentEvent> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TournamentEvent get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TournamentEvent findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TournamentEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TournamentEvent> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TournamentEvent|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TournamentEvent saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentEvent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentEvent>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentEvent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentEvent> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentEvent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentEvent>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentEvent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentEvent> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TournamentEventsTable extends Table {
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('tournament_events');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tournaments', [
            'foreignKey' => 'tournament_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Competitors', [
            'foreignKey' => 'tournament_event_id',
        ]);
        $this->hasMany('TournamentMatches', [
            'foreignKey' => 'tournament_event_id',
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
            ->notEmptyString('tournament_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('code')
            ->maxLength('code', 20)
            ->allowEmptyString('code');

        $validator
            ->scalar('format')
            ->maxLength('format', 30)
            ->notEmptyString('format');

        $validator
            ->notEmptyString('best_of_games');

        $validator
            ->notEmptyString('points_per_game');

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
        $rules->add($rules->existsIn(['tournament_id'], 'Tournaments'), ['errorField' => 'tournament_id']);

        return $rules;
    }
}
