<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
echo $this->Html->css('css/intlTelInput');
echo $this->fetch('scss');

//echo $this->Html->css('css/intlTelInput.css');

use Cake\I18n\Time; ?>

<!------ Include the above in your HEAD tag ---------->
<style>
    .intl-tel-input {
        display: table-cell;
    }

    .intl-tel-input .selected-flag {
        z-index: 4;
    }

    .intl-tel-input .country-list {
        z-index: 5;
    }

    .input-group .intl-tel-input .form-control {
        border-top-left-radius: 4px;
        border-top-right-radius: 0;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 0;
    }

    .register {
        background: -webkit-linear-gradient(left, #122b40, #09ac70);
        margin-top: 3%;
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
        background: #f8f9fa;
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
        margin-top: 10%;
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
<?= $this->Form->create($user) ?>

<div class="container register">

    <div class="row">
        <?= $this->Flash->render() ?>
        <div class="col-md-10 register-right">


            <h3 class="register-heading">Inscription</h3>

            <div class="row register-form">

                <div class="col-md-6 ">

                    <div class="form-group">
                        <?php echo $this->Form->control('prenom', ['placeholder' => 'First name', 'class' => ($this->Form->isFieldError('prenom')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'false']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('nom', ['placeholder' => 'Last name', 'class' => ($this->Form->isFieldError('nom')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'false']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('username', ['label' => 'Nom d\'utilisateur', 'placeholder' => 'Username', 'class' => ($this->Form->isFieldError('username')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'false']); ?>
                    </div>
                    <div class="form-group">

                        <?php echo $this->Form->control('phone', ['type' => 'tel', 'label' => __('Téléphone'), 'placeholder' => '+226', 'id' => 'phone', 'class' => ($this->Form->isFieldError('phone')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'false']); ?>

                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->control('password', ['label' => 'Mot de passe', 'placeholder' => 'password', 'class' => ($this->Form->isFieldError('password')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'false']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('password2', ['type' => 'password', 'label' => 'confirmer le mot de passe', 'placeholder' => 'password confirm', 'class' => ($this->Form->isFieldError('password2')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'false']); ?>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('n_group', ['label' => 'Numero du groupe', 'placeholder' => 'Group number', 'class' => ($this->Form->isFieldError('n_group')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'false']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('fil', ['label' => 'Filiere/Classe', 'placeholder' => 'Faculty', 'class' => ($this->Form->isFieldError('password')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'false']); ?>
                    </div>


                    <div class="form-group">
                        <div class="maxl">
                            <label> Sexe</label>
                            <?php $options = [

                                'H' => 'Masculin',
                                'F' => 'Feminin',

                            ];
                            echo $this->Form->select('sexe', $options, ['empty' => __('Selectionner'),

                                'class' => ($this->Form->isFieldError('sexe')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'true'
                            ]); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <?php $options = [

                            '1' => __('Candidat'),
                            '3' => __('Electeur'),

                        ];
                        echo $this->Form->select('role', $options, ['empty' => 'Sélectionner',

                            'onchange' => 'disable_text(this.id)', 'id' => "MySlect", 'class' => ($this->Form->isFieldError('role')) ? 'form-control is-invalid' : 'form-control is-valid', 'required' => 'true'
                        ]);

                        ?>

                    </div>
                    <div class="form-group">
                        <div class="maxl">

                            <label><?= __('Poste à pourvoir') ?></label>
                            <?php $option = [
                                'Dg' => __('Délégué général'),
                                'Dga' => __('Délégué général Adjoint'),
                                'Pr' => __('Président'),
                                'VPr' => __('Vice-Président'),
                                'Pm' => __('Premier ministre'),
                                'Sg' => __('Sécrétaire général'),
                                'Sga' => __('Sécrétaire général Adjoint'),
                                'Ct' => __('Chef trésorier'),
                                'Cta' => __('Chef trésorier Adjoint'),
                                'Sac' => __('Sécrétaire aux affaires culturelles'),
                                'Saac' => __('Sécrétaire Adjoint aux affaires culturelles'),
                                'Sas' => __('Sécrétaire aux affaires sportives'),
                                'Saas' => __('Sécrétaire Adjoint aux affaires sportives'),
                                'Si' => __('Sécrétaire à l\'information'),
                                'Sai' => __('Sécrétaire Adjoint à l\'information'),
                                'A' => __('Autres'),

                            ];
                            echo $this->Form->select('post', $option, ['empty' => __('Sélectionner'),
                                'id' => "T1", 'class' => ($this->Form->isFieldError('post')) ? 'form-control is-invalid' : 'form-control is-valid'

                            ]); ?>

                        </div>
                    </div>
                    <?php if ($usecaptcha == 1) { ?>
                        <div class="form-group">
                            <div class="g-recaptcha"
                                 data-sitekey="<?php echo '6Le3UuEUAAAAACmFgWS85cl5Pzj5hIEBEhggazzk'; ?>"></div>
                        </div>
                    <?php } ?>
                    <?= $this->Form->button(__(' Enregistrer'), ['class' => 'btn btn-outline-success btnRegister fa fa-save fa-2x']) ?>
                    <a class="btn btn-outline-info btnLogin" href="<?php echo $this->Url->build('/user/log') ?>">J'ai un
                        compte</a>
                </div>
            </div>

        </div>
        <?php $this->Form->unlockField('g-recaptcha-response'); ?>
    </div>
</div>

<?= $this->Form->end() ?>

<script>

    function disable_text(id) {
        s = document.getElementById(id);

        document.getElementById("T1").hidden = document.getElementById('MySlect').selectedIndex !== 1;


    }

    document.getElementById('mobile-number').intlTelInput({
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
    });
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"
    // get the country data from the plugin
    var countryData = window.intlTelInputGlobals.getCountryData(),
        input = document.getElementById("phone"),
        addressDropdown = document.getElementById("address-country");

    // init plugin
    var iti = window.intlTelInput(input, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js" // just for formatting/placeholders etc
    });

    // populate the country dropdown
    for (var i = 0; i < countryData.length; i++) {
        var country = countryData[i];
        var optionNode = document.createElement("option");
        optionNode.value = country.iso2;
        var textNode = document.createTextNode(country.name);
        optionNode.appendChild(textNode);
        addressDropdown.appendChild(optionNode);
    }
    // set it's initial value
    addressDropdown.value = iti.getSelectedCountryData().iso2;

    // listen to the telephone input for changes
    input.addEventListener('countrychange', function (e) {
        addressDropdown.value = iti.getSelectedCountryData().iso2;
    });

    // listen to the address dropdown for changes
    addressDropdown.addEventListener('change', function () {
        iti.setCountry(this.value);
    });

</script>

