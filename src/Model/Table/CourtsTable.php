<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courts Model
 *
 * @property \App\Model\Table\TournamentsTable&\Cake\ORM\Association\BelongsTo $Tournaments
 * @property \App\Model\Table\TournamentMatchesTable&\Cake\ORM\Association\HasMany $TournamentMatches
 *
 * @method \App\Model\Entity\Court newEmptyEntity()
 * @method \App\Model\Entity\Court newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Court> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Court get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Court findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Court patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Court> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Court|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Court saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Court>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Court>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Court>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Court> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Court>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Court>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Court>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Court> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourtsTable extends Table {
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('courts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tournaments', [
            'foreignKey' => 'tournament_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('TournamentMatches', [
            'foreignKey' => 'court_id',
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
            ->integer('tournament_id')
            ->notEmptyString('tournament_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('sort_order')
            ->notEmptyString('sort_order');

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

    public function getCourtsForTournament(int $tournamentId): SelectQuery {
        return $this->find('list')
            ->where(['tournament_id' => $tournamentId])
            ->orderByAsc('sort_order');
    }
}
