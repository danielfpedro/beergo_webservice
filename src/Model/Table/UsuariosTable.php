<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Network\Exception\NotAcceptableException;

class UsuariosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('usuarios');
        $this->displayField('nome');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'criado' => 'new',
                    'modificado' => 'always',
                ]
            ]
        ]);

    }

    public function updateUsername($userId, $username)
    {
        if (!$username) {
            throw new NotAcceptableException("Username não informado.");
        }
        $user = $this->get($userId);

        if (!$user) {
            throw new NotAcceptableException("Usuário não encontrado.");
        }

        $user = $this->patchEntity($user, ['username' => $username]);

        if (!$this->_isUsernameUnique($user, $username)) {
            throw new NotAcceptableException("O username informado já está em uso.");
        }
        if (!$this->save($user)) {
            throw new NotAcceptableException();
        }
        
    }

    protected function _isUsernameUnique($user, $username)
    {
        $total = $this->find('all', [
            'conditions' => [
                    'id !=' => $user->id,
                    'username' => $username,
                ]
            ])
            ->count();

        return !(boolean)$total;
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('username', [
                'minLength' => [
                    'rule' => ['minLength', 4],
                    'last' => true,
                    'message' => 'tey'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 18],
                ],
            ]);
        return $validator;
    }
}
