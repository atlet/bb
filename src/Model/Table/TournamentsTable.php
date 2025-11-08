<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tournaments Model
 *
 * @property \App\Model\Table\CourtsTable&\Cake\ORM\Association\HasMany $Courts
 * @property \App\Model\Table\TournamentEventsTable&\Cake\ORM\Association\HasMany $TournamentEvents
 *
 * @method \App\Model\Entity\Tournament newEmptyEntity()
 * @method \App\Model\Entity\Tournament newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tournament> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tournament get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tournament findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tournament patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tournament> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tournament|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tournament saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tournament>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tournament>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tournament>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tournament> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tournament>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tournament>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tournament>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tournament> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TournamentsTable extends Table {
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('tournaments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Courts', [
            'foreignKey' => 'tournament_id',
        ]);
        $this->hasMany('TournamentEvents', [
            'foreignKey' => 'tournament_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->allowEmptyString('location');

        $validator
            ->date('starts_on')
            ->allowEmptyDate('starts_on');

        $validator
            ->date('ends_on')
            ->allowEmptyDate('ends_on');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->notEmptyString('status');

        return $validator;
    }
}
