<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;

use Cake\I18n\Time;
use Cake\Mailer\TransportFactory;

use Twilio\Rest\Client;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;


/**
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 *
 * @method \App\Model\Entity\Admin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminsController extends AppController
{
    /**
     * Index method
     *
     * @param Event $event
     * @return void
     * @throws \Exception
     */

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);


        if ($this->request->getParam('admin')) {
            $this->Security->requireSecure();
        }
        $this->loadComponent('Csrf');
        // $this->Form->unlockField('g-recaptcha-response');
        // $this->Security->setConfig('blackHoleCallback', 'blackhole');
        $this->Auth->allow(['add', 'logout', 'login2']);
        // $this->loadComponent('Recaptcha.Recaptcha');
        /*if ($this->request->getParam('action') === 'login') {
            $this->loadComponent('Recaptcha.Recaptcha');
        }*/
        if ($this->request->getParam('action') === 'add') {
            $this->loadComponent('Recaptcha.Recaptcha');
        }
        //$this-> set ('pageMainHeading', 'Admin');
        //$this->viewBuilder()->setLayout('admin');
        if ($this->request->getSession()->read('Auth.User.id') and $this->request->getSession()->read('Auth.User.no_edit') == 1) {
//me permet d'afficher le layout 'admin' si l'utilisateur est connecte sinon afficher admintest
            $this->viewBuilder()->setLayout('admin');
        } else $this->viewBuilder()->setLayout('admintest');


    }

    //generateur de code du groupe

    public function index()
    {
        $admins = $this->paginate($this->Admins->find('all')->order(['nom' => 'ASC', 'prenom' => 'ASC'])->where(['n_group' => $this->request->getSession()->read('Auth.User.n_group')])->andWhere(['active' => 1])->andwhere(['role' => '2']));//on trouve et on recupere tout donc active =1; dans la vue
        //$using = $user->find('all')->where(['n_group' => $group])->andWhere(['active' => 1])->andwhere([ 'role' => '1']); //on trouve et on recupere tout donc active =1; dans la vue

        $this->set(compact('admins'));
    }

    /**
     * View method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $admin = $this->Admins->get($id, [
            'contain' => [],
        ]);

        $this->set('admin', $admin);
    }

    public function verification($token)
    {
        $n_group = $this->codeGenerator();
        $adminTable = TableRegistry::getTableLocator()->get('admins');
        $verify = $adminTable->find('all')->where(['token' => $token])->first();
        $verify->active = '1';
        $verify->n_group = $n_group;
        $this->viewVars = ['n_group' => $n_group];
        $adminTable->save($verify);
    }

    function codeGenerator()
    {
        $code = array_merge(range('A', 'Z'), range('0', '9'), range('a', 'z'));
        shuffle($code);
        $group_n = array_slice($code, 0, 14);
        return implode('', $group_n);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $admin = $this->Admins->newEntity();
        if ($this->request->is('post')) {
            if ($this->verifyRecatpcha($this->request->getData())) {
                $admin = $this->Admins->patchEntity($admin, $this->request->getData());
                $mytoken = hash('sha512', sha1(rand() . uniqid() . time()));//faire un code aleatoire puis le hasher en fonction du temps
                $admin->token = $mytoken;
                // $admin->email=$myemail;

                if ($this->Admins->save($admin)) {

                    $linking = ['controller' => 'Admins', 'action' => 'verification', $mytoken];

                    $this->emailConfig();

                    $email = new Email('default');
                    //$email->setTransport('Smtp');
                    //$email->setEmailFormat('Html');
                    $email->setEmailFormat('html');
                    $email->setFrom('nombroni@gmail.com');
                    $email->viewBuilder()->setTemplate('emailtemp');
                    $email->setSubject('S\'il vous plait , Veuillez confirmer votre compte');
                    $email->setTo($this->request->getData('email'));
                    $name = $this->request->getData('nom');
                    $email->setviewVars(['name' => $name, 'linking' => $linking, 'mytoken' => $mytoken]);
                    $email->send();

                    // Create user binding. This is optional as binding is not required to send SMS notifications.
                    //$this->Admins->bindUser($admin);

                    // Send welcome message. if binding is disabled, do not add the last arg `true`.
                    // $this->Admins->notifyUser($admin, 'Welcome to Cake Notifier', true);

                    $this->Flash->success(__('un email vous été envoyer pour confirmer votre compte'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The admin could not be saved. Please, try again.'));

            } else {
                $this->Flash->error(__('Please check your Recaptcha Box.'));
            }
        }
        $this->set(compact('admin'));
    }

    function emailConfig()
    {
        $this->Flash->success('Enregistrement réussi!Veuilez confirmer votre compte en cliquant sur le lien envoyé dans votre mail', ['key' => 'message']);
        TransportFactory::setConfig('mailtrap', [
            'host' => 'smtp.mailtrap.io',
            'port' => 2525,
            'username' => '8d9f5d55a6d189',
            'password' => '409f0925eadc8f',
            'className' => 'Smtp'
        ]);

    }

    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*   public function edit($id = null)
        {
            $Admins=TableRegistry::getTableLocator('Admins');
            $Admins = $this->Admins->get($this->request->getSession()->read('Auth.User.id'));



            if ($this->request->is(['put']) and !empty($this->request->getData())) {
                //$admin_user->accessible('user_id', true);
                $this->admin_user->accessible('email',true);
                $this->Admins->patchEntity($Admins, $this->request->getData());
               // $admin->nom=$this->request->getData('username');
               // $admin->nom=$this->request->getData('photo');
                //$admin->nom=$this->request->getData('nom');
                   /*  if($admin->errors()){

                     }*/

    /*   if ($this->Admins->save($Admins)) {
           $this->Flash->success(__('The admin has been saved.'));

           return $this->redirect(['action' => 'index']);
       }
   }
       $this->Flash->error(__('The admin could not be saved. Please, try again.'));

   $this->set(compact($Admins));
}*/

    public function edit($id)
    {
        $ids = $this->request->getSession()->read('Auth.User.id');
        if ($id == $ids) {


            // $this->request->allowMethod(['post','edit']);
            $admin = $this->Admins->get($ids, [
                'contain' => [],
            ]);

            if ($this->request->is(['patch', 'post', 'put']) and !empty($this->request->getData())) {

                $currentDir = getcwd();
                $uploadDirectory = "img/ImgAdmin/";
                //debug($this->request->getData());
                //  $errors = []; // Store all foreseen and unforseen errors here
                // $this->request->getData(['photo','tmp_name'])
                $fileExtensions = ['jpeg', 'jpg', 'png']; // Get all the file extensions

                $fileName = $this->request->getData(['photo', 'name']);
                $fileSize = $this->request->getData(['photo', 'size']);
                $fileTmpName = $this->request->getData(['photo', 'tmp_name']);
                $fileType = $this->request->getData(['photo', 'type']);
                // $fileExtension = strtolower(end(explode('.',$fileName)));
                $extension = strtolower(pathinfo($this->request->getData(['photo', 'name']), PATHINFO_EXTENSION));

                $uploadPath = $currentDir . $uploadDirectory . basename($fileName);
                //$fileExtension = strtolower(end(explode('.',$fileName)));
                if (!in_array($extension, $fileExtensions)) {

                    $this->Flash->error(__('Please upload a JPEG or PNG file'));
                } elseif ($fileSize > 1500000) {
                    $this->Flash->error(__('This file is more than 1MB. Sorry, it has to be less than or equal to 1,5MB'));
                    // $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
                } else {


                    /* $fileName = $this->request->data['photo']['name'];
                     $uploadPath = 'img/Imginternet/';*/
                    // $uploadFile = $uploadPath.$fileName;
                    $nomImage = md5($id) . '.' . $extension;

                    $uploadFile = $uploadDirectory . $nomImage;

                    if (!empty($fileTmpName)) {
                        $ancien_img = $this->Admins->find('all')->Where(['ID' => $id])->first()->get('photo');

                        if (file_exists($ancien_img)) {
                            unlink($ancien_img);
                            //move_uploaded_file($fileTmpName, $uploadFile);
                        }
                        move_uploaded_file($fileTmpName, $uploadFile);

                        // $this->request->data['photo']=$uploadFile;
                        //$this->request->getData('photo',$uploadFile);
                        //$edit = $this->Users->getValidator('Edit');
                        //$admin = $this->Admins->patchEntity($admin, $this->request->getData());
                        //$user_data=$this->Admins->get($id);
                        // $user_data->isAccessible('photo');

                        $admin = $this->Admins->patchEntity($admin, $this->request->getData(),
                            ['validate' => 'Edit']);

                        if ($admin->getErrors() == true) {
                            $this->Flash->error(__('Verifier que les infos sont exactes'));
                        }
                        $admin->photo = $uploadFile;

                        // $user->nom= $nomImage;
                        // $update_user->role  = $this->request->getData('prenom');

                    }

                    if ($this->Admins->save($admin)) {
                        $this->Flash->success(__('The user has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                }
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));

        } else {
            //

            $this->Flash->error(__('Vous n\'avez pas le droit de modifier'));

            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('admin'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $phones = TableRegistry::getTableLocator()->get('Phones');
        $usernames = TableRegistry::getTableLocator()->get('Usernames');
        //selectionner la partie dont le 'id'=$id
        $admin_search = $this->Admins->find()->where(['id' => $id])->first();
        //admin_phone
        $admin_phone = $admin_search->get('phone');
        //admin username
        $admin_username = $admin_search->get('username');
        //group id
        $n_group = $this->request->getSession()->read('Auth.User.n_group');

        $phone = $phones->find()->where(['phone' => $admin_phone])->andWhere(['n_group' => $n_group])->first();
        $id_ph = $phone->get('ID');
        $username = $usernames->find()->where(['username' => $admin_username])->first();
        $id_username = $username->get('ID');

        $phonee = $phones->get($id_ph);

        $usernam = $usernames->get($id_username);
        if ($this->request->getSession()->read('Auth.User.Id') == $id) {

            $this->request->allowMethod(['post', 'delete']);
            $admin = $this->Admins->get($id);
            if ($this->Admins->delete($admin) and $phones->delete($phonee) and $usernames->delete($usernam)) {
                $this->Flash->success(__('Opération executée avec succes'));
                return $this->redirect(['action' => 'logout']);
            } else {
                $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
            }


        } else {


            $this->request->allowMethod(['post', 'delete']);
            $admin = $this->Admins->get($id);
            if ($this->Admins->delete($admin) and $phones->delete($phonee) and $usernames->delete($usernam)) {
                $this->Flash->success(__('Opération executée avec succes'));
            } else {
                $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }

    }

    public function login()
    {

        if ($this->request->getSession()->read('Auth.User.id')) {
            return $this->redirect(['controller' => 'admins', 'action' => 'index']);
        } else
            if ($this->request->is('post')) {
                //if($this->verifyRecatpcha($this->request->getData())){
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    return $this->redirect(['controller' => 'admins', 'action' => 'index']);
                }
                $this->Flash->error(__('Invalid username or password.'));
                /* }else{
                     $this->Flash->error(__('Please check your Recaptcha Box.'));
                 }*/
            }
    }

    public function logout()
    {
        $session = $this->request->getSession();
        $session->destroy();
        return $this->redirect($this->Auth->logout());
    }

//transform my user to admin

    public function converter($id = null)
    {
        $this->autoRender = false;
        $users = TableRegistry::getTableLocator()->get('Users');

        $user = $users->get($id, [
            'contain' => [],
        ]);
        $nom = $user->get('nom');
        $prenom = $user->get('prenom');
        $sexe = $user->get('sexe');
        $phone = $user->get('phone');
        $email = $user->get('email');
        $password = $user->get('password');
        $token = $user->get('token');
        $fil = $user->get('fil');
        $vote = $user->get('vote_name');
        $username = $user->get('username');
        $n_group = $user->get('n_group');
        $ad = TableRegistry::getTableLocator()->get('admins');

        $admin = $this->Admins->newEntity();
        $admin->token = $token;
        $admin->nom = $nom;
        $admin->prenom = $prenom;
        $admin->email = '-';
        $admin->password = 12345678;
        $admin->sexe = $sexe;
        $admin->fil = $fil;
        $admin->phone = $phone;
        //$admin->vote_name = $this->request->getSession()->read('Auth.User.vote_name');
        $admin->n_group = $n_group;
        $admin->username = $username;
        $admin->active = '1';
        $admin->role = '2';
        if ($this->Admins->save($admin)) {
            $user = $users->get($id);
            if ($users->delete($user)) {
                $this->Flash->success(__('Opération executée avec succes'));
            }
            $this->Flash->success(__('Vous avez ajouter un administrateur avec succes'));
            return $this->redirect(['controller' => 'admins', 'action' => 'index']);

        }

    }


    public function login2()
    {


        $id = $this->Auth->user('id');
        $admin = $this->Admins->get($id, [
            'contain' => []
        ]);
        // Vérification de correspondance des deux champs de mot de passe
        if ($this->request->is('post') and !empty($this->request->getData())) {
            if ($this->request->getData('password') == $this->request->getData('password2')) {
                //recuperation du nouveau mot de passe
                $admin->password = $this->request->getData('password');
                //changement du first_connect
                $admin->no_edit = 1;
                if ($this->Admins->save($admin)) {
                    $this->request->session()->write('Auth.User.no_edit', 1);
                    $this->request->session()->write('Auth.User.password', $admin['password']);
                    //$this->request->session()->write('Auth.User.zipcode', $user_data['zipcode']);

                    $this->Flash->success(__('Le mot de passe a bien été modifié.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('Les mots de passe ne correspondent pas.');
                }
            }
        }

    }


    function voting($id = null)
    {
        $votes = TableRegistry::getTableLocator()->get('votes');
        $voteLists = TableRegistry::getTableLocator()->get('voteLists');
        $users = TableRegistry::getTableLocator()->get('Users');
        // Récupère le temps actuel.
        $time = Time::now();


        // le groupe actuel de voteur
        $group = $this->request->getSession()->read('Auth.User.n_group');
        //recuperons le programme des election.
        //*date de commencement
        $start_elect = $voteLists->find()->select('start_election')->where(['n_group' => $group]);
        //*date de fin
        $end_elect = $voteLists->find()->select('end_election')->where(['n_group' => $group]);
        //temps restant
        $res_temp_start = strtotime($start_elect) - strtotime($time);
//$x= strtotime('2020/02/04');

        $res_temp_end = strtotime($end_elect) - strtotime($time);

        if ($res_temp_start <= 0 and $res_temp_end >= 0) {
            //verifier si le voter a dejà voter.
            $secret_vote = $voteLists->find()->select('vote_secret')->where(['n_group' => $group]);
            $post = $users->find()->select('post')->where(['n_group' => $group])->andWhere(['ID' => $id]);
            $id_voter1 = $this->request->getSession()->read('Auth.User.id');
            $voter_name = $votes->find()->select('vote_name')->where(['n_group' => $group])->where(['id_user' => $id_voter1])->where(['vote_secret' => $secret_vote])->andWhere(['vote_name' => $post]);
            // $voter_id= $votes->find()->select('id_user')->where(['n_group'=>$group])->where([]);


            if ($voter_name) {
                $this->Flash->error(__('Vous avez déjà voter. Merci de patienter pour les résultats.'));
            } else {
                $query = $users->query();
                $query->update()
                    ->set($query->newExpr('voice = voice + 1'))
                    //ajoute un lorsque l'individu vote
                    ->where(['id' => $id]);
                /* $session = $this->getRequest()->getSession();
                 $ids = $session->read('Auth.User.id');*/
                //enregistrement du vote
                $voters = TableRegistry::getTableLocator()->get('Votes');
                $votes = $voters->newEntity();
                //$verify = $userTable->find('all')->where(['id' => $ids])->first();
                $votes->id_user = $id_voter1;
                $votes->vote_name = $post;
                $votes->vote_secret = $secret_vote;
                $votes->n_group = $group;
                if ($voters->save($votes) && ($query->execute())) {
                    $this->Flash->success(__('Merci votre voix a été prise en compte'));
                    return $this->redirect($this->referer());
                } else {
                    $this->Flash->error(__('Vote non effectué! Veuillez réessayer'));
                }
            }


        } else {
            $this->Flash->error(__('Désolé auccune vote n\'est programmée'));
            return $this->redirect($this->referer());
        }
    }

}
