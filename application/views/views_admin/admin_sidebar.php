<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <br>
        </li>

        <li>
            <?php echo anchor('aanmelden/home', '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> &nbsp; Home'); ?>
        </li>

        <li>
            <?php echo anchor('organisator_beheren/organisatorToevoegen', '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp; Organisatoren beheren'); ?>
        </li>

        <li>
            <?php echo anchor('teksten_aanpassen/index', '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> &nbsp; Teksten aanpassen'); ?>
        </li>

        <li>
            <?php echo anchor('Admin/Dagonderdelen_beheren/index', '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> &nbsp; Dagonderdelen beheren'); ?>
        </li>

        <li>
            <?php echo anchor('Admin/TakenEnShiften_beheren/index', '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> &nbsp; Taken en shiften beheren'); ?>
        </li>

        <li>

            <?php echo anchor('Overzicht_helpers_personeelsleden/index', '<span class="	glyphicon glyphicon-list-alt" aria-hidden="true"></span> &nbsp; Inschrijvingen beheren'); ?>
        </li>

        <li>
            <?php echo anchor('aanmelden/meldAf', '<span class="glyphicon glyphicon-off" aria-hidden="true"></span> &nbsp; Meld Af'); ?>
        </li>


    </ul>
</div>