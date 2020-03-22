<?php echo $this->Html->css(['bootstrap1.min', 'css/widgets', 'pricing']);

echo $this->fetch('css');

?>
<style>
    body {
        background-image: url('../img/grille.jpg');
    }

    .register {
        background: -webkit-linear-gradient(left, #122b40, #09ac70);
        margin-top: 10%;
        padding: 3%;
        border-radius: 1.0rem;

    }
</style>
<div class="container register">
    <div style="background: #c98c50; color: white; text-align: center">
        <h4> <?php echo __('Choisissez votre compte') ?></h4></div>
    <div class="card-deck">

        <div class="card btn-outline-success">
            <div class="card-body">
                <h5 class="card-header"><?php echo __('Candidat') ?></h5>

                <?php echo $this->Html->image("../img/Imgcak/candid.png", [
                    "alt" => "Chania", 'style' => "width:100%",
                    'url' => ['prefix' => 'user', 'controller' => 'users', 'action' => 'login']
                ]); ?>
            </div>

        </div>
        <div class="card btn-outline-warning">
            <div class="card-body">
                <h5 class="card-title card-header"><?php echo __('Administrateur') ?></h5>
                <?php echo $this->Html->image("../img/Imgcak/ob_843bd7_admin.png", [
                    "alt" => "Chania", 'style' => "width:100%",
                    'url' => ['prefix' => 'admin', 'controller' => 'admins', 'action' => 'login']
                ]); ?>
            </div>

        </div>
        <div class="card btn-outline-success">
            <div class="card-body">
                <h5 class="card-header"><?php echo __('Electeur') ?></h5>

                <?php echo $this->Html->image("../img/Imgcak/people.png", [
                    "alt" => "Chania", 'style' => "width:100%",
                    'url' => ['prefix' => 'user', 'controller' => 'users', 'action' => 'login']
                ]); ?>
            </div>
        </div>

    </div>


