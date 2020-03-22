<p>
    Cher(e)<h4><?= $name; ?></h4>
</p>
<p><?php echo $this->Html->link('Activer mon compter', ['controller' => 'Admins', 'action' => 'verification', $mytoken, '_full' => true]); ?></p>
