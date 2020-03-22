<?php

namespace App\Controller\User;

use App\Controller\AppController;
use Cake\Chronos\Chronos;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;
use Cake\ORM\TableRegistry;


use Cake\Utility\Security;

/**
 * Users Controller
 *
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * @throws \Exception
     * @var \App\Controller\Component\UsersComponent|bool|\Cake\Controller\Component\UsersComponent|object|\Users|\UsersComponent
     */


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadComponent('Security');
        //  $this->Security->setConfig('blackHoleCallback', 'blackhole');

        if ($this->request->getParam('action') === 'login') {
            $this->loadComponent('Recaptcha.Recaptcha');
        }
        if ($this->request->getParam('action') === 'add') {
            $this->loadComponent('Recaptcha.Recaptcha');
        }
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout', 'confirm', 'forget', 'ver']);
        if ($this->request->getSession()->read('Auth.User.id')) {
//me permet d'afficher le layout 'admin' si l'utilisateur est connecte sinon afficher admintest
            $this->viewBuilder()->setLayout('user');
        } else $this->viewBuilder()->setLayout('usertest');
    }


    function emailConfig()
    {
        $this->Flash->success('Enregistrement réussi! Veuilez confirmer votre compte en cliquant sur le lien envoyé dans votre mail', ['key' => 'message']);
        TransportFactory::setConfig('mailtrap', [
            'host' => 'smtp.mailtrap.io',
            'port' => 2525,
            'username' => '8d9f5d55a6d189',
            'password' => '409f0925eadc8f',
            'className' => 'Smtp'
        ]);
        /*
                $mj = new \Mailjet\Client('cbf21dd7557a2cf97222f51a7a8a675b','078dc157e6a934cc2a17d056fc803937',true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "nombroni@gmail.com",
                        'Name' => "ousmane"
                    ],
                    'To' => [
                        [
                            'Email' => "nombroni@gmail.com",
                            'Name' => "ousmane"
                        ]
                    ],
                    'Subject' => "Greetings from Mailjet.",
                    'TextPart' => "My first Mailjet email",
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());

        */
    }

    public function verification($token)
    {

        $adminTable = TableRegistry::getTableLocator()->get('users');
        $verify = $adminTable->find('all')->where(['token' => $token])->first();
        $verify->active = '1';

        $adminTable->save($verify);
    }


    public function login()
    {
        //$this->render('/pages/login');

        if ($this->request->getSession()->read('Auth.User.id')) {
            if ($this->request->getSession()->read('Auth.User.role') == '3') {
                return $this->redirect('/user/voter');
            } elseif ($this->request->getSession()->read('Auth.User.role') == '1')
                return $this->redirect('/user/candid');
        } else {


            if ($this->request->is('post')) {
                //if ($this->verifyRecatpcha($this->request->getData())) {
                $user = $this->Auth->identify();

                if ($user) {

                    $this->Auth->setUser($user);
                    // return $this->redirect('/user/candid');

                    if ($this->request->getSession()->read('Auth.User.role') == '3') {
                        return $this->redirect('/user/voter');
                    } elseif ($this->request->getSession()->read('Auth.User.role') == '1') {
                        return $this->redirect('/user/candid');
                    }
                }
                $this->Flash->error(__('Invalid username or password.'));
                /*} else{
                    $this->Flash->error(__('Please check your Recaptcha Box.'));
                }*/
            }
        }
        // $this->set('user', $user);
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index1()
    {

        $VoteLists = TableRegistry::getTableLocator()->get('VoteLists');
        $voteLists = $this->paginate($VoteLists->find('all')->where(['n_group' => $this->request->getSession()->read('Auth.User.n_group')]));

        $this->set(compact('voteLists'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userz = TableRegistry::getTableLocator()->get('Users');
        if ($this->getRequest()->getSession()->read('Auth.User')) {
            $this->Flash->error(__('Vous n\'avez pas le droit d\'effectuer cette action'));
            return $this->redirect(['action' => 'electeur']);
        } else
            $user = $this->Users->newEntity();
        // $this->Flash->error(__('Please check your Recaptcha Box.'));

        if ($this->request->is('post')) {
            $this->request->field['post'] = 'neant';
            if ($this->verifyRecatpcha($this->request->getData())) {
                $phone = TableRegistry::getTableLocator()->get('Phones');
                $b = $this->request->getData(['phone']);

                $num = $phone->find()->select(['phone'])->where(['phone' => $b])->andWhere(['n_group' => $this->request->getData(['n_group'])])->first();
                // num permet de verifier si l'enregistreur a mi un numero se trouvant dans phone;

                if ($num) {
                    /* $verif_Email = $userz->find()->select(['email'])->where(['email' =>$this->request->getData(['email'])])->andWhere(['n_group' => $this->request->getData(['n_group'])])->first();

                     if($verif_Email){
                         $this->Flash->error(__('Cet email déjà utilisé'));
                     } else
                     $verif_phone = $userz->find()->select(['phone'])->where(['phone' =>$this->request->getData(['phone'])])->andWhere(['n_group' => $this->request->getData(['n_group'])])->first(); //verifie si ce num est deja utilise dans ce goupe

                     if ($verif_phone){
                         $this->Flash->error(__('Ce numéro est dejà utilisé'));
                     } else {*/
                    $mytoken = hash('sha512', sha1(rand() . uniqid() . time()));//faire un code aleatoire puis le hasher
                    $user->token = $mytoken;//donne la valeur de du random la à token

                    $signupValid = $this->Users->getValidator('Sign');
                    $signu = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => $signupValid]);
                    if ($signu->getErrors()) {
                        debug($signu->getErrors());
                        $this->Flash->error(__('Veuillez remplir correctement le formulaire'));
                    } else {
                        $tok = $this->reset();
                        if ($this->request->getData(['role']) == 3) {

                            $user->post = 'neant';
                        }

                        $user->token = $tok;
                        $user->active = 1;
                        if ($this->Users->save($user)) {
                            $this->set($tok);
                            /*   $linking = ['controller' => 'users', 'action' => 'verification', $mytoken];

                               TransportFactory::setConfig('gmail', [
                                   'host' => 'smtp.gmail.com',
                                   'port' => 25,
                                   'username' => 'ousmanenombre173@gmail.com',
                                   'password' => 'boughrara..00',
                                   'className' => 'Smtp',
                                   'client' => null,
                                   'tls' => false
                               ]);
                               $email = new Email();

                               $email->setTransport('smtp');
                               //$email->setEmailFormat('Html');
                               $email->setEmailFormat('html');
                               $email->setFrom('ousmanenombre173@gmil.com');
                               $email->viewBuilder()->setTemplate('emailtemp');
                               $email->setSubject('S\'il vous plait , Veuillez confirmer votre compte');
                               $email->setTo($this->request->getData('email'));
                               $name = $this->request->getData('nom');
                               $email->setviewVars(['name' => $name, 'linking' => $linking, 'mytoken' => $mytoken]);
                               $email->send();
                               // Create user binding. This is optional as binding is not required to send SMS notifications.*/
                            //$this->viewVars=['kot'=>$tok];


                            $this->Flash->success(__('Vos données ont été enregistrées avec succès'));
                            $this->set(['stock' => $tok]);

                            return $this->redirect(['prefix' => 'user', 'controller' => 'users', 'action' => 'confirm', $tok]);


                        }

                    }
                    $this->Flash->error(__('The user could not be saved. Please, try again'));
                } else {
                    $this->Flash->error(__('Désolé vous n\'êtes pas autorisé à vous inscrire. Veuillez verifier votre numero de téléphone ou votre code de groupe ou consulter votre administrateur'));
                }
            } else {
                $this->Flash->error(__('Please check your Recaptcha Box.'));
            }
        }
        $this->set(compact('user'));

    }

    function reset()
    {

        $code = array_merge(range('A', 'Z'), range('0', '9'));
        shuffle($code);
        $reset = array_slice($code, 0, 6);
        return implode('', $reset);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        //$user = TableRegistry::getTableLocator()->get('Users');
        $ids = $this->request->getSession()->read('Auth.User.id');
        $role = $this->request->getSession()->read('Auth.User.role');
        if ($id == $ids and $role = 1) {//verifie moi que lentite à modifier appartient à celui qui est connecté
            $user = $this->Users->get($id, [
                'contain' => [],
            ]);
            if ($this->request->is(['patch', 'post', 'put']) and !empty($this->request->getData())) {
                $currentDir = getcwd();
                $uploadDirectory = "img/Imginternet/";
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
                    $this->Flash->error(__('This file is more than 1MB. Sorry, it has to be less than or equal to 1MB'));
                    // $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
                } else {


                    /* $fileName = $this->request->data['photo']['name'];
                     $uploadPath = 'img/Imginternet/';*/
                    // $uploadFile = $uploadPath.$fileName;
                    $nomImage = md5($id) . '.' . $extension;

                    $uploadFile = $uploadDirectory . $nomImage;
                    if (!empty($fileTmpName)) {
                        $ancien_img = $this->Users->find('all')->Where(['ID' => $id])->first()->get('photo');

                        if (file_exists($ancien_img)) {
                            unlink($ancien_img);
                            //move_uploaded_file($fileTmpName, $uploadFile);
                        }
                        move_uploaded_file($fileTmpName, $uploadFile);
                        // $this->request->data['photo']=$uploadFile;
                        //$this->request->getData('photo',$uploadFile);
                        //$edit = $this->Users->getValidator('Edit');
                        $user = $this->Users->patchEntity($user, $this->request->getData());
                        $user->photo = $uploadFile;
                        // $user->nom= $nomImage;
                        // $update_user->role  = $this->request->getData('prenom');

                    }


                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));
                        if ($this->request->getSession()->read('Auth.User.role') == 1) {
                            return $this->redirect(['action' => 'candidat']);
                        } else {
                            return $this->redirect(['action' => 'electeur']);
                        }

                    }
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        } else {
            if ($this->request->getSession()->read('Auth.User.role') == 1) {
                $this->Flash->error(__('Vous n\'avez pas le droit de modifier'));
                return $this->redirect('/user/candid');
            } elseif ($this->request->getSession()->read('Auth.User.role') == 3) {
                $this->Flash->error(__('Vous n\'avez pas le droit de modifier'));
                return $this->redirect('/user/voter');
            }
        }

        $this->set(compact('user'));
        // $this->set('_serialize', ['user']);
    }

