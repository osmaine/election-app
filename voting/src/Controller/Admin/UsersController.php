<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Chronos\Date;
use Cake\Core\App;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\Chronos\Chronos;
use Cake\ORM\TableRegistry;
use DateTime;

/**
 * Users Controller
 *
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    /*    public function index()
        {

            $users = $this->paginate($this->Users);

            $this->set(compact('users'));
        }*/

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $useres = TableRegistry::getTableLocator()->get('Users');
        $phones = TableRegistry::getTableLocator()->get('Phones');
        $usernames = TableRegistry::getTableLocator()->get('Usernames');
        //selectionner la partie dont le 'id'=$id
        $user_search = $this->Users->find()->where(['ID' => $id])->first();

        //admin_phone
        $user_phone = $user_search->get('phone');

        //admin username
        $user_username = $user_search->get('username');
        //group id
        $n_group = $this->request->getSession()->read('Auth.User.n_group');

        $phone = $phones->find()->where(['phone' => $user_phone])->andWhere(['n_group' => $n_group])->first();

        $id_ph = $phone->get('ID');
        $username = $usernames->find()->where(['username' => $user_username])->first();
        $id_username = $username->get('ID');

        $phonee = $phones->get($id_ph);

        $usernam = $usernames->get($id_username);

        if ($this->Users->delete($user) and $phones->delete($phone) and $usernames->delete($usernam)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function electeur()
    {

        $user = TableRegistry::getTableLocator()->get('Users');
//$session=$this->request->getSession()->read('User.email');
//debug($session);
        $session = $this->getRequest()->getSession();
        $group = $session->read('Auth.User.n_group'); //notre session ne stocke que le id, le username
        $using = $user->find('all')->order(['nom' => 'ASC', 'prenom' => 'ASC'])->where(['n_group' => $group])->andWhere(['active' => 1])->andWhere(['role' => 3]); //on trouve et on recupere tout donc active =1; dans la vue
        $users = $this->paginate($using);
        $this->set(compact('users'));

    }


//fonction pour afficher les candidats
    public function candidat()
    {

        $user = TableRegistry::getTableLocator()->get('Users');

//dabord recupere le groupe de l'utilisateur n_group dans la session
        $session = $this->getRequest()->getSession();
        $group = $session->read('Auth.User.n_group'); //notre session ne stocke que le id, le username

//ensuite verifie  que son compte est active et son role est 1=candidat
        $using = $user->find('all')->order(['post' => 'ASC', 'nom' => 'ASC', 'prenom' => 'ASC'])->where(['n_group' => $group])->andWhere(['active' => 1])->andwhere(['role' => '1']); //on trouve et on recupere tout donc active =1; dans la vue
        $users = $this->paginate($using);
        $this->set(compact('users'));

    }

    function voting($id = null)
    {
        $this->autoRender = false;
        $time = Chronos::now();


        $votes = TableRegistry::getTableLocator()->get('votes');
        $voteLists = TableRegistry::getTableLocator()->get('VoteLists');
        //  $users=TableRegistry::getTableLocator()->get('Users');
        // Récupère le temps actuel.

        // le groupe actuel de voteur
        $group = $this->request->getSession()->read('Auth.User.n_group');

        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->get($id, [
            'contain' => [],
            'condition' => ['n_group' => $group]
        ]);
        $post = $user->get('post');


// "-2209078800"
        //  $date->format("U");
// false

        // die($date->getTimestamp());
        //recuperons le programme des election.
        //*date de commencement
        /*   $start_elect=$voteLists->Find()->where(['n_group'=>$group])->first();
          $temp_debut=$start_elect->get('start_election');

           $temp_fin=$start_elect->get('end_election');*/

        // $s= substr($time, date_timestamp_get(FrozenTime::createFromMutable($start_elect)));

        // $times = new Time('2000-04-20');
        //$ss=  $times->i18nFormat(Time::UNIX_TIMESTAMP_FORMAT);

        /*  // $time->format('y-m-d H:i:s');
           //$time->toUnixString();
        //  $ss= Time::parse($time);
          // $start = Time::parse($time);
          // $ss->i18nFormat('yyyy-MM-dd HH:mm:ss');
          $dt=DateTime::createFromFormat("Y d M H:i T",'2015-06-15 08:23:45');
          $ts=strtotime($dt);
           die($ts);
           $time_input = strtotime($time);
           $date_input = getDate($time_input);*/

        $start_elect = $voteLists->find()->where(['n_group' => $group])->first();
        $start_electe = $start_elect->get('start_election');

        //*date de fin
        $end_elect = $voteLists->find()->select(['end_election'])->where(['n_group' => $group])->andWhere(['end_election >= now()'])->first();

        /*$start= new DateTime($start_elect);
         $end= new DateTime($end_elect);*/
//$res=$start->diff($end);
//die($res);

        //temps restant
        //$res_temp_start=$start_elect- strtotime($time);

        // $res_temp_end=strtotime($end_elect)-strtotime($time);


        if ($start_elect == true and $end_elect == true) {
            //verifier si le voter a dejà voter.
            // $secret_vote=$voteLists->find()->select(['vote_secret'])->where(['n_group'=>$group])->andWhere(['start_election <= now()'])->andWhere(['end_election >= now()'])->first();
            $secret_vot = $voteLists->find()->where(['n_group' => $group])->andWhere(['start_election <= now()'])->andWhere(['end_election >= now()'])->first();
            $secret_voter = $secret_vot->get('vote_secret');

            // $poste=$users->find()->select(['post'])->where(['n_group'=>$group])->andWhere(['ID'=>$id])->first();

            $id_voter1 = $this->request->getSession()->read('Auth.User.id');
            $voter_name = $votes->find()->where(['n_group' => $group])->where(['id_user' => $id_voter1])->where(['vote_secret' => $secret_voter])->andWhere(['vote_name' => $post])->first();
            // $voter_id= $votes->find()->select('id_user')->where(['n_group'=>$group])->where([]);

//vote_name verifie sil ya dejà des info dans concernant ce vote
            if ($voter_name) {
                $this->Flash->error(__('Vous avez déjà voter. Merci de patienter pour les résultats.'));
                return $this->redirect(['controller' => 'users', 'action' => 'candidat']);
            } else {

                /* $session = $this->getRequest()->getSession();
                 $ids = $session->read('Auth.User.id');*/
                //enregistrement du vote
                $voters = TableRegistry::getTableLocator()->get('Votes');
                $votes = $voters->newEntity();
                //$verify = $userTable->find('all')->where(['id' => $ids])->first();


                $votes->id_user = $id_voter1;
                $votes->vote_name = $post;
                $votes->vote_secret = $secret_voter;
                $votes->n_group = $group;
                if ($voters->save($votes)) {
                    $query = $users->query();
                    $query->update()
                        ->set($query->newExpr('voice = voice + 1'))
                        //ajoute un lorsque l'individu vote
                        ->where(['id' => $id]);
                    if ($query->execute()) {
                        $this->Flash->success(__('Operation executée avec succès'));
                    }

                    $this->Flash->success(__('Merci votre voix a été prise en compte'));
                    return $this->redirect(['controller' => 'admins', 'action' => 'index']);
                } else {
                    $this->Flash->error(__('Vote non effectué! Veuillez réessayer'));
                    return $this->redirect(['controller' => 'users', 'action' => 'candidat']);
                }
            }


        } else {
            $this->Flash->error(__('Désolé auccune vote n\'est programmée'));
            return $this->redirect($this->referer());
        }
    }


    public function result()
    {
        $admin = TableRegistry::getTableLocator()->get('Users');
        $votes = TableRegistry::getTableLocator()->get('votes');
        $voteLists = TableRegistry::getTableLocator()->get('VoteLists');
//dabord recupere le groupe de l'utilisateur n_group dans la session
        $session = $this->getRequest()->getSession();
        $group = $session->read('Auth.User.n_group'); //notre session ne stocke que le id, le username
        $secret_vot = $voteLists->find()->where(['n_group' => $group])->first();
        if ($secret_vot == null) {
            //$this->Flash->error(__('Auccun résultat n\'est disponible'));
        } else {


            $fin_vote = $secret_vot->get('end_election');
            //convert to second
            $time = Chronos::now()->getTimestamp();

            $fin_second = $fin_vote->getTimestamp();


            if ($fin_second - $time > 0) {
                $this->Flash->error(__('Merci de patienter! Un vote est en cours Les resultats seront connus:  ' . $fin_vote));
                return $this->redirect($this->referer());
            }
        }


        $using = $admin->find('all')->order(['voice' => 'DESC', 'post' => 'ASC'])->where(['n_group' => $group])->andWhere(['active' => 1 and ['role' => '1']]); //on trouve et on recupere tout donc active =1; dans la vue
        $users = $this->paginate($using);
        $this->set(compact('users'));


//ensuite verifie  que son compte est active et son role est 1=candidat


    }
}
