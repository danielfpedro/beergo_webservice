<?php

namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Network\Request;
use Cake\Network\Response;

use Cake\ORM\TableRegistry;

use Facebook\Facebook;

class FacebookAuthenticate extends BaseAuthenticate
{

	public $Usuarios;

	public $fb;

	public function __construct()
	{

		$this->Usuarios = TableRegistry::get('Usuarios');

		$this->fb = new Facebook([
			'app_id' => '2079156488976765',
			'app_secret' => '62f571e2340b9ae1376368868ca0b73b',
			'default_graph_version' => 'v2.7',
			//'default_access_token' => '{access-token}', // optional
		]);
	}

    public function authenticate(Request $request, Response $response)
    {
    	$facebookUser = $this->_getFacebookUser($request->query('access_token'));

    	if ($facebookUser) {
    		return $facebookUser;
    	}
    	return false;
    }

    protected function _getFacebookUser($accessToken)
    {
		try {
			$response = $this->fb->get('/me?fields=id,name,email,gender,age_range', $accessToken);
            debug($response->getGraphUser());
            exit();
			return $this->_getFinalUser($response->getGraphUser());

		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
			return [];
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
			return [];
		}
    }

    protected function _getFinalUser($facebookUser)
    {
    	$data = [
    		'nome' => $facebookUser['name'],
    		'genero' => $facebookUser['gender'],
    		'facebook_id' => $facebookUser['id']
    	];

    	$user = $this->Usuarios->find('all', [
    		'fields' => [
    			'id'
    		],
    		'conditions' => [
    			'facebook_id' => $data['facebook_id'],
    			'deletado' => 0
    		]
    	])
    	->first();

    	if ($user) {
    		$entity = $this->Usuarios->get($user['id']);
    		$entity = $this->Usuarios->patchEntity($entity, $data);
    	} else {
			$entity = $this->Usuarios->newEntity($data);
    	}

    	$this->Usuarios->save($entity);

        debug($facebookUser);
        exit();

    	return ['id' => $entity->id];

    }
}