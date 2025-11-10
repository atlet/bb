<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Courts Controller
 *
 * @property \App\Model\Table\CourtsTable $Courts
 */
class CourtsController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $query = $this->Courts->find()
            ->contain(['Tournaments']);
        $courts = $this->paginate($query);

        $this->set(compact('courts'));
    }

    /**
     * View method
     *
     * @param string|null $id Court id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $court = $this->Courts->get($id, contain: ['Tournaments', 'TournamentMatches' => ['TournamentEvents', 'Competitor1s', 'Competitor2s']]);
        $this->set(compact('court'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($tournament_id) {
        $court = $this->Courts->newEmptyEntity();
        if ($this->request->is('post')) {
            $court = $this->Courts->patchEntity($court, $this->request->getData());
            $court->tournament_id = $tournament_id;
            if ($this->Courts->save($court)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));

                return $this->redirect(['controller' => 'Tournaments', 'action' => 'view', $tournament_id]);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }

        $this->set(compact('court', 'tournament_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Court id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $court = $this->Courts->get($id, contain: []);
        $tournament_id = $court->tournament_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $court = $this->Courts->patchEntity($court, $this->request->getData());
            if ($this->Courts->save($court)) {
                $this->Flash->success(__('The court has been saved.'));

                return $this->redirect(['controller' => 'Tournaments', 'action' => 'view', $court->tournament_id]);
            }
            $this->Flash->error(__('The court could not be saved. Please, try again.'));
        }

        $this->set(compact('court', 'tournament_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Court id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $court = $this->Courts->get($id);
        $tournament_id = $court->tournament_id;
        if ($this->Courts->delete($court)) {
            $this->Flash->success(__('The court has been deleted.'));
        } else {
            $this->Flash->error(__('The court could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Tournaments', 'action' => 'view', $court->tournament_id]);
    }
}
