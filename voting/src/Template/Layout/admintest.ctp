<?php echo $this->Html->css(['css/all', 'css/sb-admin', 'syl-admin-img.css']); ?>
<?php echo $this->fetch('css'); ?>

<body>
<div>
    <?php echo $this->fetch('content');

    ?>
</div>
</body>
<?php echo $this->Html->script(['jquery.js', 'bootstrap.js']); ?>
<?= $this->Html->script('https://www.google.com/recaptcha/api.js') ?>
<?php echo $this->fetch('script'); ?>
