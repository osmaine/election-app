<?php //echo $this->Html->css(array('bootstrap.min'));
echo $this->fetch('css'); ?>

<?php echo $this->Html->script('jquery.slim');
echo $this->Html->script('jquery');
echo $this->Html->script('bootstrap');

echo $this->fetch('script'); ?>

<style>
    .hov:hover {

        background: green;

    }

    a:hover {
        background: navy;
    }

    .logo1 :hover {
        color: #c0a16b;
    }

    .logo1:hover {
        color: #c0a16b;
    }

    .logo1 {

        color: darkorange;
        font-family: Impact, sans-serif;
        font-size: 150%;
        border: solid #30ac9f 5px;

    }


    .lite {
        color: #02111b;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-success" style="font-size: x-large">
    <!--<a class="navbar-brand" href="#">WoguedanApp Vote</a>-->
    <a href="" class="logo1">Wogued@n <span class="lite">Vote</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="">
                <?= $this->Html->link('Accueil', array('controller' => 'pages', 'action' => 'display', 'Home'), ['class' => 'nav-link']); ?>
            </li>
            <li class="">
                <?php echo $this->Html->link('Connexion', ['controller' => 'Pages', 'action' => 'conchoice'], ['class' => 'nav-link']); ?>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false"> Inscription</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">


                    <a class="dropdown-item hov"
                       href="<?php echo $this->Url->build('/admin/add') ?>"><?php echo __('Créer un groupe de vote') ?></a>

                    <a class="dropdown-item hov"
                       href="<?php echo $this->Url->build('/user/add') ?>"><?php echo __('Candidat') ?></a>
                    <a class="dropdown-item hov"
                       href="<?php echo $this->Url->build('/user/add') ?>"><?php echo __('Electeur') ?></a>
                </div>
            </li>
            <li class="">
                <?php echo $this->Html->link(__('Contact'), ['controller' => 'Pages', 'action' => 'rad'], ['class' => 'nav-link']); ?>
            </li>
            <li class="">
                <a class="nav-link" href=""><?php echo __('A propos') ?></a>
            </li>


        </ul>
        <form class="form-inline my-2 my-lg-0">

            <?php
            if ($this->getRequest()->getSession()->read('Auth.User.role') == 2) {
                echo $this->Html->link('Deconnexion', '/admin/logout', ['class' => 'btn btn-secondary my-2 my-sm-0']);

            } elseif ($this->getRequest()->getSession()->read('Auth.User.role') == 3) {
                echo $this->Html->link('Deconnexion', '/user/out', ['class' => 'btn btn-secondary my-2 my-sm-0']);
            } elseif ($this->getRequest()->getSession()->read('Auth.User.role') == 1) {
                echo $this->Html->link('Deconnexion', '/user/out', ['class' => 'btn btn-secondary my-2 my-sm-0']);
            } else {
                echo $this->Html->link('S\'identifier', '/pages/conchoice', ['class' => 'btn btn-secondary my-2 my-sm-0']);

            }
            ?>

        </form>
    </div>
</nav>

