<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?>

            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->ID], ['class' => 'btn btn-warning', 'confirm' => __('Are you sure you want to delete # {0}?', $user->ID)]) ?>

            <?= $this->Form->postLink(__('Ajouter comme nouvel administrateur'), ['controller' => 'admins', 'action' => 'converter', $user->ID], ['class' => 'btn btn-primary', 'confirm' => __('Vous êtes sûr de rendre administrateur {0}', $user->nom . ' ' . $user->prenom) . '?']) ?>
    </ul>
</nav>
<div class="card mb-lg-4 " style="max-width: 90%; border: solid 4px #007ba4">
    <div class="row no-gutters">
        <div class="col-md-4">
            <!--<img src="..." class="card-img" alt="...">-->
            <?php echo $this->Html->image('/' . h($user->photo), ['class' => 'card-img']) ?>
        </div>
        <div class="col-md-8" style="border: solid 4px #007ba4">
            <div class="card-body">
                <h5 class="card-title"><?php echo __('Profil'); ?></h5>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Prénom') ?></span>:<span class="col-8"
                                                                                                     style="font-size: 18px; color: #843534"><?= mb_strtoupper(h($user->prenom)) ?></span>
                    </p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Nom') ?></span>:<span class="col-8"
                                                                                                  style="font-size: 18px; color: #843534"><?= mb_strtoupper(h($user->nom)) ?></span>
                    </p>
                </div>

                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Nom d\'utilisateur') ?></span>:<span
                            class="col-8"
                            style="font-size: 18px; color: #843534"><?php if ($this->request->getSession()->read('Auth.User.id') == $user->ID) {
                                echo h($user->username);
                            } else {
                                echo '-';
                            } ?></span></p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Téléphone') ?></span>:<span class="col-8"
                                                                                                        style="font-size: 18px; color: #843534"><?php echo h($user->phone); ?></span>
                    </p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Sexe') ?></span>:<span class="col-8"
                                                                                                   style="font-size: 18px; color: #843534"><?php
                            if (mb_strtoupper(h($user->sexe)) == 'F') {
                                echo(__('Feminin'));
                            } else {
                                if (h($user->sexe) == 'H') {
                                    echo(__('Masculin'));
                                }
                            }
                            ?></span></p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Code de groupe') ?></span>:<span
                            class="col-8" style="font-size: 18px; color: #843534"><?php echo h($user->n_group) ?></span>
                    </p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Date de création') ?></span>:<span
                            class="col-8" style="font-size: 18px; color: #843534"><?php echo h($user->created) ?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
