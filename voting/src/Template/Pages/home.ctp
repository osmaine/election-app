<?php echo $this->Html->css(['logoTitle', 'styl-user-img']);
echo $this->fetch('css'); ?>
<style>
    .register {
        background: -webkit-linear-gradient(left, #122b40, #09ac70);
        margin-top: 12%;
        padding: 6%;
    }
</style>
<div class="logo register"><a href="#"><?= __('Woguedan : Application de vote à distance') ?></a></div>

<div class="jumbotron" style="background:#1a2732 ">
    <div>
        <h6><?php echo _('Bienvenue sur sur votre application Woguedan.</br>L\'application qui vous permet de voter tout en restant chez vous.</br>Elle s\'adresse particulierement aux entreprises, aux étudiants, aux éleves qui souhaitent élirent leurs réprésentants.') ?>
            <h5>
                <a class="btn btn-warning" href="<?php echo $this->Url->build('/admin/add') ?>">
                    <h5><?php echo _('Cliquer ici pour créer votre espace de vote') ?></h5></a>
    </div>
    <div><h1 class="title"
             style="color:wheat; text-align: center; background: -webkit-linear-gradient(left, #122b40, #09ac70);border: #1c7430 solid 2px">
            Simplicité-Rapidité-Securité</h1></div>

</div>

