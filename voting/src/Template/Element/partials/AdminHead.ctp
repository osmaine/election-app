<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Awogdan OUSMANE NOMBRE">
    <meta name="keyword" content="<?php echo __('Vote, Vote en ligne, Vote à distance, électronique') ?>">
    <!--<link rel="shortcut icon" href="img/favicon.png">-->
    <title>

        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext', 'https://fonts.googleapis.com/icon?family=Material+Icons']) ?>
    <?= $this->Html->css(['css_nice_admin/bootstrap.css', 'css_nice_admin/waves.css', 'css_nice_admin/animate.css', 'css_nice_admin/morris.css',
        'css_nice_admin/themes/all-themes.css', 'css_nice_admin/style_for_image.css'
    ]) ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>


</head>
