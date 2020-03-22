<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" Application pour voter à distance">
    <meta name="author" content="NOMBRE OUSMANE">
    <meta name="generator" content="">
    <title>Accueil</title>
    <?php echo $this->Html->charset(); ?>
    <?php echo $this->Html->css(array('bootstrap1.min.css'));
    //echo $this->Html->css('style3');
    //echo $this->Html->css('home');

    echo $this->fetch('css'); ?>

    <?php echo $this->Html->script('jquery.slim');
    echo $this->Html->script('jquery');
    echo $this->Html->script('bootstrap');


    echo $this->fetch('script'); ?>

</head>
<body>
<?php echo $this->element('/partials/_navBar1'); ?>

<main role="main" class="container">

    <div class="starter-template">
        <?= $this->fetch('content') ?>


    </div>
</main><!-- /.container -->

</body>
<?php echo $this->element('/partials/footer1'); ?>
<?= $this->Html->script('https://www.google.com/recaptcha/api.js') ?>
</html>
