<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $ID
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string $sexe
 * @property string $fil
 * @property string $phone
 * @property string|resource $photo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $active
 * @property string $n_group
 * @property string $role
 */
class User extends Entity
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
        'nom' => true,
        'prenom' => true,
        'email' => true,
        'password' => true,
        'username' => true,
        'sexe' => true,
        'phone' => true,
        'fil' => true,

        'created' => true,
        'modified' => true,
        'active' => true,
        'n_group' => true,
        'role' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */


    protected function _setPassword($password) //methode pour hasher les mot de passe
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }


}
