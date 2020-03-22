<head>

    <?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application for remote vote">
    <meta name="author" content="Ousmane NOMBRE">

    <title><?php echo __('Accueil') ?></title>

    <!-- Custom fonts for this template
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
--><?= $this->Html->css('css/all.min.css') ?>
    <?= $this->Html->css('css/all.css') ?>
    <?= $this->Html->css('bootstrap1.min') ?>
    <!-- Page level plugin CSS
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
--><?= $this->Html->css('css/dataTables.bootstrap4.css') ?>
    <!-- Custom styles for this template
    <link href="css/sb-admin.css" rel="stylesheet">-->
    <?= $this->Html->css('css/sb-admin.css') ?>
    <?php echo $this->fetch('css'); ?>


</head>
