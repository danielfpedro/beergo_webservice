<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\UnauthorizedException;

use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 */
class UsuariosController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['token']);
    }

    public function token()
    {
        $user = $this->Auth->identify();
        
        if (!$user) {
            throw new UnauthorizedException();
        }

        $token = JWT::encode([
            'sub' => $user['id'],
            'exp' => time() + 604800
        ],
            Security::salt()
        );
        // debug($token);
        // $token = $this->request->data('access_token');

        $this->set(compact('token'));
        $this->set('_serialize', ['token']);
    }

    public function updateUsername()
    {
        $username = $this->request->data('username');
        // $username = $this->request->query('username');

        $this->Usuarios->updateUsername($this->Auth->user('id'), $username);
        
        $response = 'ok';

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }
}
