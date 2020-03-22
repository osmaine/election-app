<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();
        //$this->loadComponent('Csrf');
        $this->loadComponent('Security');
        // $this->Security->setConfig('blackHoleCallback', 'blackhole');
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
        $usecaptcha = 1;
        $this->set('usecaptcha', $usecaptcha); //we can on or off captcha on website by passing  0 or 1
        // $this->loadComponent('Recaptcha.Recaptcha');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        // $this->loadComponent('Security');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('display');
        if ($this->request->getParam('prefix') === 'admin') {
            $this->viewBuilder()->setLayout('admin');
            $this->Auth->setConfig([
                'authenticate' => [
                    'Form' => [
                        'userModel' => 'Admins',
                        'fields' => ['username' => 'username'],
                        'finder' => 'Auth'
                    ],
                ],
                'loginAction' => [
                    'controller' => 'Admins',
                    'action' => 'login'
                ],
                /*'loginRedirect' => ['controller' => 'Admins',
                    'action' => 'index'
                ],*/
                'logoutRedirect' =>
                    ('/')
                ,
                'storage' =>
                    'Session',
                // 'unauthorizedRedirect' => $this->referer(),
                'unauthorizedRedirect' => false,
                'authorize' => ['Controller'],
            ]);
        } else {
//Add Auth config for users
            if ($this->request->getParam('prefix') === 'user') {
                $this->viewBuilder()->setLayout('user');
                $this->Auth->setConfig([
                    'authenticate' => [
                        'Form' => [
                            'userModel' => 'Users',
                            'fields' => ['username' => 'username'],
                            'finder' => 'Auth'
                        ],
                    ],
                    'loginAction' => [
                        'controller' => 'Users',
                        'action' => 'login'
                    ],
                    'loginRedirect' => $this->referer(),
                    'logoutRedirect' => ('/'),
                    'storage' =>
                        'Session',


//'unauthorizedRedirect' => $this->referer(),
                    'unauthorizedRedirect' => false,
                    'authorize' => ['Controller'],
                ]);
            }
        }
    }

    public function isAuthorized($user = null)
    {
//Any registered user can accesss public functions
        if (empty($this->request->getParam('prefix'))) {
            return true;
        }
        if ($this->request->getParam('prefix') === 'admin') {
            if (($user['role'] == 2) && ($user['active'] == 1) && ($user['no_edit'] == 0)) {
                return $this->redirect(['prefix' => 'admin', 'controller' => 'admins', 'action' => 'login2']);
            } elseif (($user['role'] == 2) && ($user['active'] == 1) && ($user['no_edit'] == 1)) {
                return true;
            }

        } else if ($this->request->getParam('prefix') === 'user') {
            if (($user['role'] == 3) && ($user['active'] == 1)) {
                return true;
            } elseif (($user['role'] == 1) && ($user['active'] == 1)) {
                return true;
            }
            return false;
        }
//Default deny
        return false;
    }

    public function verifyRecatpcha($aData)
    {
        if (!$aData) {
            return true;
        }
        if (isset($aData['g-recaptcha-response'])) {
            $recaptcha_secret = Configure::read('google_recatpcha_settings.secret_key');
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $aData['g-recaptcha-response'];
            $response = json_decode(@file_get_contents($url));

            if ($response->success == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
