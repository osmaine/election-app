<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin $admin
 */

echo $this->Html->css(['css/elegant-icons-style.css', 'css/style.css', 'css/style-responsive.css', 'css/font-awesome.min.css']);
echo $this->Html->css('css/bootstrap.min2.css');


echo $this->fetch('css');
?>




<?= $this->fetch('css') ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <?= $this->Html->link(__('Retour'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
        <?php
        if ($this->request->getSession()->read('Auth.User.id') != $admin->ID) {
        } else {
            echo $this->Html->link(__('Modifier mon profile'), ['action' => 'edit', $admin->ID], ['class' => 'btn btn-warning']);
        } ?>
        <?= $this->Form->postLink(__('Supprimer le compte'), ['action' => 'delete', $admin->ID], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $admin->ID)]) ?>


    </ul>
</nav>

<div class="card mb-lg-4 " style="max-width: 90%; border: solid 4px #007ba4">
    <div class="row no-gutters">
        <div class="col-md-4">
            <!--<img src="..." class="card-img" alt="...">-->
            <?php echo $this->Html->image('/' . h($admin->photo), ['class' => 'card-img']) ?>
        </div>
        <div class="col-md-8" style="border: solid 4px #007ba4">
            <div class="card-body">
                <h5 class="card-title"><?php echo __('Profil'); ?></h5>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Prénom') ?></span>:<span class="col-8"
                                                                                                     style="font-size: 18px; color: #843534"><?= h($admin->prenom) ?></span>
                    </p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Nom') ?></span>:<span class="col-8"
                                                                                                  style="font-size: 18px; color: #843534"><?= h($admin->nom) ?></span>
                    </p>
                </div>

                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Nom d\'utilisateur') ?></span>:<span
                            class="col-8"
                            style="font-size: 18px; color: #843534"><?php if ($this->request->getSession()->read('Auth.User.id') == $admin->ID) {
                                echo h($admin->adminname);
                            } else {
                                echo '-';
                            } ?></span></p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Téléphone') ?></span>:<span class="col-8"
                                                                                                        style="font-size: 18px; color: #843534"><?php echo h($admin->phone); ?></span>
                    </p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Sexe') ?></span>:<span class="col-8"
                                                                                                   style="font-size: 18px; color: #843534"><?php
                            if (h($admin->sexe) == 'F') {
                                echo(__('Feminin'));
                            } else {
                                if (h($admin->sexe) == 'H') {
                                    echo(__('Masculin'));
                                }
                            }
                            ?></span></p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Code de groupe') ?></span>:<span
                            class="col-8"
                            style="font-size: 18px; color: #843534"><?php echo h($admin->n_group) ?></span></p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Date de création') ?></span>:<span
                            class="col-8"
                            style="font-size: 18px; color: #843534"><?php echo h($admin->created) ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
