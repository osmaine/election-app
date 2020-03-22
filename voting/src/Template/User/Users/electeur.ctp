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


</style>

<?= $this->Flash->render() ?>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Advanced Table
            </header>
            <table class="table  table-advance table-hover table-bordered">
                <thead>
                <tr style="border: #43AC6A solid 3px">
                    <th><?= 'ID' ?></th>

                    <th><i class="icon icon_profile"></i><?= mb_strtoupper(__('nom'), 'UTF-8'); ?></th>
                    <th><i class="icon_profile"></i><?= mb_strtoupper(__('Prénom'), 'UTF-8') ?></th>

                    <th><i class="icon_book"></i><?= mb_strtoupper(__('Filière/Classe'), 'UTF-8') ?></th>
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
                        <td><?= Inflector::camelize(h($user->prenom)); //affich en Majuscul chaq debut de mot    ?></td>


                        <td><?= Inflector::camelize(h($user->fil)) ?></td>

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

                                <?= $this->Html->link(__('Profile'), ['action' => 'view', $user->ID], ['class' => 'btn btn-primary icon_profile']) ?>
                                <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $user->ID], ['class' => 'btn btn-warning']) ?>
                                <?php echo $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $user->ID], ['confirm' => __('Etes-vous sûr de vouloir supprimer {0}?', $user->nom . ' ' . $user->prenom), 'class' => 'btn btn-danger fa fa-window-close']); ?>
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
