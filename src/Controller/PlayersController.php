<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Players Controller
 *
 * @property \App\Model\Table\PlayersTable $Players
 */
class PlayersController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $query = $this->Players->find();
        $players = $this->paginate($query);

        $this->set(compact('players'));
    }

    /**
     * View method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $player = $this->Players->get($id, contain: ['CompetitorPlayers.Competitors.TournamentEvents']);
        $this->set(compact('player'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $player = $this->Players->newEmptyEntity();
        if ($this->request->is('post')) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }
        $this->set(compact('player'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $player = $this->Players->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }
        $this->set(compact('player'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $player = $this->Players->get($id);
        if ($this->Players->delete($player)) {
            $this->Flash->success(__('Zapis je bil uspešno izbrisan.'));
        } else {
            $this->Flash->error(__('Napaka pri izbrisu. Prosim, odpravite napake.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
