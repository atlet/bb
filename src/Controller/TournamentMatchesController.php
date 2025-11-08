<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\BracketService;
use Cake\I18n\FrozenTime;

/**
 * TournamentMatches Controller
 *
 * @property \App\Model\Table\TournamentMatchesTable $TournamentMatches
 */
class TournamentMatchesController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $query = $this->TournamentMatches->find()
            ->contain(['TournamentEvents', 'Competitor1s', 'Competitor2s', 'Courts']);
        $tournamentMatches = $this->paginate($query);

        $this->set(compact('tournamentMatches'));
    }

    /**
     * View method
     *
     * @param string|null $id Tournament Match id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $tournamentMatch = $this->TournamentMatches->get($id, contain: ['TournamentEvents', 'Competitor1s', 'Competitor2s', 'Winners', 'Courts']) ;
        $this->set(compact('tournamentMatch'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $tournamentMatch = $this->TournamentMatches->newEmptyEntity();
        if ($this->request->is('post')) {
            $tournamentMatch = $this->TournamentMatches->patchEntity($tournamentMatch, $this->request->getData());
            if ($this->TournamentMatches->save($tournamentMatch)) {
                $this->Flash->success(__('The tournament match has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tournament match could not be saved. Please, try again.'));
        }
        $tournamentEvents = $this->TournamentMatches->TournamentEvents->find('list', limit: 200)->all();
        $competitors = $this->TournamentMatches->Competitor1s->find('list', limit: 200)->all();
        $winners = $this->TournamentMatches->Winners->find('list', limit: 200)->all();
        $courts = $this->TournamentMatches->Courts->find('list', limit: 200)->all();
        $this->set(compact('tournamentMatch', 'tournamentEvents', 'competitors', 'winners', 'courts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tournament Match id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $tournamentMatch = $this->TournamentMatches->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tournamentMatch = $this->TournamentMatches->patchEntity($tournamentMatch, $this->request->getData());
            if ($this->TournamentMatches->save($tournamentMatch)) {
                $this->Flash->success(__('The tournament match has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tournament match could not be saved. Please, try again.'));
        }
        $tournamentEvents = $this->TournamentMatches->TournamentEvents->find('list', limit: 200)->all();
        $competitors = $this->TournamentMatches->Competitor1s->find('list', limit: 200)->all();
        $winners = $this->TournamentMatches->Winners->find('list', limit: 200)->all();
        $courts = $this->TournamentMatches->Courts->find('list', limit: 200)->all();
        $this->set(compact('tournamentMatch', 'tournamentEvents', 'competitors', 'winners', 'courts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tournament Match id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $tournamentMatch = $this->TournamentMatches->get($id);
        if ($this->TournamentMatches->delete($tournamentMatch)) {
            $this->Flash->success(__('The tournament match has been deleted.'));
        } else {
            $this->Flash->error(__('The tournament match could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Vnos rezultata in zaključek tekme.
     * current_score1/current_score2 = število dobljenih setov (2:0, 2:1, ...).
     */
    public function finish($id = null) {
        $match = $this->TournamentMatches->get($id, [
            'contain' => ['Competitor1s', 'Competitor2s', 'TournamentEvents'],
        ]);

        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->getData();

            $match->current_score1 = (int)($data['current_score1'] ?? 0);
            $match->current_score2 = (int)($data['current_score2'] ?? 0);

            if ($match->current_score1 === $match->current_score2) {
                $this->Flash->error('Rezultat ne sme biti izenačen (nekdo mora zmagati 2:0 ali 2:1).');
                return $this->redirect($this->referer());
            }

            if ($match->competitor1_id === null || $match->competitor2_id === null) {
                $this->Flash->error('Tekma nima nastavljenih obeh tekmovalcev.');
                return $this->redirect($this->referer());
            }

            if ($match->current_score1 > $match->current_score2) {
                $winnerId = $match->competitor1_id;
            } else {
                $winnerId = $match->competitor2_id;
            }

            $match->winner_id   = $winnerId;
            $match->status      = 'finished';
            $match->finished_at = FrozenTime::now();

            if ($this->TournamentMatches->save($match)) {
                $eventId = $match->tournament_event_id;

                // ponovno izračunaj wins/losses za cel event
                $this->TournamentMatches->recalculateStatsForEvent($eventId);

                // preveri, če je event končan
                $this->_checkAndMarkEventFinished($eventId);

                $this->Flash->success('Rezultat shranjen in statistika posodobljena.');
                return $this->redirect([
                    'controller' => 'TournamentEvents',
                    'action' => 'control',
                    $eventId,
                ]);
            }

            $this->Flash->error('Rezultata ni bilo mogoče shraniti.');
        }

        $this->set(compact('match'));
    }

    /**
     * Dodeli NASLEDNJO tekmo na igrišče:
     * - poišče 2 prosta tekmovalca (losses<2, ne igrata),
     * - ne ponavlja parov, ki so že igrali skupaj (finished),
     * - ustvari match s statusom 'in_progress'.
     */
    public function startNextOnCourt($eventId = null, $courtId = null) {
        $matchesTable = $this->TournamentMatches;
        $competitorsTable = $this->fetchTable('Competitors');

        // aktivni tekmovalci (še niso izpadli)
        $competitors = $competitorsTable->find()
            ->where([
                'tournament_event_id' => $eventId,
                'losses <' => 2,
            ])
            ->all()
            ->toList();

        if (count($competitors) < 2) {
            $this->Flash->info('Ni dovolj tekmovalcev za novo tekmo.');
            return $this->redirect($this->referer());
        }

        // kdo že igra (in_progress)?
        $busyMatches = $matchesTable->find()
            ->select(['competitor1_id', 'competitor2_id'])
            ->where([
                'tournament_event_id' => $eventId,
                'status' => 'in_progress',
            ])
            ->all();

        $busy = [];
        foreach ($busyMatches as $m) {
            if ($m->competitor1_id) {
                $busy[$m->competitor1_id] = true;
            }
            if ($m->competitor2_id) {
                $busy[$m->competitor2_id] = true;
            }
        }

        // prosti tekmovalci
        $free = [];
        foreach ($competitors as $c) {
            if (!isset($busy[$c->id])) {
                $free[] = $c;
            }
        }

        if (count($free) < 2) {
            $this->Flash->info('Ni dveh prostih tekmovalcev za novo tekmo.');
            return $this->redirect($this->referer());
        }

        // vse kombinacije parov
        $pairs = [];
        $n = count($free);
        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                $pairs[] = [$free[$i], $free[$j]];
            }
        }

        // filtriraj pare, ki še niso igrali skupaj
        $validPairs = [];
        foreach ($pairs as [$a, $b]) {
            $alreadyPlayed = $matchesTable->find()
                ->where([
                    'tournament_event_id' => $eventId,
                    'status' => 'finished',
                    'OR' => [
                        ['competitor1_id' => $a->id, 'competitor2_id' => $b->id],
                        ['competitor1_id' => $b->id, 'competitor2_id' => $a->id],
                    ],
                ])
                ->count();

            if ($alreadyPlayed === 0) {
                $validPairs[] = [$a, $b];
            }
        }

        if (empty($validPairs)) {
            $this->Flash->info('Ni več novih parov, ki še niso igrali med sabo. Turnir je morda pri koncu.');
            return $this->redirect($this->referer());
        }

        // random par
        shuffle($validPairs);
        [$p1, $p2] = $validPairs[0];

        $match = $matchesTable->newEmptyEntity();
        $match = $matchesTable->patchEntity($match, [
            'tournament_event_id' => $eventId,
            'competitor1_id' => $p1->id,
            'competitor2_id' => $p2->id,
            'court_id' => $courtId,
            'status' => 'in_progress',
            'started_at' => FrozenTime::now(),
        ]);

        if ($matchesTable->save($match)) {
            $this->Flash->success(sprintf(
                'Nova tekma: %s vs %s na izbranem igrišču.',
                $p1->name,
                $p2->name
            ));
        } else {
            $this->Flash->error('Nisem uspel ustvariti nove tekme.');
        }

        return $this->redirect($this->referer());
    }

    /**
     * Helper: označi event kot finished, če je končan.
     */
    protected function _checkAndMarkEventFinished(int $eventId): void {
        $competitorsTable = $this->fetchTable('Competitors');

        $aliveCount = $competitorsTable->find()
            ->where([
                'tournament_event_id' => $eventId,
                'losses <' => 2,
            ])
            ->count();

        $openMatches = $this->TournamentMatches->find()
            ->where([
                'tournament_event_id' => $eventId,
                'status IN' => ['scheduled', 'in_progress'],
            ])
            ->count();

        if ($aliveCount <= 1 && $openMatches === 0) {
            $eventsTable = $this->fetchTable('TournamentEvents');
            $event = $eventsTable->get($eventId);
            $event->status = 'finished';
            $eventsTable->save($event);
        }
    }
}
