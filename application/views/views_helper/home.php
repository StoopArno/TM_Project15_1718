<?php
echo pasStylesheetAan('style.css');
?>

<div class="container">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="col-12">
            <h2>Welkom <?php echo $helper->voornaam; ?></h2>
        </div>
        <div class="col-12 ">
            <div>
                <?php echo $tekst->omschrijving; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="col-12">
            <h2>Ga naar de inschrijvingen</h2>
        </div>

        <div class="col-12 text-center">
            <?php echo anchor('inschrijven_helper/inschrijfPagina/' . $helper->hashcode, 'Inschrijven', 'class="btn btn-primary knop"'); ?>
        </div>
        <div class="col-12">
            <h2>Ga naar de inschrijvingen</h2>
        </div>
        <div class="col-12 text-center">
            <?php echo anchor('inschrijven_helper/fotoPagina/' . $helper->hashcode, 'Voorbije jaren', 'class="btn btn-primary knop"') ?>
        </div>
    </div>

</div>
</div>