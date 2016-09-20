<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Amigos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \App\Model\Entity\Amigo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Amigo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Amigo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Amigo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Amigo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Amigo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Amigo findOrCreate($search, callable $callback = null)
 */
class AmigosTable extends Table
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

        $this->table('amigos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('amigo')
            ->requirePresence('amigo', 'create')
            ->notEmpty('amigo');

        $validator
            ->integer('amizade_resquisitada')
            ->requirePresence('amizade_resquisitada', 'create')
            ->notEmpty('amizade_resquisitada');

        $validator
            ->integer('bloqueado')
            ->requirePresence('bloqueado', 'create')
            ->notEmpty('bloqueado');

        $validator
            ->dateTime('dt_bloqueio')
            ->allowEmpty('dt_bloqueio');

        $validator
            ->integer('usuario_id1')
            ->requirePresence('usuario_id1', 'create')
            ->notEmpty('usuario_id1');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));

        return $rules;
    }
}
