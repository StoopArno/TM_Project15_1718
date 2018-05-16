<?php
/**
 * @file views_helper/helper_navbar.php
 *
 * Dit is de navigatie waar de helper mee kan werken.
 */
?>
   <nav class="navbar navbar-expand-lg navbar-dark default-color-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <?php echo anchor('inschrijven_helper/index/' . $helper->hashcode, 'Home', 'class="nav-link"') ?>
            </li>
            <li class="nav-item">
                <?php echo anchor('inschrijven_helper/inschrijfPagina/' . $helper->hashcode, 'Inschrijven', 'class="nav-link"') ?>
            </li>
            <li class="nav-item">
                <?php echo anchor('inschrijven_helper/fotoPagina/' . $helper->hashcode, 'Foto\'s afgelopen jaren', 'class="nav-link"') ?>
            </li>
            <li class="nav-item">
                <?php echo anchor('inschrijven_helper/faq/' . $helper->hashcode, 'FAQ', 'class="nav-link"') ?>
            </li>
        </ul>
    </div>
</nav>

