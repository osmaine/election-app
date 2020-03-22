<!DOCTYPE html>
<html lang="fr">

<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') ?>
<?php
echo $this->element('partials/AdminHead'); //afficher le navabaradmin dans element
use Cake\ORM\TableRegistry; ?>
<body id="page-top">


<?php
echo $this->element('partials/_navBarAdmin'); //afficher le navabaradmin dans element
?>


<div id="wrapper">

    <!-- Sidebar -->

    <?php
    if ($this->getRequest()->getSession()->read('Auth.User')) {


        echo $this->element('partials/SidebarAdmin');
        //si connecté affiche le
        //afficher le navabaradmin dans element

    } else  //echo $this->element('partials/SidebarAdmin');
    //si l'interesse n'est pas connecté n'affiche pas le sidebar
    ?>
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <?php
            if ($this->getRequest()->getSession()->read('Auth.User')) {


                echo $this->element('partials/Adminbracumb');
                //si connecté affiche le
                //afficher le navabaradmin dans element

            } else  //echo $this->element('partials/SidebarAdmin');
                //si l'interesse n'est pas connecté n'affiche pas le sidebar
                ?>

                <!-- Icon Cards-->
                <?php
            //if (){
            if ($this->getRequest()->getSession()->read('Auth.User')) {


                echo $this->element('partials/iconcardAdmin');
                //si connecté affiche le
                //afficher le icone bar de element

            } else  //echo $this->element('partials/SidebarAdmin');
            //

            // }
            ?>

            <!-- Area Chart Example-->


            <!-- DataTables Example -->
            <div class="card mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <?php echo $this->fetch('content');

                        ?>
                    </div>
                </div>
                <!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php
        echo $this->element('partials/Adminfooter'); //afficher le navabaradmin dans element
        ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <a class="btn btn-primary" href="<?= $this->Url->build('/admin/logout') ?>">Deconnexion</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
<script src="vendor/jquery/jquery.min.js"></script>
-->
<?= $this->Html->script('jquery.js') ?>
<!--<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<?= $this->Html->script('js/bootstrap.bundle.js') ?>
<!-- Core plugin JavaScript-->

<?= $this->Html->script('jquery.easing.js') ?>
<!-- Page level plugin JavaScript-->

<?= $this->Html->script('Chart.js') ?>

<?= $this->Html->script('jquery.dataTables.js') ?>

<?= $this->Html->script('dataTables.bootstrap4.js') ?>

<!-- Custom scripts for all pages-->

<?= $this->Html->script('js/sb-admin.js') ?>
<?php echo $this->Html->script('gulpfile.js'); ?>

<!-- Demo scripts for this page-->

<?= $this->Html->script('js/datatables-demo.js') ?>
<?= $this->Html->script('https://www.google.com/recaptcha/api.js') ?>
<?= $this->Html->script('js/chart-area-demo.js') ?>
<?php echo $this->fetch('script') ?>

</body>

</html>
