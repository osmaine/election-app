<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="<?= $this->Url->build('/admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>WOGUED@N</span>
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
            <!-- <a class="dropdown-item" href="login.html">Administrateur</a>-->
            <?php echo $this->Html->link('Administrateur', '/admin', ['class' => 'dropdown-item']) ?>
            <a class="dropdown-item" href="<?= $this->Url->build('/admin/candidat') ?>"><?php echo __('Candidat') ?></a>
            <a class="dropdown-item" href="<?= $this->Url->build('/admin/electeur') ?>"><?php echo __('Electeur') ?></a>
            <a class="dropdown-item" href="<?= $this->Url->build('/admin/resultat') ?>"><?php echo __('Resultat') ?></a>
            <a class="dropdown-item" href="<?= $this->Url->build('/admin/phone') ?>"><?php echo __('Téléphones') ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= $this->Url->build('/admin/vote-list') ?>">
            <i class="fas fa-fw fa-list"></i>
            <span><?php echo __('Calendrier électoral') ?></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>
</ul>
