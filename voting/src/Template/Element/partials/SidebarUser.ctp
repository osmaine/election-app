<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>

            <span>Listes</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="<?= $this->Url->build('/user/admin') ?>"><?= (__('Administrateur')) ?></a>

            <a class="dropdown-item" href="<?= $this->Url->build('/user/candid') ?>"><?= (__('Candidat')) ?></a>
            <a class="dropdown-item" href="<?= $this->Url->build('/user/voter') ?>"><?= (__('Electeur')) ?></a>
            <a class="dropdown-item"
               href="<?= $this->Url->build('/user/election') ?>"><?= (__('Liste électorale')) ?></a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="<?= $this->Url->build('/user/resultat') ?>"><?= (__('Resultat')) ?></a>

        </div>
    </li>

</ul>
