<?php


namespace App\Controller;


class consController extends AppController
{

    public function display()
    {
        $this->autoRender = false; // veut dire considere pas cette method comme une vue
        if ($this->request->is('post') and !empty($this->request->getData())) {
            $name = $this->request->getData('selector'); //donner la reponse de la requete a name

            if ($name == 'admin') { //si name = admin
                $this->redirect('/admin/login'); // affiche la page admin
            } elseif ($name == 'candid') { // sinon va m'afficher la page candid
                $this->redirect('/user/log');
            } elseif ($name == 'electeur') {
                $this->redirect('/user/log');
            }

        } else {
            $this->redirect('/pages/conchoice');
            $this->Flash->error('Veuillez cocher un compte');
        } //si les donnee vide repartir a la page radioconnect
    }

    public function AdminConnect()
    {
// page de la preinscription

    }

    public function Adminpresinscrip()
    {

    }
}
