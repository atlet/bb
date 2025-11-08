<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Hash;

/**
 * TournamentEvents Controller
 *
 * @property \App\Model\Table\TournamentEventsTable $TournamentEvents
 */
class TournamentEventsController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $query = $this->TournamentEvents->find()
            ->contain(['Tournaments']);
        $tournamentEvents = $this->paginate($query);

        $this->set(compact('tournamentEvents'));
    }

    /**
     * View method
     *
     * @param string|null $id Tournament Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $tournamentEvent = $this->TournamentEvents->get($id, contain: ['Tournaments', 'Competitors', 'TournamentMatches' => ['Competitor1s', 'Competitor2s', 'Courts', 'Winners']]);
        //dd($tournamentEvent->tournament_matches);
        $this->set(compact('tournamentEvent'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $tournamentEvent = $this->TournamentEvents->newEmptyEntity();
        if ($this->request->is('post')) {
            $tournamentEvent = $this->TournamentEvents->patchEntity($tournamentEvent, $this->request->getData());
            if ($this->TournamentEvents->save($tournamentEvent)) {
                $this->Flash->success(__('The tournament event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tournament event could not be saved. Please, try again.'));
        }
        $tournaments = $this->TournamentEvents->Tournaments->find('list', limit: 200)->all();
        $this->set(compact('tournamentEvent', 'tournaments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tournament Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $tournamentEvent = $this->TournamentEvents->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tournamentEvent = $this->TournamentEvents->patchEntity($tournamentEvent, $this->request->getData());
            if ($this->TournamentEvents->save($tournamentEvent)) {
                $this->Flash->success(__('The tournament event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tournament event could not be saved. Please, try again.'));
        }
        $tournaments = $this->TournamentEvents->Tournaments->find('list', limit: 200)->all();
        $this->set(compact('tournamentEvent', 'tournaments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tournament Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $tournamentEvent = $this->TournamentEvents->get($id);
        if ($this->TournamentEvents->delete($tournamentEvent)) {
            $this->Flash->success(__('The tournament event has been deleted.'));
        } else {
            $this->Flash->error(__('The tournament event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Kontrolni pogled: igrišča + “naslednja tekma” + overview.
     */
    public function control($id = null) {
        $event = $this->TournamentEvents->get($id, [
            'contain' => [
                'Tournaments.Courts',
                'TournamentMatches' => [
                    'Competitor1s',
                    'Competitor2s',
                    'Courts',
                ],
                'Competitors',
            ],
        ]);

        $courts = $event->tournament->courts ?? [];

        $this->set(compact('event', 'courts'));
    }

    /**
     * Lestvica – razvrstitev po wins/losses.
     */
    public function standings($id = null) {
        $event = $this->TournamentEvents->get($id, [
            'contain' => ['Competitors'],
        ]);

        $competitors = collection($event->competitors)
            ->sortBy('losses')
            ->sortBy('wins', SORT_DESC);

        $this->set(compact('event', 'competitors'));
    }

    /**
     * Žreb parov za dvojice – izbereš igralce, sistem ustvari Competitors + CompetitorPlayers.
     */
    public function drawPairs($id = null) {
        $event = $this->TournamentEvents->get($id);

        $playersTable = $this->fetchTable('Players');
        $competitorsTable = $this->fetchTable('Competitors');
        $competitorPlayersTable = $this->fetchTable('CompetitorPlayers');

        $players = $playersTable->find()
            ->orderAsc('last_name')
            ->orderAsc('first_name')
            ->all()
            ->toList();

        if ($this->request->is(['post', 'put'])) {
            $selectedIds = (array)$this->request->getData('player_ids');
            $selectedIds = array_map('intval', $selectedIds);
            $selectedIds = array_values(array_unique($selectedIds));

            if (count($selectedIds) < 2 || count($selectedIds) % 2 !== 0) {
                $this->Flash->error('Izberi sodo število igralcev (2, 4, 6, 8, ...).');
                return $this->redirect(['action' => 'drawPairs', $id]);
            }

            $selectedPlayers = $playersTable->find()
                ->where(['id IN' => $selectedIds])
                ->all()
                ->toList();

            shuffle($selectedPlayers);

            $pairs = array_chunk($selectedPlayers, 2);

            $conn = $competitorsTable->getConnection();
            $conn->begin();

            try {
                foreach ($pairs as $pair) {
                    [$p1, $p2] = $pair;
                    $teamName = $p1->last_name . ' / ' . $p2->last_name;

                    $competitor = $competitorsTable->newEntity([
                        'tournament_event_id' => $event->id,
                        'name' => $teamName,
                        'is_team' => true,
                    ]);
                    $competitorsTable->saveOrFail($competitor);

                    $competitorPlayersTable->saveOrFail(
                        $competitorPlayersTable->newEntity([
                            'competitor_id' => $competitor->id,
                            'player_id' => $p1->id,
                            'position' => 1,
                        ])
                    );
                    $competitorPlayersTable->saveOrFail(
                        $competitorPlayersTable->newEntity([
                            'competitor_id' => $competitor->id,
                            'player_id' => $p2->id,
                            'position' => 2,
                        ])
                    );
                }

                $conn->commit();
                $this->Flash->success('Pari za dvojice so bili uspešno izžrebani.');
                return $this->redirect(['action' => 'view', $event->id]);
            } catch (\Throwable $e) {
                $conn->rollback();
                $this->Flash->error('Napaka pri žrebu parov: ' . $e->getMessage());
            }
        }

        $playerOptions = [];
        foreach ($players as $p) {
            $playerOptions[$p->id] = $p->first_name . ' ' . $p->last_name;
        }

        $this->set(compact('event', 'playerOptions'));
    }
}
