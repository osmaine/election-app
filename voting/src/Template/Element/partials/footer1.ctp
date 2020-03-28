<?php

use Cake\I18n\Time;

?>
<style>
    footer.page-footer {
        bottom: 0;
        color: #fff;
    }

    footer.page-footer .container-fluid {
        width: auto;
    }

    .footer-copyright {
        display: block;
        overflow: hidden;
        color: rgba(255, 255, 255, 0.6);
        background-color: rgba(0, 0, 0, 0.2);
    }

    footer.page-footer a {
        color: #fff;
    }
</style>
<!--<footer class="pt-4 my-md-5 pt-md-5 border-top-0"
        style="text-align: center; background: -webkit-linear-gradient(left, #2b2b2b, #1a2732);position: -ms-device-fixed;bottom: 0;">

    <span>Copyright &copy;  Your Website <?= date('yy') ?></span>
    <p>@Woguedan@App</p>

</footer>-->
<!--<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
        </div>
    </div>
</footer>-->
<!--Footer-->
<footer class="page-footer text-center font-small mbd-color darken-2 mt-4 wow fadeIn"
        style="text-align: center; background: -webkit-linear-gradient(left, #2b2b2b, #1a2732)">

    <!--Call to action-->

    <!--/.Call to action-->


    <div class="footer-copyright py-5">
        © <?php
        $now = Time::now();
        echo $now->year;
        ?> Copyright:
        <?php echo $this->Html->link('AWOGDAN', ['controller' => 'Pages', 'action' => 'Home', '_full' => true]); ?>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->
