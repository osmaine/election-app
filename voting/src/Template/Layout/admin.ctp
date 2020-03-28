<!DOCTYPE html>
<Html lang="fr">
<?php
echo $this->element('partials/AdminHead'); //afficher le navabaradmin dans element
?>
<body class="theme-red">
<?php
echo $this->element('partials/_navBarAdmin'); //afficher le navabaradmin dans element
?>
<?php
echo $this->element('partials/SidebarAdmin'); //afficher le navabaradmin dans element
?>
<section class="content">

    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>
        <!--widget-->
        <?php
        echo $this->element('partials/iconcardAdmin'); //afficher le navabaradmin dans element
        ?>
        <div class="row clearfix">
            <?= $this->fetch('content') ?>
        </div>

    </div>
</section>
<!-- Demo scripts for this page-->


<!-- Jquery Core Js -->

<?php echo $this->Html->script(['js_nice_admin/jquery.min.js', 'js_nice_admin/bootstrap.js', 'js_nice_admin/bootstrap-select.js', 'js_nice_admin/jquery.countTo.js', 'js_nice_admin/waves.js',
    'js_nice_admin/raphael.min.js', 'js_nice_admin/morris.js', 'js_nice_admin/Chart.bundle.js', 'js_nice_admin/admin.js', 'js_nice_admin/index.js', 'js_nice_admin/demo.js',
    'js_nice_admin/jquery.slimscroll.js']); ?>
<?php echo $this->Html->script(['js_nice_admin/jquery.flot.js', 'js_nice_admin/jquery.flot.resize.js', 'js_nice_admin/jquery.flot.pie.js', 'js_nice_admin/jquery.flot.categories.js', 'js_nice_admin/jquery.flot.time.js']); ?>

<?= $this->Html->script('https://www.google.com/recaptcha/api.js') ?>

<?= $this->fetch('script') ?>
</body>
</html>
