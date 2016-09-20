<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Checkins Controller
 *
 * @property \App\Model\Table\CheckinsTable $Checkins
 */
class CheckinsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $checkins = $this->paginate($this->Checkins);

        $this->set(compact('checkins'));
        $this->set('_serialize', ['checkins']);
    }

    /**
     * View method
     *
     * @param string|null $id Checkin id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $checkin = $this->Checkins->get($id, [
            'contain' => []
        ]);

        $this->set('checkin', $checkin);
        $this->set('_serialize', ['checkin']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $checkin = $this->Checkins->newEntity();
        if ($this->request->is('post')) {
            $checkin = $this->Checkins->patchEntity($checkin, $this->request->data);
            if ($this->Checkins->save($checkin)) {
                $this->Flash->success(__('The checkin has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The checkin could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('checkin'));
        $this->set('_serialize', ['checkin']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Checkin id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $checkin = $this->Checkins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $checkin = $this->Checkins->patchEntity($checkin, $this->request->data);
            if ($this->Checkins->save($checkin)) {
                $this->Flash->success(__('The checkin has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The checkin could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('checkin'));
        $this->set('_serialize', ['checkin']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Checkin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $checkin = $this->Checkins->get($id);
        if ($this->Checkins->delete($checkin)) {
            $this->Flash->success(__('The checkin has been deleted.'));
        } else {
            $this->Flash->error(__('The checkin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function fill($times)
    {
        for ($i=0; $i < $times; $i++) { 
            $entity = $this->Checkins->newEntity([
                'estabelecimento_id' => 1,
                'usuario_id' => 1,
                'grupo_id' => 1,
                'lat' => -22.507767,
                'lng' => -22.507767,
                'criado' => Time::now()
            ]);

            $this->Checkins->save($entity);
        }
    }
}
