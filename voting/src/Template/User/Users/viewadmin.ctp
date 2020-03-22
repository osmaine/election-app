<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin $admin
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>

        <li><?php
            if ($this->getRequest()->getSession()->read('Auth.User.role') == 1) {
                echo $this->Html->link(__('Retour'), ['action' => 'candidat'], ['class' => 'btn btn-primary']);
            } else {
                echo $this->Html->link(__('Retour'), ['action' => 'electeur']);
            }
            ?> </li>

    </ul>
    <?= $this->Flash->render() ?>
</nav>


<?= $this->Flash->render() ?>
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
                                                                                                     style="font-size: 18px; color: #843534"><?= mb_strtoupper(h($admin->prenom)) ?></span>
                    </p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Nom') ?></span>:<span class="col-8"
                                                                                                  style="font-size: 18px; color: #843534"><?= mb_strtoupper(h($admin->nom)) ?></span>
                    </p>
                </div>


                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Téléphone') ?></span>:<span class="col-8"
                                                                                                        style="font-size: 18px; color: #843534"><?php echo h($admin->phone); ?></span>
                    </p>
                </div>
                <div class="bio-row">
                    <p><span style="color: #1a1a1a;font-size: 20px"><?= __('Sexe') ?></span>:<span class="col-8"
                                                                                                   style="font-size: 18px; color: #843534"><?php
                            if (mb_strtoupper(h($admin->sexe)) == 'F') {
                                echo(__('Feminin'));
                            } else {
                                if (mb_strtoupper(h($admin->sexe)) == 'H') {
                                    echo(__('Masculin'));
                                }
                            }
                            ?></span></p>
                </div>

            </div>
        </div>
    </div>
</div>
