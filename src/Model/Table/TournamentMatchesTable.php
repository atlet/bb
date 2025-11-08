<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\FactoryLocator;

/**
 * TournamentMatches Model
 *
 * @property \App\Model\Table\TournamentEventsTable&\Cake\ORM\Association\BelongsTo $TournamentEvents
 * @property \App\Model\Table\CompetitorsTable&\Cake\ORM\Association\BelongsTo $Competitor1s
 * @property \App\Model\Table\CompetitorsTable&\Cake\ORM\Association\BelongsTo $Competitor2s
 * @property \App\Model\Table\CompetitorsTable&\Cake\ORM\Association\BelongsTo $Winners
 * @property \App\Model\Table\CourtsTable&\Cake\ORM\Association\BelongsTo $Courts
 * @property \App\Model\Table\MatchGamesTable&\Cake\ORM\Association\HasMany $MatchGames
 *
 * @method \App\Model\Entity\TournamentMatch newEmptyEntity()
 * @method \App\Model\Entity\TournamentMatch newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TournamentMatch> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TournamentMatch get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TournamentMatch findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TournamentMatch patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TournamentMatch> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TournamentMatch|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TournamentMatch saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentMatch>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentMatch>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentMatch>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentMatch> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentMatch>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentMatch>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TournamentMatch>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TournamentMatch> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TournamentMatchesTable extends Table {
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('tournament_matches');
        $this->setDisplayField('stage');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TournamentEvents', [
            'foreignKey' => 'tournament_event_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Competitor1s', [
            'foreignKey' => 'competitor1_id',
            'className' => 'Competitors',
        ]);
        $this->belongsTo('Competitor2s', [
            'foreignKey' => 'competitor2_id',
            'className' => 'Competitors',
        ]);
        $this->belongsTo('Winners', [
            'foreignKey' => 'winner_id',
            'className' => 'Competitors',
        ]);
        $this->belongsTo('Courts', [
            'foreignKey' => 'court_id',
        ]);
        $this->hasMany('MatchGames', [
            'foreignKey' => 'tournament_match_id',
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
            ->notEmptyString('tournament_event_id');

        $validator
            ->allowEmptyString('competitor1_id');

        $validator
            ->allowEmptyString('competitor2_id');

        $validator
            ->allowEmptyString('winner_id');

        $validator
            ->allowEmptyString('round');

        $validator
            ->scalar('round_name')
            ->maxLength('round_name', 50)
            ->allowEmptyString('round_name');

        $validator
            ->integer('match_number')
            ->allowEmptyString('match_number');

        $validator
            ->scalar('stage')
            ->maxLength('stage', 20)
            ->notEmptyString('stage');

        $validator
            ->allowEmptyString('court_id');

        $validator
            ->dateTime('scheduled_at')
            ->allowEmptyDateTime('scheduled_at');

        $validator
            ->dateTime('started_at')
            ->allowEmptyDateTime('started_at');

        $validator
            ->dateTime('finished_at')
            ->allowEmptyDateTime('finished_at');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->notEmptyString('status');

        $validator
            ->allowEmptyString('winner_next_match_id');

        $validator
            ->allowEmptyString('winner_next_slot');

        $validator
            ->allowEmptyString('loser_next_slot');

        $validator
            ->integer('placement_rank_winner')
            ->allowEmptyString('placement_rank_winner');

        $validator
            ->integer('placement_rank_loser')
            ->allowEmptyString('placement_rank_loser');

        $validator
            ->notEmptyString('current_game');

        $validator
            ->notEmptyString('current_score1');

        $validator
            ->notEmptyString('current_score2');

        $validator
            ->allowEmptyString('serving_competitor');

        $validator
            ->dateTime('last_point_at')
            ->allowEmptyDateTime('last_point_at');

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
        $rules->add($rules->existsIn(['competitor1_id'], 'Competitor1s'), ['errorField' => 'competitor1_id']);
        $rules->add($rules->existsIn(['competitor2_id'], 'Competitor2s'), ['errorField' => 'competitor2_id']);
        $rules->add($rules->existsIn(['winner_id'], 'Winners'), ['errorField' => 'winner_id']);
        $rules->add($rules->existsIn(['court_id'], 'Courts'), ['errorField' => 'court_id']);

        return $rules;
    }

    /**
     * Ponovno izračuna wins/losses za vse competitorje v eventu
     * na podlagi VSEH zaključenih tekem (status='finished').
     */
    public function recalculateStatsForEvent(int $eventId): void {
        $competitorsTable = FactoryLocator::get('Table')->get('Competitors');

        // 1) preberi vse tekmovalce
        $competitors = $competitorsTable->find()
            ->where(['tournament_event_id' => $eventId])
            ->all()
            ->toList();

        // 2) stat slovar
        $stats = [];
        foreach ($competitors as $c) {
            $stats[$c->id] = ['wins' => 0, 'losses' => 0];
        }

        // 3) vse končane tekme
        $matches = $this->find()
            ->where([
                'tournament_event_id' => $eventId,
                'status' => 'finished',
            ])
            ->all();

        foreach ($matches as $m) {
            if (
                $m->competitor1_id === null ||
                $m->competitor2_id === null ||
                $m->current_score1 === null ||
                $m->current_score2 === null ||
                $m->current_score1 === $m->current_score2
            ) {
                continue;
            }

            if ($m->current_score1 > $m->current_score2) {
                $winnerId = $m->competitor1_id;
                $loserId  = $m->competitor2_id;
            } else {
                $winnerId = $m->competitor2_id;
                $loserId  = $m->competitor1_id;
            }

            if (isset($stats[$winnerId])) {
                $stats[$winnerId]['wins']++;
            }
            if (isset($stats[$loserId])) {
                $stats[$loserId]['losses']++;
            }
        }

        // 4) zapiši nazaj
        foreach ($competitors as $c) {
            $c->wins   = $stats[$c->id]['wins']   ?? 0;
            $c->losses = $stats[$c->id]['losses'] ?? 0;
            $competitorsTable->saveOrFail($c);
        }
    }
}
