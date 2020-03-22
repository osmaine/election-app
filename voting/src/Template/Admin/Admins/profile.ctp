<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin $admin
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $admin->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $admin->ID)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Admins'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="admins form large-9 medium-8 columns content">
    <?= $this->Form->create($admin) ?>
    <fieldset>
        <legend><?= __('Edit Admin') ?></legend>
        <?php
        echo $this->Form->control('nom');
        echo $this->Form->control('prenom');
        echo $this->Form->control('email');
        echo $this->Form->control('password');
        echo $this->Form->control('username');
        echo $this->Form->control('sexe');
        echo $this->Form->control('n_group');
        echo $this->Form->control('active');
        echo $this->Form->control('vote_name');
        echo $this->Form->control('token');
        echo $this->Form->control('photo', ['type' => 'file', 'label' => __('Ajouter une photo'), 'class' => 'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
