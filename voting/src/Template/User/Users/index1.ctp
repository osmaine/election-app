<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoteList[]|\Cake\Collection\CollectionInterface $voteLists
 */

echo $this->Html->css('css/bootstrap.min2.css');
echo $this->Html->css(['css/style.css', 'css/style-responsive.css', 'css/font-awesome.min.css']);
echo $this->Html->css('css/elegant-icons-style.css');
echo $this->Html->css('css/all.min.css');
echo $this->fetch('css');
?>

<?= $this->Flash->render() ?>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading" style="font-size: large; color: black;text-align: center">
                <?php echo mb_strtoupper(__('Calendrier électoral')) ?>
            </header>
            <table class="table  table-advance table-hover table-bordered">
                <thead>
                <tr>
                    <th><?= 'ID' ?></th>
                    <th><i class="icon_calendar"></i><?= mb_strtoupper(__('Date de commencement'), 'UTF-8') ?></th>
                    <th><i class="icon_calendar"></i><?= mb_strtoupper(__('Date de fin'), 'UTF-8') ?></th>
                    <th><i class="icon_group"></i><?= mb_strtoupper(__('Groupe'), 'UTF-8') ?></th>


                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($voteLists as $voteList): ?>
                    <tr style="border: #43AC6A solid 3px">
                        <td><?= $i++ ?></td>
                        <td style="font-size: large"><strong><?= H($voteList->start_election) ?></strong></td>
                        <td style="font-size: large"><strong><?= h($voteList->end_election) ?></strong></td>
                        <td><?= h($voteList->n_group) ?></td>

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
            border: 1px solid #ccc;
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

