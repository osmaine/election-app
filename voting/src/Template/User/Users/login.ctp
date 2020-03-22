<body class="">

<?= $this->Form->create() ?>
<div class="container">
    <div class="card card-login mx-auto mt-5" style="border-color:red ">

        <div class="card-header"
             style="background: #66512c; text-align: center; text-effect: engrave ;color: white"><?php echo __('Identifiez-vous cher utilisateur') ?></div>
        <div class="card-body" style="background: #616e56">
            <div><?= $this->Flash->render() ?></div>

            <div class="form-group">
                <div class="" style="color: white">
                    <?= $this->Form->control('username', ['label' => 'Nom d\'utilisateur', 'placeholder' => 'Username', 'class' => 'form-control', 'autofocus' => 'autofocus']); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="" style="color: white">
                    <?= $this->Form->control('password', ['label' => 'Mot de passe', 'class' => 'form-control', 'placeholder' => 'password', 'autofocus' => 'autofocus']) ?>
                </div>
            </div>

            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="<?php echo '6Le3UuEUAAAAACmFgWS85cl5Pzj5hIEBEhggazzk'; ?>"></div>
            </div>
            <a class="btn btn-outline-warning"
               href="<?php echo $this->Url->build('/') ?>"><?php echo __('Accueil') ?></a>
            <?= $this->Form->button(__('Connexion'), ['class' => 'btn btn-outline-success']); ?>
            <?php $this->Form->unlockField('g-recaptcha-response'); ?>
            <?= $this->Form->end() ?>
            ou <a class="btn btn-outline-info" href="<?php echo $this->Url->build('/user/add') ?>">Inscrivez-vous</a>


        </div>
        <a class="btn btn-outline-info"
           href="<?php echo $this->Url->build('/user/ver') ?>"><?php echo __('Mot de passe oublié?') ?></a>
    </div>
</div>
</body>
