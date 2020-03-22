<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $admins
 */
echo $this->Html->css('css/bootstrap.min2.css');
echo $this->Html->css(['css/style.css', 'css/style-responsive.css', 'css/all.min.css']);
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
                Advanced Table
            </header>
            <table class="table  table-advance table-hover table-bordered">
                <thead>
                <tr style="border: #43AC6A solid 3px">
                    <th><?= 'ID' ?></th>

                    <th><i class="icon icon_profile"></i><?= mb_strtoupper(__('nom'), 'UTF-8'); ?></th>
                    <th><i class="icon_profile"></i><?= mb_strtoupper(__('Prénom'), 'UTF-8') ?></th>

                    <th><i class="icon_phone"></i><?= mb_strtoupper(__('Téléphone'), 'UTF-8') ?></th>

                    <th><i class="icon_book"></i><?= mb_strtoupper(__('Filière'), 'UTF-8') ?></th>
                    <th><i class="icon_group"></i><?= mb_strtoupper(__('Sexe'), 'UTF-8') ?></th>

                    <th><i class="icon_cogs"></i><?php echo mb_strtoupper(__('Action'), 'UTF-8') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($admins as $admin): ?>
                    <tr style="border: #43AC6A solid 3px">
                        <td><?= $i++ ?></td>

                        <td class=""><?= mb_strtoupper(h($admin->nom), 'UTF-8')//permet d'afficher en majuscule    ?></td>
                        <td><?= mb_strtoupper(h($admin->prenom)); //affich en Majuscul chaq debut de mot    ?></td>

                        <td><?= h($admin->phone) ?></td>
                        <td><?= mb_strtoupper(h($admin->fil)) ?></td>

                        <td>   <?php
                            if (mb_strtoupper(h($admin->sexe)) == 'F') {
                                echo(__('Feminin'));
                            } else {
                                if (mb_strtoupper(h($admin->sexe)) == 'H') {
                                    echo(__('Masculin'));
                                }
                            } ?>
                        </td>


                        <td>
                            <div class="btn-group">

                                <?= $this->Html->link(__('Profile'), ['action' => 'viewadmin', $admin->ID], ['class' => 'btn btn-primary fa fa-user']) ?>


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
