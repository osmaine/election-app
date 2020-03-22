<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoteList $voteList
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Vote List'), ['action' => 'edit', $voteList->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vote List'), ['action' => 'delete', $voteList->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $voteList->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Vote Lists'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vote List'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="voteLists view large-9 medium-8 columns content">
    <h3><?= h($voteList->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('N Group') ?></th>
            <td><?= h($voteList->n_group) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($voteList->ID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Election') ?></th>
            <td><?= h($voteList->start_election) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Election') ?></th>
            <td><?= h($voteList->end_election) ?></td>
        </tr>
    </table>
</div>
