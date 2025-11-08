<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Competitors Controller
 *
 * @property \App\Model\Table\CompetitorsTable $Competitors
 */
class CompetitorsController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $query = $this->Competitors->find()
            ->contain(['TournamentEvents']);
        $competitors = $this->paginate($query);

        $this->set(compact('competitors'));
    }

    /**
     * View method
     *
     * @param string|null $id Competitor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $competitor = $this->Competitors->get($id, contain: ['TournamentEvents', 'CompetitorPlayers.Players']);
        $this->set(compact('competitor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $competitor = $this->Competitors->newEmptyEntity();
        if ($this->request->is('post')) {
            $competitor = $this->Competitors->patchEntity($competitor, $this->request->getData());
            if ($this->Competitors->save($competitor)) {
                $this->Flash->success(__('The competitor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competitor could not be saved. Please, try again.'));
        }
        $tournamentEvents = $this->Competitors->TournamentEvents->find('list', limit: 200)->all();
        $this->set(compact('competitor', 'tournamentEvents'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Competitor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $competitor = $this->Competitors->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competitor = $this->Competitors->patchEntity($competitor, $this->request->getData());
            if ($this->Competitors->save($competitor)) {
                $this->Flash->success(__('The competitor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competitor could not be saved. Please, try again.'));
        }
        $tournamentEvents = $this->Competitors->TournamentEvents->find('list', limit: 200)->all();
        $this->set(compact('competitor', 'tournamentEvents'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Competitor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $competitor = $this->Competitors->get($id);
        if ($this->Competitors->delete($competitor)) {
            $this->Flash->success(__('The competitor has been deleted.'));
        } else {
            $this->Flash->error(__('The competitor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
