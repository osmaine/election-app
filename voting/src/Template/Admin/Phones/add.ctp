<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $phone
 */
?>

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

<div class="row">
    <div class="col-md-4 offset-4">
        <?= $this->Flash->render() ?>
        <div class="card">
            <h4 class="card-header"><?php echo __('Enregistrement des numéros de téléphone') ?></h4>
            <div class="card-body">
                <?php echo $this->Form->create($phone) ?>
                <div class="form-group">
                    <?php echo $this->Form->control('phone', ['label' => 'Phone', 'placeholder' => 'ex:+226', 'class' => ($this->Form->isFieldError('phone')) ? 'form-control is-invalid' : 'form-control is-valid']); ?>
                </div>

                <?php echo $this->Form->button(__('Valider'), ['class' => 'btn btn-primary']) ?>

                <?php echo $this->Form->end() ?>
                <a class="btn btn-warning"
                   href="<?php echo $this->Url->build(['action' => 'index']) ?>"><?php echo __('Retour à la liste') ?></a>

            </div>

        </div>

    </div>

</div>
