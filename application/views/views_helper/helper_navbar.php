
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
    <!-- Navbar brand -->
    <a class="navbar-brand" href="#"></a>
    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
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
<!--/.Navbar-->