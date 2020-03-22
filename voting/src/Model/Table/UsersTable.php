<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

use Twilio\Rest\Client;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{


    // Your Acount SID
    public $validate = array(
        'nom' => array(
            'rule' => 'notEmpty', // verplicht
            'message' => 'Name is required.',
            'allowEmpty' => true
        ),
        'prenom' => array(
            'rule' => 'notEmpty', // verplicht
            'message' => 'Intro is required.'
        ),
        'photo' => array(
            'validFileSize' => array( // zelf gekozen naam van de regel
                'rule' => array('filesize', '>', 0), // verplicht
                'on' => 'update',
                'message' => 'Photo is required.'
            ),
            /* 'validExtension' => array( // zelf gekozen naam van de regel
                 'rule' => array('extension', array('jpg', 'jpeg', 'png', 'gif')),
                 'on' => 'create',
                 'message' => 'Photo has to contain a valid extension (jpg, jpeg, png or gif).'
             ),*/
            'validExtension' => array( // zelf gekozen naam van de regel
                'rule' => array('extension', array('jpg', 'jpeg', 'png', 'gif')),
                'allowEmpty' => true,
                'on' => 'update',
                'message' => 'Photo has to contain a valid extension (jpg, jpeg, png or gif).'
            )
        )
    );

    // Your Acount Auth Token
    protected $sid = "AC4a081de36f5c1043b94033262b43a0d4";

    // Your Notify Service SID
    protected $token = "2ef06b908d564095991348aa44d0f9cb";
    protected $sSid = "MG1d782b4ace15acc0439c4d6a6489b3b4";

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');
        // New Twilio Client Instance

        $this->addBehavior('Timestamp');
        /*$this->addBehavior('Josegonzalez/Upload.Upload', [
            'photo',
        ]);*/

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        /* $validator
             ->integer('ID')
             ->allowEmptyString('ID', null, 'create');*/

        $validator
            ->scalar('nom')
            ->maxLength('nom', 255)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom');

        $validator
            ->scalar('prenom')
            ->maxLength('prenom', 255)
            ->requirePresence('prenom', 'create')
            ->notEmptyString('prenom');
        $validator->add('photo', 'file', [
            'rule' => ['mimeType', ['image/jpeg', 'image/png']],
            'on' => function ($context) {
                return !empty($context['data']['show_profile_picture']);
            }
        ]);
        /*$validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');*/


        $validator->add('password', 'length', ['rule' => ['lengthBetween', 8, 100]]);

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('sexe')
            ->maxLength('sexe', 2)
            ->requirePresence('sexe', 'create')
            ->notEmptyString('sexe');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 13)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone', [__('Ce champs ne doit pas etre vide')]);

        $validator
            ->requirePresence('photo', 'create')
            ->notEmptyString('photo');

        /* $validator
             ->boolean('active')
             ->notEmptyString('active');*/

        $validator
            ->scalar('n_group')
            ->maxLength('n_group', 30)
            ->requirePresence('n_group', 'create')
            ->notEmptyString('n_group');

        /* $validator
             ->scalar('role')
             ->maxLength('role', 10)
             ->requirePresence('role', 'create')
             ->notEmptyString('role');*/

        return $validator;
    }

    public function validationSign(Validator $validator)
    {

        $validator
            ->integer('ID')
            ->allowEmptyString('ID', null, 'create')
            ->ascii('username')
            ->lengthBetween('username', [6, 100])
            ->notEmptyString('fil')
            ->maxLength('fil', 255)
            ->add('phone', 'phone_no_should_be_numeric', ['rule' => 'numeric', 'allowEmpty' => true, 'message' => 'numero incorrect'])
            /*  ->notEmptyString('email',[__('Ce champs ne doit pas etre vide')])

              ->requirePresence('email')
              ->add('email', 'validFormat', [
                  'rule' => 'email',
                  'message' => 'E-mail non valide'
              ])*/

            ->notEmptyString('username', [__('Ce champs ne doit pas etre vide')])
            ->minLength('username', 6, 'Nom d\'utilisateur doit comporter au moins 6 caracteres')
            ->add('password', 'length', ['rule' => ['lengthBetween', 8, 100], 'message' => 'le mot de passe doit comporter au moins 8 caracteres'])
            ->add('password', 'custom', [
                'rule' => [$this, 'checkCharacters'],
                'message' => __('Le mot de passe doit comprendre au moins 1 chiffre, 1 Majuscule, 1 minuscule, et 1 point de ponctuation')
            ])
            ->add('password2', 'no-misspelling', [
                'rule' => ['compareWith', 'password'],
                'message' => 'Les mots de passe ne sont pas égaux.'
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
            ->requirePresence('password2');

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
        $rules->add($rules->isUnique(['email', 'n_group'],
            __('Cet email est déjà utilisé.')));
        $rules->add($rules->isUnique(['username'], __('Ce nom d\'utilisateur est déjà utilisé.')));
        $rules->add($rules->isUnique(['phone', 'n_group'],
            __('Ce numéro de téléphone est déjà utilisé.')));

        return $rules;
    }

    public function findAuth(Query $query, array $options)
    {
        $query
            ->select(['id', 'username', 'password', 'role', 'active', 'n_group', 'fil'])
            ->where(['Users.active' => '1'])
            ->andWhere(['Users.role' => '3'])->orwhere(['Users.role' => '1']);
        // ->orWhere(['Users.role'=>'1']);
        return $query;
    }

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
