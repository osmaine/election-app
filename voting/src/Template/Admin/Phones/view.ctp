<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $phone
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Phone'), ['action' => 'edit', $phone->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Phone'), ['action' => 'delete', $phone->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $phone->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Phones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Phone'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="phones view large-9 medium-8 columns content">
    <h3><?= h($phone->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('N Group') ?></th>
            <td><?= h($phone->n_group) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($phone->ID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= $this->Number->format($phone->phone) ?></td>
        </tr>
    </table>
</div>
