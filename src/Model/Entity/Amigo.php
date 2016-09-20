<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Amigo Entity
 *
 * @property int $id
 * @property int $amigo
 * @property int $amizade_resquisitada
 * @property int $bloqueado
 * @property \Cake\I18n\Time $dt_bloqueio
 * @property int $usuario_id
 * @property int $usuario_id1
 *
 * @property \App\Model\Entity\Usuario $usuario
 */
class Amigo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
