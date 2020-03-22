<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Admin $admin
 */
?>


<!------ Include the above in your HEAD tag ---------->
<style>
    .register {
        background: -webkit-linear-gradient(left, #122b40, #09ac70);
        margin-top: 10%;
        padding: 3%;
    }

    .register-left {
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }

    .register-left input {
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #ac8c58;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }

    .register-right {
        background: #f8f9fa;
        border-top-left-radius: 10% 50%;
        border-bottom-left-radius: 10% 50%;
    }

    .register-left img {
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite alternate;
        animation: mover 1s infinite alternate;
    }

    @-webkit-keyframes mover {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-20px);
        }
    }

    @keyframes mover {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-20px);
        }
    }

    .register-left p {
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }

    .register .register-form {
        padding: 10%;
        margin-top: 10%;
    }

    .btnRegister {
        float: left;
        margin-top: 10%;
        border: #0b2e13;
        border-radius: 1.0rem;
        padding: 2%;
        background: #6e6b35;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }

    .btnLogin {
        float: right;
        margin-top: 8%;
        border: none;
        border-radius: 1.0rem;
        padding: 2%;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }

    .register .nav-tabs {
        margin-top: 3%;
        border: none;
        background: #0062cc;
        border-radius: 1.5rem;
        width: 28%;
        float: right;
    }

    .register .nav-tabs .nav-link {
        padding: 2%;
        height: 34px;
        font-weight: 600;
        color: #fff;
        border-top-right-radius: 1.5rem;
        border-bottom-right-radius: 1.5rem;
    }

    .register .nav-tabs .nav-link:hover {
        border: none;
    }

    .register .nav-tabs .nav-link.active {
        width: 100px;
        color: #0062cc;
        border: 2px solid #0062cc;
        border-top-left-radius: 1.5rem;
        border-bottom-left-radius: 1.5rem;
    }

    .register-heading {

        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: #6e1940;
    }

    .register-heading1 {
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: red;
    }
</style>
<?php $myTemplates = [
    'inputContainer' => '<div class="form-group">{{content}}</div>',
    // 'input' => '<input type="{{type}}" class="form-control is-invalid" name="{{name}}"{{attrs}}/>',
    'inputContainerError' => '<div class="form-group {{required}} error">{{content}}{{error}}</div>',
    'error' => '<div class="invalid-feedback">{{content}}</div>',
];
$this->Form->setTemplates($myTemplates); ?>



<?= $this->Form->create($admin) ?>


<div class="container register">

    <div class="row">
        <div class="col-md-10 register-right">


            <h3 class="register-heading"><?= __('Création de l\'administrateur') ?></h3>
            <p class="register-heading1"><?= $this->Flash->render() ?></p>
            <div class="row register-form">

                <div class="col-md-6 ">

                    <div class="form-group">
                        <?php echo $this->Form->control('prenom', ['placeholder' => 'First name', 'class' => ($this->Form->isFieldError('prenom')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('email', ['type' => 'email', 'label' => 'Email', 'placeholder' => 'Email', 'class' => ($this->Form->isFieldError('email')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('password', ['label' => 'Mot de passe', 'placeholder' => 'password', 'class' => ($this->Form->isFieldError('password')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                    </div>

                    <div class="form-group">

                        <label class="radio inline">
                            <?php $options = ['H' => 'Homme', '  ', 'F' => 'Femme'];
                            $attributes = array('sexe' => false);
                            echo $this->Form->radio('sexe', [$options, $attributes]);
                            ?>
                        </label>

                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('fil', ['label' => 'Filiere/Classe', 'placeholder' => 'Faculty', 'class' => ($this->Form->isFieldError('password')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'true']); ?>
                    </div>
                    <?= $this->Form->button(__('Enregistrer'), ['class' => 'btn btn-outline-success btnRegister fa fa-icon-ok']) ?>
                    <a class="btn btn-outline-info btnLogin" href="<?php echo $this->Url->build('/admin/login') ?>">J'ai
                        un compte</a>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('nom', ['placeholder' => 'Last name', 'class' => ($this->Form->isFieldError('nom')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('username', ['label' => 'Nom d\'utilisateur', 'placeholder' => 'Username', 'class' => ($this->Form->isFieldError('username')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('password2', ['type' => 'password', 'label' => 'confirmer le mot de passe', 'placeholder' => 'password confirm', 'class' => ($this->Form->isFieldError('password2')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->control('phone', ['type' => 'tel', 'label' => 'Téléphone', 'placeholder' => 'Mobile phone', 'class' => ($this->Form->isFieldError('phone')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                    </div>
                    <?php if ($usecaptcha == 1) { ?>
                        <div class="form-group">
                            <div class="g-recaptcha"
                                 data-sitekey="<?php echo '6Le3UuEUAAAAACmFgWS85cl5Pzj5hIEBEhggazzk'; ?>"></div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->Form->unlockField('g-recaptcha-response'); ?>
<?= $this->Form->end() ?>
<!--<script>
    $('document').ready(function(){
        var username_state = false;
        var email_state = false;
        $('#username').on('blur', function(){
            var username = $('#username').val();
            if (username === '') {
                username_state = false;
                return;
            }
            $.ajax({
                url: 'register.php',
                type: 'post',
                data: {
                    'username_check' : 1,
                    'username' : username,
                },
                success: function(response){
                    if (response === 'taken' ) {
                        username_state = false;
                        $('#username').parent().removeClass();
                        $('#username').parent().addClass("form_error");
                        $('#username').siblings("span").text('Sorry... Username already taken');
                    }else if (response === 'not_taken') {
                        username_state = true;
                        $('#username').parent().removeClass();
                        $('#username').parent().addClass("form_success");
                        $('#username').siblings("span").text('Username available');
                    }
                }
            });
        });
        $('#email').on('blur', function(){
            var email = $('#email').val();
            if (email == '') {
                email_state = false;
                return;
            }
            $.ajax({
                url: 'register.php',
                type: 'post',
                data: {
                    'email_check' : 1,
                    'email' : email,
                },
                success: function(response){
                    if (response == 'taken' ) {
                        email_state = false;
                        $('#email').parent().removeClass();
                        $('#email').parent().addClass("form_error");
                        $('#email').siblings("span").text('Sorry... Email already taken');
                    }else if (response == 'not_taken') {
                        email_state = true;
                        $('#email').parent().removeClass();
                        $('#email').parent().addClass("form_success");
                        $('#email').siblings("span").text('Email available');
                    }
                }
            });
        });

        $('#reg_btn').on('click', function(){
            var username = $('#username').val();
            var email = $('#email').val();
            var password = $('#password').val();
            if (username_state === false || email_state === false) {
                $('#error_msg').text('Fix the errors in the form first');
            }else{
                // proceed with form submission
                $.ajax({
                    url: 'register.php',
                    type: 'post',
                    data: {
                        'save' : 1,
                        'email' : email,
                        'username' : username,
                        'password' : password,
                    },
                    success: function(response){
                        alert('user saved');
                        $('#username').val('');
                        $('#email').val('');
                        $('#password').val('');
                    }
                });
            }
        });
    });
</script>-->
