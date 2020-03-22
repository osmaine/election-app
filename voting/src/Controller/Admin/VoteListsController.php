<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Chronos\Chronos;
use Cake\ORM\TableRegistry;

/**
 * VoteLists Controller
 *
 *
 * @method \App\Model\Entity\VoteList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VoteListsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {


        $voteLists = $this->paginate($this->VoteLists->find('all')->where(['n_group' => $this->request->getSession()->read('Auth.User.n_group')]));

        $this->set(compact('voteLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Vote List id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $voteList = $this->VoteLists->get($id, [
            'contain' => [],
        ]);

        $this->set('voteList', $voteList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $time = Chronos::now();
        $group = $this->request->getSession()->read('Auth.User.n_group');
        $users = TableRegistry::getTableLocator()->get('Users');
        $votes = TableRegistry::getTableLocator()->get('votes');
        $voteLists = TableRegistry::getTableLocator()->get('VoteLists');
        $voteList = $this->VoteLists->newEntity();
        if ($this->request->is('post') and !empty($this->request->getData())) {

            $secret_vot = $voteLists->find()->where(['n_group' => $group])->andWhere(['end_election > now()'])->first();
            //test si il ya une election en cours
            if ($secret_vot != null) {
                $this->Flash->error(__('Vous avez déjà un vote en cours!'));
                //si oui retourne à index
                return $this->redirect(['action' => 'index']);
            }

            $debut_date = strtotime($this->request->getData(['start_election']));
            $fin_date = strtotime($this->request->getData(['end_election']));
            if ($debut_date >= $fin_date) {
                $this->Flash->error(__('Dates non logique!.'));
                return $this->redirect(['action' => 'add']);
            }
            //si ya pas de vote en cours
            if ($secret_vot == null) {


                $voteList = $this->VoteLists->patchEntity($voteList, $this->request->getData(), ['validate' => 'default']);
                $voteList->vote_secret = $this->secret();
                $voteList->n_group = $group;
                $candid = $users->find('all')->where(['n_group' => $group])->where(['role' => 1])->first();
                if ($candid != null) {
                    $candid->voice = 0;
                    $users->save($candid);
                }


                if ($this->VoteLists->save($voteList)) {
                    $this->Flash->success(__('The vote list has been saved.'));
                    $voteListe = $voteLists->find()->where(['n_group' => $group])->andWhere(['end_election < now()'])->first();
                    if ($voteListe != null) {
                        $id_vote = $voteListe->get('ID');
                        $voteListe1 = $this->VoteLists->get($id_vote);
                        debug($voteListe1);
                        // $ancien_vote = $voteListe->get($id_vote);
                        if ($this->VoteLists->delete($voteListe1)) {
                            $this->Flash->success(__('Opération executée avec succes'));
                        }
                    }
                    return $this->redirect(['action' => 'index']);
                }

            }

            $this->Flash->error(__('The vote list could not be saved. Please, try again.'));
        }
        $this->set(compact('voteList'));
    }

    function secret()
    {
        $code = array_merge(range('A', 'Z'), range('0', '9'), range('a', 'z'));
        shuffle($code);
        $secret = array_slice($code, 0, 35);
        return implode('', $secret);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vote List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $voteList = $this->VoteLists->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $debut_date = $this->request->getData(['start_election']);
            $fin_date = $this->request->getData(['end_election']);

            if ($debut_date >= $fin_date) {
                $this->Flash->error(__('Dates non logique!.'));
                return $this->redirect(['action' => 'edit', $id]);
            }
            $voteList = $this->VoteLists->patchEntity($voteList, $this->request->getData());
            if ($this->VoteLists->save($voteList)) {
                $this->Flash->success(__('The vote list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vote list could not be saved. Please, try again.'));
        }
        $this->set(compact('voteList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vote List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $voteList = $this->VoteLists->get($id);
        if ($this->VoteLists->delete($voteList)) {
            $this->Flash->success(__('The vote list has been deleted.'));
        } else {
            $this->Flash->error(__('The vote list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function essai()
    {

    }
}
