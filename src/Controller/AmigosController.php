<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Amigos Controller
 *
 * @property \App\Model\Table\AmigosTable $Amigos
 */
class AmigosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuarios']
        ];
        $amigos = $this->paginate($this->Amigos);

        $this->set(compact('amigos'));
        $this->set('_serialize', ['amigos']);
    }

    /**
     * View method
     *
     * @param string|null $id Amigo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $amigo = $this->Amigos->get($id, [
            'contain' => ['Usuarios']
        ]);

        $this->set('amigo', $amigo);
        $this->set('_serialize', ['amigo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $amigo = $this->Amigos->newEntity();
        if ($this->request->is('post')) {
            $amigo = $this->Amigos->patchEntity($amigo, $this->request->data);
            if ($this->Amigos->save($amigo)) {
                $this->Flash->success(__('The amigo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The amigo could not be saved. Please, try again.'));
            }
        }
        $usuarios = $this->Amigos->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('amigo', 'usuarios'));
        $this->set('_serialize', ['amigo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Amigo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $amigo = $this->Amigos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $amigo = $this->Amigos->patchEntity($amigo, $this->request->data);
            if ($this->Amigos->save($amigo)) {
                $this->Flash->success(__('The amigo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The amigo could not be saved. Please, try again.'));
            }
        }
        $usuarios = $this->Amigos->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('amigo', 'usuarios'));
        $this->set('_serialize', ['amigo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Amigo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $amigo = $this->Amigos->get($id);
        if ($this->Amigos->delete($amigo)) {
            $this->Flash->success(__('The amigo has been deleted.'));
        } else {
            $this->Flash->error(__('The amigo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
