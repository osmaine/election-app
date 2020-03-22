<div class="alert-success">
    <h3>Votre compte est activé avec succès. Veuillez vous reconnectez</h3>
    <?= $this->Html->link('Connexion', ['controller' => 'Admins', 'action' => 'login', 'class' => 'btn btn-outline-success']) ?>
</div>
<div>
    le code d'adhésion à votre groupe est <h4 class="alert-success"><?= $n_group ?></h4>
</div>
