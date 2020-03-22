<div class="row">
    <div class="col-md-4 offset-4">
        <?= $this->Flash->render() ?>
        <div class="card">
            <h4 class="card-header"><?php echo __('Rénitialisation de mot de passe') ?></h4>
            <div class="card-body">
                <?php echo $this->Form->create() ?>
                <div class="form-group">
                    <?php echo $this->Form->control('username', ['label' => 'Nom d\'utilisateur', 'placeholder' => 'Username', 'class' => ($this->Form->isFieldError('username')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->control('token', ['label' => 'Code de rénitialisation', 'placeholder' => 'reset code', 'class' => ($this->Form->isFieldError('token')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                </div>

                <?php echo $this->Form->button(__('Valider'), ['class' => 'btn btn-primary']) ?>

                <?php echo $this->Form->end() ?>
                <a class="btn btn-outline-info"
                   href="<?php echo $this->Url->build('/user/log') ?>"><?php echo __('Retour à la connexion') ?></a>

            </div>

        </div>

    </div>

</div>
