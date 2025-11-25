<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * MatchGames Controller
 *
 * @property \App\Model\Table\MatchGamesTable $MatchGames
 */
class MatchGamesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MatchGames->find()
            ->contain(['Matches']);
        $matchGames = $this->paginate($query);

        $this->set(compact('matchGames'));
    }

    /**
     * View method
     *
     * @param string|null $id Match Game id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $matchGame = $this->MatchGames->get($id, contain: ['Matches']);
        $this->set(compact('matchGame'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $matchGame = $this->MatchGames->newEmptyEntity();
        if ($this->request->is('post')) {
            $matchGame = $this->MatchGames->patchEntity($matchGame, $this->request->getData());
            if ($this->MatchGames->save($matchGame)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));

                return $this->redirect(['action' => 'atlindex']);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }
        $matches = $this->MatchGames->Matches->find('list', limit: 200)->all();
        $this->set(compact('matchGame', 'matches'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Match Game id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $matchGame = $this->MatchGames->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $matchGame = $this->MatchGames->patchEntity($matchGame, $this->request->getData());
            if ($this->MatchGames->save($matchGame)) {
                $this->Flash->success(__('Zapis je bil uspešno shranjen.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Napaka pri shranjevanju. Prosim, odpravite napake.'));
        }
        $matches = $this->MatchGames->Matches->find('list', limit: 200)->all();
        $this->set(compact('matchGame', 'matches'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Match Game id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $matchGame = $this->MatchGames->get($id);
        if ($this->MatchGames->delete($matchGame)) {
            $this->Flash->success(__('Zapis je bil uspešno izbrisan.'));
        } else {
            $this->Flash->error(__('Napaka pri izbrisu. Prosim, odpravite napake.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
