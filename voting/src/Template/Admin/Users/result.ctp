<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin[]|\Cake\Collection\CollectionInterface $users
 */


echo $this->Html->css('css/bootstrap.min2.css');
echo $this->Html->css(['css/style.css', 'css/style-responsive.css', 'css/font-awesome.min.css']);
echo $this->Html->css('css/elegant-icons-style.css');
echo $this->fetch('css');


use Cake\I18n\Time;
use Cake\Utility\Inflector; ?>
<style>
    /* .panel-heading{
         background: #aca873;
         color: #768399;
     }
     .panel-heading1{
         background: #ac6207;
         color: #1798A5;
     }*/
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        /* Force table to not be like tables anymore */
        table, thead, tbody, th, td, tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 2px solid #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
        }

        /*
        Label the data
        */
        /* td:nth-of-type(1):before { content: "First Name"; }
         td:nth-of-type(2):before { content: "Last Name"; }
         td:nth-of-type(3):before { content: "Job Title"; }
         td:nth-of-type(4):before { content: "Favorite Color"; }
         td:nth-of-type(5):before { content: "Wars of Trek?"; }
         td:nth-of-type(6):before { content: "Secret Alias"; }
         td:nth-of-type(7):before { content: "Date of Birth"; }
         td:nth-of-type(8):before { content: "Dream Vacation City"; }
         td:nth-of-type(9):before { content: "GPA"; }
         td:nth-of-type(10):before { content: "Arbitrary Data"; }*/
    }


</style>
<?= $this->Flash->render() ?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="nav-item">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="btn btn-outline-info"><?= $this->Html->link(__('Admin'), ['controller' => 'admins', 'action' => 'index']) ?></li>
        <li class="btn btn-group btn-outline-success"><?= $this->Html->link(__('Electeur'), ['controller' => 'users', 'action' => 'electeur']) ?></li>


    </ul>
</nav>

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


                    <th><i class="icon_book"></i><?= mb_strtoupper(__('Filière'), 'UTF-8') ?></th>
                    <th><i class="icon_group"></i><?= mb_strtoupper(__('Poste'), 'UTF-8') ?></th>
                    <th><i class="icon_group"></i><?= mb_strtoupper(__('Sexe'), 'UTF-8') ?></th>
                    <th><i class="icon_group"></i><?= mb_strtoupper(__('Nombre de voix obtenues'), 'UTF-8') ?></th>

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


                        <td><?= h($user->fil) ?></td>
                        <td><?php
                            switch ($user->post) {
                                case "Pr":
                                    echo __('Président');
                                    break;
                                case "Dg":
                                    echo __('Délégué général');
                                    break;
                                case "Dga":
                                    echo __('Délégué général Adjoint');
                                    break;
                                case "Vpr":
                                    echo __('Vice-Président');
                                    break;
                                case "Sg":
                                    echo __('Sécrétaire général');
                                    break;
                                case "Pm":
                                    echo __('Premier ministre');
                                    break;
                                case "Sga":
                                    echo __('Sécrétaire général Adjoint');
                                    break;
                                case "Ct":
                                    echo __('Chef trésorier');
                                    break;
                                case "Cta":
                                    echo __('Chef trésorier Adjoint');
                                    break;
                                case "Sac":
                                    echo __('Sécrétaire aux affaires culturelles');
                                    break;
                                case "Saac":
                                    echo __('Sécrétaire Adjoint aux affaires culturelles');
                                    break;
                                case "Sas":
                                    echo __('Sécrétaire aux affaires sportives');
                                    break;
                                case "Saas":
                                    echo __('Sécrétaire Adjoint aux affaires sportives');
                                    break;
                                case "Si":
                                    echo __('Sécrétaire à l\'information');
                                    break;
                                case "Sai":
                                    echo __('Sécrétaire Adjoint à l\'information');
                                    break;
                                case "A":
                                    echo __('Autres');
                                    break;

                            }
                            ?></td>

                        <td>   <?php
                            if (h($user->sexe) == 'F') {
                                echo(__('Feminin'));
                            } else {
                                if (h($user->sexe) == 'H') {
                                    echo(__('Masculin'));
                                }
                            } ?></td>
                        <td><?= h($user->voice) ?></td>

                        <td>
                            <div class="btn-group">
                                <?= $this->Html->link(__('<i class="icon_profile"></i>Profile'), '/admin/users/view/' . $user->ID, ['class' => 'btn btn-primary', 'escape' => false]) ?>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
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
<!-- container section end -->
<!-- javascripts -->


