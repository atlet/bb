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
        $tournamentMatch = $this->TournamentMatches->get($id, contain: ['TournamentEvents', 'Competitor1s', 'Competitor2s', 'Winners', 'Courts']);
        $this->set(compact('tournamentMatch'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(int $tournament_event_id) {
        $tournamentMatch = $this->TournamentMatches->newEmptyEntity();
        if ($this->request->is('post')) {
            $tournamentMatch = $this->TournamentMatches->patchEntity($tournamentMatch, $this->request->getData());
            $tournamentMatch->tournament_event_id = $tournament_event_id;
            if ($this->TournamentMatches->save($tournamentMatch)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));
                $this->TournamentMatches->recalculateStatsForEvent($tournament_event_id);

                return $this->redirect(['action' => 'view', $tournamentMatch->id]);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }
        
        $competitors = $this->TournamentMatches->Competitor1s->getCompetitorsForEvent($tournament_event_id);        
        $courts = $this->TournamentMatches->Courts->getCourtsForTournament($tournament_event_id);
        $this->set(compact('tournamentMatch', 'competitors', 'courts', 'tournament_event_id'));
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
        $tournament_event_id = $tournamentMatch->tournament_event_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tournamentMatch = $this->TournamentMatches->patchEntity($tournamentMatch, $this->request->getData());
            if ($this->TournamentMatches->save($tournamentMatch)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));
                $this->TournamentMatches->recalculateStatsForEvent($tournament_event_id);

                return $this->redirect(['action' => 'view', $tournamentMatch->id]);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }
        
        $competitors = $this->TournamentMatches->Competitor1s->getCompetitorsForEvent($tournament_event_id);        
        $courts = $this->TournamentMatches->Courts->getCourtsForTournament($tournament_event_id);
        $this->set(compact('tournamentMatch', 'competitors', 'courts', 'tournament_event_id'));
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
        $tournament_event_id = $tournamentMatch->tournament_event_id;
        if ($this->TournamentMatches->delete($tournamentMatch)) {
            $this->Flash->success(__('Zapis je bil uspešno izbrisan.'));
        } else {
            $this->Flash->error(__('Napaka pri izbrisu. Prosim, odpravite napake.'));
        }

        return $this->redirect(['controller' => 'TournamentEvents', 'action' => 'view', $tournament_event_id]);
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

    public function startNextOnCourt($eventId = null, $courtId = null) {
        $matchesTable     = $this->TournamentMatches;
        $competitorsTable = $this->fetchTable('Competitors');

        // 1) Aktivni tekmovalci (še niso izpadli)
        $competitors = $competitorsTable->find()
            ->where([
                'tournament_event_id' => $eventId,
                'losses <' => 2,
            ])
            ->all()
            ->toList();

        if (count($competitors) < 2) {
            $this->Flash->info('Ni dovolj tekmovalcev za novo tekmo.');
            return $this->redirect("/tournament-events/control/{$eventId}");
        }

        // 2) Kdo trenutno igra (in_progress) – opcijsko lahko dodaš še 'scheduled'
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

        // 3) Prosti tekmovalci
        $free = [];
        foreach ($competitors as $c) {
            if (!isset($busy[$c->id])) {
                $free[] = $c;
            }
        }

        if (count($free) < 2) {
            $this->Flash->info('Ni dveh prostih tekmovalcev za novo tekmo.');
            return $this->redirect("/tournament-events/control/{$eventId}");
        }

        // 4) Preberi VSE že odigrane tekme (finished) za ta event:
        //    - da izračunamo "games_played" po tekmovalcih
        //    - in da vemo, kateri pari so ŽE igrali skupaj
        $finished = $matchesTable->find()
            ->select(['competitor1_id', 'competitor2_id'])
            ->where([
                'tournament_event_id' => $eventId,
                'status' => 'finished',
            ])
            ->all();

        // inicializiraj št. tekem za vse proste
        $gamesPlayed = [];
        foreach ($free as $c) {
            $gamesPlayed[$c->id] = 0;
        }

        // tabela parov, ki so že igrali (normaliziran ključ "manjšiId-večjiId")
        $playedPairs = [];

        foreach ($finished as $m) {
            $c1 = $m->competitor1_id;
            $c2 = $m->competitor2_id;

            if ($c1 && isset($gamesPlayed[$c1])) {
                $gamesPlayed[$c1]++;
            }
            if ($c2 && isset($gamesPlayed[$c2])) {
                $gamesPlayed[$c2]++;
            }

            if ($c1 && $c2) {
                $key = ($c1 < $c2) ? "{$c1}-{$c2}" : "{$c2}-{$c1}";
                $playedPairs[$key] = true;
            }
        }

        // 5) Poišči NAJBOLJ FER par med prostimi:
        //    - par, ki ŠE NI igral skupaj
        //    - minimizira max(odigrane igre A, odigrane igre B)
        //    - in ob izenačenju še vsoto (A+B)

        $n = count($free);
        $bestPair = null;
        $bestMax  = PHP_INT_MAX;
        $bestSum  = PHP_INT_MAX;

        for ($i = 0; $i < $n; $i++) {
            $a = $free[$i];

            for ($j = $i + 1; $j < $n; $j++) {
                $b = $free[$j];

                $key = ($a->id < $b->id)
                    ? "{$a->id}-{$b->id}"
                    : "{$b->id}-{$a->id}";

                // ta par je ŽE igral → preskoči
                if (isset($playedPairs[$key])) {
                    continue;
                }

                $ga = $gamesPlayed[$a->id] ?? 0;
                $gb = $gamesPlayed[$b->id] ?? 0;

                $max = max($ga, $gb);
                $sum = $ga + $gb;

                if ($max < $bestMax || ($max === $bestMax && $sum < $bestSum)) {
                    $bestMax  = $max;
                    $bestSum  = $sum;
                    $bestPair = [$a, $b];
                }
            }
        }

        if ($bestPair === null) {
            // ni NOVEGA para, ki še ni igral → ne delaj ponovitev!
            $this->Flash->info('Ni več novih parov, ki še niso igrali med sabo. Turnir je morda pri koncu.');
            return $this->redirect("/tournament-events/control/{$eventId}");
        }

        [$p1, $p2] = $bestPair;

        // 6) Ustvari novo tekmo
        $match = $matchesTable->newEmptyEntity();
        $match = $matchesTable->patchEntity($match, [
            'tournament_event_id' => $eventId,
            'competitor1_id'      => $p1->id,
            'competitor2_id'      => $p2->id,
            'court_id'            => $courtId,
            'status'              => 'in_progress',
            'started_at'          => FrozenTime::now(),
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

        return $this->redirect("/tournament-events/control/{$eventId}");
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
