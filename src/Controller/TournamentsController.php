<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Tournaments Controller
 *
 * @property \App\Model\Table\TournamentsTable $Tournaments
 */
class TournamentsController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $query = $this->Tournaments->find();
        $tournaments = $this->paginate($query);

        $this->set(compact('tournaments'));
    }

    /**
     * View method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $tournament = $this->Tournaments->get($id, contain: ['Courts', 'TournamentEvents']);
        $this->set(compact('tournament'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $tournament = $this->Tournaments->newEmptyEntity();
        if ($this->request->is('post')) {
            $tournament = $this->Tournaments->patchEntity($tournament, $this->request->getData());
            if ($this->Tournaments->save($tournament)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }
        $this->set(compact('tournament'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $tournament = $this->Tournaments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tournament = $this->Tournaments->patchEntity($tournament, $this->request->getData());
            if ($this->Tournaments->save($tournament)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }
        $this->set(compact('tournament'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $tournament = $this->Tournaments->get($id);
        if ($this->Tournaments->delete($tournament)) {
            $this->Flash->success(__('Zapis je bil uspešno izbrisan.'));
        } else {
            $this->Flash->error(__('Napaka pri izbrisu. Prosim, odpravite napake.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function scoreboard($id = null) {
        $tournament = $this->Tournaments->get($id, [
            'contain' => [
                'Courts.TournamentMatches' => function ($q) {
                    return $q
                        ->where([
                            'TournamentMatches.status IN' => ['scheduled', 'in_progress'],
                        ])
                        ->contain(['Competitor1s', 'Competitor2s'])
                        ->orderAsc('TournamentMatches.match_number');
                },
            ],
        ]);

        $this->set(compact('tournament'));
        $this->viewBuilder()->setLayout('default'); // ali custom "fullscreen" layout, če želiš
    }
}
