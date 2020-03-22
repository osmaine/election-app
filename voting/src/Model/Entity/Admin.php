<?php


namespace App\Model\Entity;


use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\Query;

/**
 * Admin Entity
 *
 * @property int $ID
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string $sexe
 * @property string $phone
 * @property string|resource $photo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $active
 * @property string $n_group
 * @property string $role
 */
class Admin extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,

    ];

    protected function _setPassword($password) //methode pour hasher les mot de passe
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }


}
