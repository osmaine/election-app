<?php echo $this->Html->css(['https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext', 'https://fonts.googleapis.com/icon?family=Material+Icons']) ?>
<?php echo $this->Html->css(['css_nice_admin/bootstrap.css', 'css_nice_admin/waves.css', 'css_nice_admin/animate.css',
    'css_nice_admin/style_for_image.css']) ?>
<?php echo $this->fetch('css'); ?>


<?php echo $this->fetch('content'); ?>


<?php echo $this->Html->script(['js_nice_admin/jquery.min.js', 'js_nice_admin/bootstrap.js', 'js_nice_admin/waves.js', 'js_nice_admin/jquery.validate.js',
    'js_nice_admin/admin.js', 'js_nice_admin/sign-in.js']); ?>
<?= $this->Html->script('https://www.google.com/recaptcha/api.js') ?>
<?php echo $this->fetch('script'); ?>


