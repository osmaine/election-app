<?php


namespace App\Model\Table;


use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class AdminsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');

        /*  $this->addBehavior('Josegonzalez/Upload.Upload', [
              'photo',
          ]);*/
        /*  $this->addBehavior('Josegonzalez/Upload.Upload', [
              'photo' => [
                  'path' => 'static{DS}{model}{DS}{field}{DS}{primaryKey}',
              ],
              'fields' => [
                  'dir' => 'photo_dir',
                  'size' => 'size_dir',
                  'type' => 'type_dir',
              ],
          ]);*/

    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('username', 'Ce champs ne doit pas etre vide')
            ->requirePresence('username')
            ->notEmpty('password')
            ->requirePresence('password')
            ->add('password', 'custom', [
                'rule' => [$this, 'checkCharacters'],
                'message' => 'The password must contain 1 number, 1 uppercase, 1 lowercase, and 1 special character'
            ])
            ->add('password2', 'no-misspelling', [
                'rule' => ['compareWith', 'password'],
                'message' => 'Les mot de passe ne sont pas égaux',
            ]);
        return $validator;
    }

    public function validationEdit(Validator $validator)
    {

        $validator
            ->notEmpty('nom', 'Ce champs ne doit pas etre vide')
            ->requirePresence('nom');
        $validator
            ->notEmpty('prenom', 'Ce champs ne doit pas etre vide')
            ->requirePresence('prenom');
        $validator
            ->notEmpty('photo', 'Ce champs ne doit pas etre vide');
        /*$validator
            ->notEmpty('photo', 'Ce champs ne doit pas etre vide');*/
        /* $validator->add('photo','file', [
             'rule' => ['photo', [
                 'types' => [
                     'image/bmp',
                     'image/gif',
                     'image/jpeg',
                     'image/pjpeg',
                     'image/png',
                     'image/vnd.microsoft.icon',
                     'image/x-windows-bmp',
                     'image/x-icon',
                     'image/x-png',
                 ],
                 'optional' => true,
             ]],
             'message' => 'The uploaded avatar was not a valid image'
         ]);*/
        return $validator;
    }

    public function validationAdd(Validator $validator)
    {

        $validator
            ->integer('ID')
            ->allowEmptyString('ID', null, 'create')
            ->add('phone', 'phone_no_should_be_numeric', ['rule' => 'numeric', 'allowEmpty' => false, 'message' => 'numero incorrect'])
            ->notEmptyString('email', [__('Ce champs ne doit pas etre vide')])
            ->add('email', 'validFormat', [
                'rule' => 'email',
                'message' => __('E-mail non valide')
            ]);
        $validator->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'admins'])
            ->minLength('username', 6, 'Nom d\'utilisateur doit comporter au moins 6 caracteres')
            ->add('password', 'length', ['rule' => ['lengthBetween', 8, 100], 'message' => 'le mot de passe doit comporter au moins 8 caracteres'])
            ->add('password2', 'no-misspelling', [
                'rule' => ['compareWith', 'password'],
                'message' => 'Les mots de passe ne sont pas égaux.'
            ])
            ->add('password', 'custom', [
                'rule' => [$this, 'checkCharacters'],
                'message' => 'The password must contain 1 number, 1 uppercase, 1 lowercase, and 1 special character'
            ])
            ->notEmpty('nom', [__('Ce champs ne doit pas etre vide')])
            ->requirePresence('nom')
            ->maxLength('nom', 255)
            ->notEmpty('prenom', [__('Ce champs ne doit pas etre vide')])
            ->maxLength('prenom', 255)
            ->requirePresence('prenom')
            ->notEmpty('password', [__('Ce champs ne doit pas etre vide')])
            ->requirePresence('password')
            ->notEmpty('password2', [__('Ce champs ne doit pas etre vide')])
            ->requirePresence('password2')
            ->requirePresence('email');

        return $validator;

    }

    public function findAuth(Query $query, array $options)
    {
        $query
            ->select(['id', 'username', 'password', 'role', 'active', 'n_group', 'no_edit', 'fil'])
            ->where(['Admins.active' => '1'])
            ->andwhere(['Admins.role' => '2']);

        return $query;
    }
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return bool
     */
    /* public function buildRules(RulesChecker $rules)
     {
         $rules->add($rules->isUnique(['email', 'n_group'],
             __('Cet email est déjà utilisé.')));
         $rules->add($rules->isUnique(['username'],__('Ce nom d\'utilisateur est déjà utilisé.')));
         $rules->add($rules->isUnique(['phone', 'n_group'],
             __('Ce numéro de téléphone est déjà utilisé.')));

         return $rules;
     }*/
    public function checkCharacters($password, array $context)
    {
        // number
        if (!preg_match("#[0-9]#", $password)) {
            return false;
        }
        // Uppercase
        if (!preg_match("#[A-Z]#", $password)) {
            return false;
        }
        // lowercase
        if (!preg_match("#[a-z]#", $password)) {
            return false;
        }
        // special characters
        if (!preg_match("#\W+#", $password)) {
            return false;
        }
        return true;
    }


}
