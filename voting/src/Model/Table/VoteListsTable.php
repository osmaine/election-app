<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VoteLists Model
 *
 * @method \App\Model\Entity\VoteList get($primaryKey, $options = [])
 * @method \App\Model\Entity\VoteList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VoteList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VoteList|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VoteList saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VoteList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VoteList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VoteList findOrCreate($search, callable $callback = null, $options = [])
 */
class VoteListsTable extends Table
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

        $this->setTable('vote_lists');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');
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
            ->integer('ID')
            ->allowEmptyString('ID', null, 'create');

        $validator
            ->scalar('n_group')
            ->maxLength('n_group', 20)
            ->requirePresence('n_group', 'create')
            ->notEmptyString('n_group');

        $validator
            ->scalar('start_election')
            ->notEmptyString('start_election')
            ->requirePresence('end_election', 'create');
        $validator
            ->scalar('end_election')
            ->requirePresence('end_election', 'create')
            ->notEmptyString('end_election');

        $validator
            ->scalar('vote_secret')
            ->maxLength('vote_secret', 255)
            ->requirePresence('vote_secret', 'create')
            ->notEmptyString('vote_secret');

        return $validator;
    }
}
