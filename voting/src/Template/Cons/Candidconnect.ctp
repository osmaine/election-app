<?php echo $this->Html->css('style2') ?>
<div class="container">
    <div class="card card-login mx-auto mt-5" style="background:#02111b ">
        <div class="card-header">Administrateur</div>
        <div class="card-body">
            <?php echo $this->Form->create(false, array(
                'url' => array('controller' => 'Admins', 'action' => 'login'),
                'id' => 'Connectionsverif')); ?>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address"
                           required="required" autofocus="autofocus">
                    <label for="inputEmail">Email ou nom d'utilisateur</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                           required="required">
                    <label for="inputPassword">Mot de passe</label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me">
                        Remember Password
                    </label>
                </div>
            </div>
            <?php echo $this->Form->button('Connexion', [
                'type' => 'submit',
                'escape' => true,
                'class' => 'btn btn-outline-success'
            ]); ?>
            <?php echo $this->Form->end(); ?>
            <div class="text-center">
                <!-- <a class="d-block small mt-3" href="register.html">Register an Account</a>-->
                <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