//resultat

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $ids = $this->request->getSession()->read('Auth.User.id');
        if ($id == $ids) {//verifie moi que lentite à supprimer appartient à celui qui est connecté
            $this->request->allowMethod(['post', 'delete']);
            $user = $this->Users->get($id);
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('The user has been deleted.'));
            } else {
                $this->Flash->error(__('Opération échoué.Veuillez ressayer encore.'));
            }
        } else {
            $this->Flash->error(__('Vous n\'avez pas le droit de supprimer'));

        }
        return $this->redirect('/user/voter');


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
            // $this->Flash->error(__('Auccun résultat n\'est disponible'));
        } else {
            $fin_vote = $secret_vot->get('end_election');
            //convert to second
            $fin_second = $fin_vote->getTimestamp();
            $time = Chronos::now()->getTimestamp();
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


//fonction pour afficher les candidats

    public function electeur()
    {
        /*$time = Time::now();
        $ss= $time->getTimestamp();
        die($ss);*/
        $user = TableRegistry::getTableLocator()->get('Users');
        //$session=$this->request->getSession()->read('User.email');
        //debug($session);
        $session = $this->getRequest()->getSession();
        $group = $session->read('Auth.User.n_group'); //notre session ne stocke que le id, le username
        $using = $user->find('all')->order(['nom' => 'ASC', 'prenom' => 'ASC'])->where(['n_group' => $group])->andWhere(['active' => 1])->andWhere(['role' => 3]); //on trouve et on recupere tout donc active =1; dans la vue
        $users = $this->paginate($using);
        $this->set(compact('users'));
    }

    public function candidat()
    {
        $candid = TableRegistry::getTableLocator()->get('Users');

//dabord recupere le groupe de l'utilisateur n_group dans la session
        $session = $this->getRequest()->getSession();
        $group = $session->read('Auth.User.n_group'); //notre session ne stocke que le id, le username

//ensuite verifie  que son compte est active et son role est 1=candidat
        $using = $candid->find('all')->order(['post' => 'ASC', 'nom' => 'ASC', 'prenom' => 'ASC'])->where(['n_group' => $group])->andWhere(['active' => 1])->andWhere(['role' => '1']); //on trouve et on recupere tout donc active =1; dans la vue
        $users = $this->paginate($using);
        $this->set(compact('users'));

    }


    /*$adminTable=TableRegistry::getTableLocator()->get('users');
            $verify=$adminTable->find('all')->where(['token'=>$token])->first();
            $verify->active='1';*/

    public function vote($id = null)
    {
        if ($this->getRequest()->getSession()->read('Auth.User.statut') == 1) {
            $this->Flash->error(__('Vous avez deja vote.'));
//permet de voir si l'individu a deja vote
        } else {
            //$user = $this->Users->get($id);
            $users = TableRegistry::getTableLocator()->get('Users');
            $query = $users->query();
            $query->update()
                ->set($query->newExpr('voice = voice + 1'))
                //ajoute un lorsque l'individu vote
                ->where(['id' => $id]);
            $session = $this->getRequest()->getSession();
            $ids = $session->read('Auth.User.id');
            $userTable = TableRegistry::getTableLocator()->get('Users');
            $verify = $userTable->find('all')->where(['id' => $ids])->first();
            $verify->statut = 1;
            if ($userTable->save($verify) && ($query->execute())) {
                $this->Flash->success(__('Merci votre voix a été prise en compte'));
                return $this->redirect('/user/candid');
            } else {
                $this->Flash->error(__('Vote non effectué! Veuillez réessayer'));
            }
        }

    }

    public function admin()
    {

        $admin = TableRegistry::getTableLocator()->get('Admins');

//dabord recupere le groupe de l'utilisateur n_group dans la session
        $session = $this->getRequest()->getSession();
        $group = $session->read('Auth.User.n_group'); //notre session ne stocke que le id, le username

//ensuite verifie  que son compte est active et son role est 1=candidat
        $using = $admin->find('all')->order(['nom' => 'ASC', 'prenom' => 'ASC'])->where(['n_group' => $group])->andWhere(['active' => 1])->andWhere(['role' => '2'])->andWhere(['no_edit' => '1']); //on trouve et on recupere tout donc active =1; dans la vue
        $admins = $this->paginate($using);
        $this->set(compact('admins'));

    }

    public function viewadmin($id = null)
    {
        $admin = TableRegistry::getTableLocator()->get('Admins');
        $admin = $admin->get($id, [
            'contain' => [],
        ]);

        $this->set('admin', $admin);
    }

    public function ver()
    {
        if ($this->request->is('post') and !empty($this->request->getData())) {
            $my_username = $this->request->getData(['username']);
            $my_reset = $this->request->getData(['token']);
            $usertable = TableRegistry::getTableLocator()->get('Users');
            $user = $usertable->find()->select(['token'])
                ->where(['token' => $my_reset])
                ->andWhere(['username' => $my_username])->first();
            if ($user) {
                // $this->Flash->success(__('Vos données ont été enregistrées avec succès'));
                // $this->set(['stock' => $tok]);

                // return $this->redirect('/user/users/forget/'.$my_username.$my_reset);
                return $this->redirect(['prefix' => 'user', 'controller' => 'users', 'action' => 'forget', $my_username, $my_reset]);
                //return $this->redirect('/user/forget'.$my_username,$my_reset);

            } else {
                $this->Flash->error(__('Nom d\'utilisateur ou code de rénitialisation incorrecte'));
            }
        }
    }

//pannel de notification

    public function confirm($tok)
    {
        $this->viewVars = ['tok' => $tok];
    }

    public function forget($my_username, $my_reset)
    {
        if ($this->getRequest()->getSession()->read('Auth.User')) {
            $this->Flash->error(__('Vous n\'avez pas le droit d\'effectuer cette action'));

        } else
            //$user = $this->Users->newEntity();
            $usertable = TableRegistry::getTableLocator()->get('Users');
        if ($this->request->is('post') and !empty($this->request->getData())) {
            $my_pass = $this->request->getData(['password']);
            $user = $usertable->find('all')
                ->where(['username' => $my_username])
                ->andWhere(['token' => $my_reset])->first();
            $user->password = $my_pass;
            $tok = $this->reset();
            $user->token = $tok;
            if ($usertable->save($user)) {


                $this->Flash->success(__('Merci votre mot de passe a été modifier avec succès'));
                $this->viewVars = ['tok' => $tok];
                // return $this->redirect('/user/confirm/'.$tok);
                return $this->redirect(['prefix' => 'user', 'controller' => 'users', 'action' => 'confirm', $tok]);

            } else  $this->Flash->error(__('Désolé! opération non éffectuée'));

        }
        // $hashids = new Hashids(Configure::read('Hashid.key'), Configure::read('Hashid.length'), Configure::read('Hashid.characters'));
        //$id = $hashids->decodeHex($eid);


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
        $start_elect = $voteLists->Find()->select(['start_election'])->where(['n_group' => $group])->andWhere(['start_election <= now()'])->first();

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
                    return $this->redirect(['controller' => 'users', 'action' => 'candidat']);
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
}
