<style>
    body {
        background-color: transparent;
    }
</style>

<div class="row">
    <div class="col-md-4 offset-4">
        <?= $this->Flash->render() ?>
        <div class="card">
            <h4 class="card-header"><?php echo __('Rénitialisation de mot de passe') ?></h4>
            <div class="card-body">
                <?php echo $this->Form->create() ?>

                <div class="form-group">
                    <?php echo $this->Form->control('password', ['label' => 'Nouveau mot de passe', 'placeholder' => 'New password', 'class' => ($this->Form->isFieldError('password')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->control('password2', ['type' => 'password', 'label' => 'Confirmer mot de passe', 'placeholder' => 'confirm password', 'class' => ($this->Form->isFieldError('password2')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                </div>
                <?php echo $this->Form->button(__('Valider'), ['class' => 'btn btn-primary']) ?>

                <?php echo $this->Form->end() ?>

            </div>

        </div>

    </div>

</div>
