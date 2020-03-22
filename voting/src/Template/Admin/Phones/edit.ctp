<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $phone
 */
?>


<div class="jumbotron">
    <?= $this->Flash->render() ?>
    <nav class="bg-dark">


        <?= $this->Form->postLink(
            __('Supprimer ce numéro'),
            ['action' => 'delete', $phone->ID],
            ['class' => 'btn btn-outline-warning', 'confirm' => __('Are you sure you want to delete # {0}?', $phone->ID)]
        )
        ?>
        <?= $this->Html->link(__('Listes des numéros'), ['action' => 'index'], ['class' => 'btn btn-outline-primary']) ?>

    </nav>
    <?= $this->Form->create($phone) ?>
    <div class="card">
        <div class="card-header" style="background: #c0a16b">
            <?= __('Modification') ?>
        </div>
        <div class="card-body" style="background: #1a2732">
            <div class="form-group">
                <?php
                echo $this->Form->control('phone', ['class' => 'form-control']);

                ?>
            </div>
            <div
                class="form-group"> <?= $this->Form->button(__('Valider'), ['class' => 'btn btn-outline-success']) ?></div>
        </div>
        <div class="card-footer"></div>
    </div>
    <?= $this->Form->end() ?>
</div>
