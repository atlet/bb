<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CompetitorPlayers Controller
 *
 * @property \App\Model\Table\CompetitorPlayersTable $CompetitorPlayers
 */
class CompetitorPlayersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CompetitorPlayers->find()
            ->contain(['Competitors', 'Players']);
        $competitorPlayers = $this->paginate($query);

        $this->set(compact('competitorPlayers'));
    }

    /**
     * View method
     *
     * @param string|null $id Competitor Player id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competitorPlayer = $this->CompetitorPlayers->get($id, contain: ['Competitors', 'Players']);
        $this->set(compact('competitorPlayer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competitorPlayer = $this->CompetitorPlayers->newEmptyEntity();
        if ($this->request->is('post')) {
            $competitorPlayer = $this->CompetitorPlayers->patchEntity($competitorPlayer, $this->request->getData());
            if ($this->CompetitorPlayers->save($competitorPlayer)) {
                $this->Flash->success(__('The competitor player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competitor player could not be saved. Please, try again.'));
        }
        $competitors = $this->CompetitorPlayers->Competitors->find('list', limit: 200)->all();
        $players = $this->CompetitorPlayers->Players->find('list', limit: 200)->all();
        $this->set(compact('competitorPlayer', 'competitors', 'players'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Competitor Player id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competitorPlayer = $this->CompetitorPlayers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $competitorPlayer = $this->CompetitorPlayers->patchEntity($competitorPlayer, $this->request->getData());
            if ($this->CompetitorPlayers->save($competitorPlayer)) {
                $this->Flash->success(__('The competitor player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The competitor player could not be saved. Please, try again.'));
        }
        $competitors = $this->CompetitorPlayers->Competitors->find('list', limit: 200)->all();
        $players = $this->CompetitorPlayers->Players->find('list', limit: 200)->all();
        $this->set(compact('competitorPlayer', 'competitors', 'players'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Competitor Player id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $competitorPlayer = $this->CompetitorPlayers->get($id);
        if ($this->CompetitorPlayers->delete($competitorPlayer)) {
            $this->Flash->success(__('The competitor player has been deleted.'));
        } else {
            $this->Flash->error(__('The competitor player could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
