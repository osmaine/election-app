<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $users
 */
echo $this->Html->css('css/bootstrap.min2.css');
echo $this->Html->css(['css/style.css', 'css/style-responsive.css', 'css/font-awesome.min.css']);
echo $this->Html->css('css/elegant-icons-style.css');
echo $this->fetch('css');


use Cake\Utility\Inflector; ?>
<style>
    .img-dive {
        height: 20px;
        width: 20px;
        border: double #00a6b2 2px;
        border-radius: 50%;
    }
</style>

<?= $this->Flash->render() ?>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Candidats
            </header>
            <table class="table  table-advance table-hover table-bordered">
                <thead>
                <tr style="border: #43AC6A solid 3px">
                    <th><?= 'ID' ?></th>

                    <th><i class="icon icon_profile"></i><?= mb_strtoupper(__('nom'), 'UTF-8'); ?></th>
                    <th><i class="icon_profile"></i><?= mb_strtoupper(__('Prénom'), 'UTF-8') ?></th>

                    <th><i class="icon_book"></i><?= mb_strtoupper(__('Filière'), 'UTF-8') ?></th>
                    <th><i class="icon icon_image"></i><?= mb_strtoupper(__('Poste à pourvoir'), 'UTF-8'); ?></th>
                    <th><i class="icon_group"></i><?= mb_strtoupper(__('Sexe'), 'UTF-8') ?></th>

                    <th><i class="icon_cogs"></i><?php echo mb_strtoupper(__('Action'), 'UTF-8') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($users as $user): ?>
                    <tr style="border: #43AC6A solid 3px">
                        <td><?= $i++ ?></td>

                        <td class=""><?= mb_strtoupper(h($user->nom), 'UTF-8')//permet d'afficher en majuscule    ?></td>
                        <td><?= mb_strtoupper(h($user->prenom)); //affich en Majuscul chaq debut de mot    ?></td>


                        <td><?= $user->fil ?></td>
                        <td><?php switch (mb_strtoupper(h($user->post))) {
                                case "PR":
                                    echo __('Président');
                                    break;
                                case "DG":
                                    echo __('Délégué général');
                                    break;
                                case "DGA":
                                    echo __('Délégué général Adjoint');
                                    break;
                                case "VPR":
                                    echo __('Vice-Président');
                                    break;
                                case "SG":
                                    echo __('Sécrétaire général');
                                    break;
                                case "PM":
                                    echo __('Premier ministre');
                                    break;
                                case "SGA":
                                    echo __('Sécrétaire général Adjoint');
                                    break;
                                case "CT":
                                    echo __('Chef trésorier');
                                    break;
                                case "CTA":
                                    echo __('Chef trésorier Adjoint');
                                    break;
                                case "SAC":
                                    echo __('Sécrétaire aux affaires culturelles');
                                    break;
                                case "SAAC":
                                    echo __('Sécrétaire Adjoint aux affaires culturelles');
                                    break;
                                case "SAS":
                                    echo __('Sécrétaire aux affaires sportives');
                                    break;
                                case "SAAS":
                                    echo __('Sécrétaire Adjoint aux affaires sportives');
                                    break;
                                case "SI":
                                    echo __('Sécrétaire à l\'information');
                                    break;
                                case "SAI":
                                    echo __('Sécrétaire Adjoint à l\'information');
                                    break;
                                case "A":
                                    echo __('Autres');
                                    break;

                            } ?> </td>
                        <td>   <?php
                            if (h($user->sexe) == 'F') {
                                echo(__('Feminin'));
                            } else {
                                if (h($user->sexe) == 'H') {
                                    echo(__('Masculin'));
                                }
                            } ?>
                        </td>

                        <td>
                            <div class="btn-group">

                                <?= $this->Html->link(__('Profile'), ['action' => 'view', $user->ID], ['class' => 'btn btn-primary']) ?>
                                <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->ID], ['class' => 'btn btn-warning']) ?>

                                <?php {
                                    echo $this->Form->postLink(__(' je le vote'), ['controller' => 'users', 'action' => 'voting', $user->ID], ['class' => 'btn btn-outline-success', 'confirm' => __('Etes-vous sûr de voter {0}?', $user->nom . "  " . $user->prenom)]);
                                }
                                ?>
                            </div>
                        </td>


                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
