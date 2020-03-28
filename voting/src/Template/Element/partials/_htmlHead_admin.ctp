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
        'css_nice_admin/style.css', 'css_nice_admin/themes/all-themes.css'
    ]) ?>
    <?= $this->fetch('css') ?>

    <?= $this->fetch('meta') ?>

    salut je vois riens-->
    <!-- Jquery Core Js -->

    <?php echo $this->Html->script(['js_nice_admin/jquery.countTo.js', 'js_nice_admin/waves.js', 'js_nice_admin/bootstrap-select.js', 'js_nice_admin/bootstrap.js', 'js_nice_admin/jquery.min.js',
        'js_nice_admin/raphael.min.js', 'js_nice_admin/morris.js', 'js_nice_admin/Chart.bundle.js', 'js_nice_admin/admin.js', 'js_nice_admin/index.js', 'js_nice_admin/demo.js',
        'js_nice_admin/jquery.slimscroll.js']); ?>


    <!--Flot Charts Plugin Js -->
    <!--
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>
    -->
    <!-- Sparkline Chart Plugin Js -->
    <!--<script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
    -->

    <!-- Demo Js -->
    <!--<script src="js/demo.js"></script>-->
    <?= $this->fetch('script') ?>
</head>
