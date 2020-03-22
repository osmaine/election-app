<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $tok
 */
echo $this->Html->css(['css/all.min.css', 'css/sb-admin.min.css'])
?>
<style>


    .register {
        background: -webkit-linear-gradient(#ac4c96, #66512c);
        margin-top: 10%;
        padding: 6%;

        /* color: #fff;*/

    }
</style>

<div class="card col-md-10 row-cols-10 register">
    <div class="card-body">
        <div>

            <div class="card-header" style="background: #43AC6A;color: white">

                <h4><i class="fa fa-info-circle"><?php echo h(__('Notification d\'inscription')) ?></i></h4>
            </div>
            <div class="alert-success"><?= $this->Flash->render() ?></div>
            <div class="card-header alert-warning"><i
                    class="fa fa-exclamation-triangle"><strong><?php echo h(__('ATTENTION')) ?></strong></i></div>
            <div class="card-header"
                 style="background: white"> <?php echo __('Le code suivant vous servira de rénitialisation en cas d\'oublie de votre <strong>mot de passe: </strong>') ?>
                <STRONG style="color: white; background: #43AC6A; font-size: 115%"><?= h($tok) ?></STRONG></div>
            <div class="bg-secondary" style="text-align: center;"><a class="btn btn-success"
                                                                     href="<?php echo $this->Url->build('/user/log') ?>"><?php echo __('Connectez-vous ici') ?></a>
            </div>
        </div>

    </div>
</div>
