<div class="jumbotron">
    <td>
        <li class="">
            <?= $this->Html->link(' Groupe de vote existant', array('controller' => 'Cons', 'action' => 'A'), ['class' => 'btn btn-outline-primary']); ?>
        </li>
    </td>
    <td>
        <li class="">
            <?= $this->Html->link('Nouveau groupe de vote', array('controller' => 'Admins', 'action' => 'register'), ['class' => 'btn btn-outline-success']); ?>
        </li>
    </td>
</div>
