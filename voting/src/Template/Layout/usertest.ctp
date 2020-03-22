<?php echo $this->Html->css(['css/all', 'css/sb-admin', 'bootstrap1.min', 'styl-user-img.css']); ?>
<?php echo $this->fetch('css'); ?>


<body>
<div class="container"><?php echo $this->fetch('content');

    ?></div>
</body>
<?php echo $this->Html->script('jquery');
echo $this->Html->script('bootstrap.bundle.js');
echo $this->Html->script('jquery.easing');
echo $this->Html->script(['phonejs/intlTelInput.js', 'phonejs/data.js', 'phonejs/utils.js', 'phonejs/intro.js', 'jquery.js']);
echo $this->Html->script('https://www.google.com/recaptcha/api.js');

echo $this->fetch('script');


?>
