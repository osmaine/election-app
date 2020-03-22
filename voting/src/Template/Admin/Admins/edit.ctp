<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin $admin
 */
echo $this->Html->css(['css/for-edit'])
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">

    <?= __('Actions') ?>
    <?= $this->Html->link(__('Listes Admins'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

    <?= $this->Form->postLink(
        __('Supprimer'),
        ['action' => 'delete', $admin->ID],
        ['confirm' => __('Are you sure you want to delete # {0}?', $admin->prenom), 'class' => 'btn btn-danger']
    )
    ?>


    <?= $this->Html->link(__('Liste des electeurs'), ['action' => 'electeur'], ['class' => 'btn btn-success']) ?>
    <?= $this->Html->link(__('Liste des candidats'), ['action' => 'candidat'], ['class' => 'btn btn-success']) ?>

</nav>
<?= $this->Flash->render() ?>


<div class="container register">
    <?= $this->Form->create($admin, ['type' => 'file']) ?>
    <div class="row">
        <div class="col-md-10 register-right">

            <div class="row register-form">

                <div class="col-md-6 ">
                    <div class="form-group">
                        <?php echo $this->Form->control('prenom', ['label' => __('Prénom'), 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('nom', ['label' => __('Nom'), 'class' => 'form-control']); ?>
                    </div>


                </div>
                <div class="col-md-6 ">
                    <div class="form-group text-center" style="position: relative;">
                        <span class="img-div">
                        <div class="text-center img-placeholder" onClick="triggerClick()">

                            <h5><?php echo __('Modifier la photo') ?></h5>
                        </div>
                            <?php
                            if ($admin->photo != null) {
                                echo $this->Html->image('/' . h($admin->photo), ['onClick' => 'triggerClick()', 'id' => 'profileDisplay']);

                            } else {
                                echo $this->Html->image('/img/proff', ['onClick' => 'triggerClick()', 'id' => 'profileDisplay']);
                            }
                            ?>
                        </span>
                        <?php

                        echo $this->Form->control('photo', ['type' => 'file', 'label' => 'Enter profileImage', 'onChange' => 'displayImage(this)', 'id' => 'profileImage', 'class' => 'form-control', 'style' => 'display : none;']); ?>

                    </div>
                    <?= $this->Form->button(__('Valider'), ['class' => 'btn btn-success', 'style' => 'height:40px; width:80%; border: solid 2px orange']) ?>

                </div>

            </div>

        </div>

    </div>
    <?= $this->Form->end() ?>
</div>
<script>

    function triggerClick(e) {
        document.querySelector('#profileImage').click();
    }

    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>
