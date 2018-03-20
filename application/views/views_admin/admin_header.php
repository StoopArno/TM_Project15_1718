<?php ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="" width="30" height="30" class="d-inline-block align-top" alt="">
        <?php echo toonAfbeelding("logo_TM.png", array( "class" => "d-inline-block align-top", "height" => "50px"))?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <?php echo anchor('aanmelden/home', 'Home', 'class="nav-item nav-link"'); ?>
            <?php echo anchor('organisator_toevoegen/organisatorToevoegen', 'Organisator toevoegen', 'class="nav-item nav-link"'); ?>
            <a class="nav-item nav-link" href="#">Dagonderdelen beheren</a>
            <a class="nav-item nav-link" href="#">Fuif beheren</a>
            <a class="nav-item nav-link" href="#">Eten beheren</a>
            <a class="nav-item nav-link" href="#">Overzicht deelnemers/helpers</a>
            <a class="nav-item nav-link" href="#">Mails</a>
            <a class="nav-item nav-link" href="#">Vervoer beheren</a>
            <?php echo anchor('aanmelden/meldAf', 'Meld af', 'class="nav-item nav-link"'); ?>
        </div>
    </div>
</nav>