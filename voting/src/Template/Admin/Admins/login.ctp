<?php $myTemplates = [
    'inputContainer' => '<div class="form-group">{{content}}</div>',
    'input' => '<input type="{{type}}" class="form-control" name="{{name}}"{{attrs}}/>'
];
$this->Form->setTemplates($myTemplates);
?>
<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">AWOGD@N<b>-VOTE </b></a>
        <small><?php echo __('Application de vote en ligne') ?></small>
    </div>
    <div>
        <div class="card">
            <?= $this->Flash->render() ?>
            <div class="body">
                <?= $this->Form->create() ?>
                <div class="msg">Sign in to start your session</div>

                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <?= $this->Form->control('username', ['label' => false, 'placeholder' => __('Nom d\'utilisateur'), 'class' => 'form-control', 'autofocus']); ?>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <?= $this->Form->control('password', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Mot de passe'), 'autofocus']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">

                        <?= $this->Form->button(__('Connexion'), ['class' => 'btn btn-block bg-pink waves-effect']); ?>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="<?php echo $this->Url->build('/admin/add') ?>"><?php echo __('Inscription') ?></a>

                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="<?php echo $this->Url->build('/admin/ver') ?>"><?php echo __('Mot de passe oublié?') ?></a>

                    </div>
                </div>

                <?= $this->Form->end() ?>

            </div>

        </div>
    </div>
</body>
