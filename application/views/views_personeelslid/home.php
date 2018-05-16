<?php
/**
 * @file views_personeelslid/home.php
 *
 * View waarop het personeelslid uitkomt na het volgen van de correcte url.
 *      - Krijgt een personeelslid-object binnen.
 *      - Krijgt een tekst-object binnen.
 */
?>

<div class="container">
    <div class="col-12">
        <h2>Welkom <?php echo ucfirst($personeelslid->voornaam) ?></h2>
    </div>
    <div class="col-12 ">
        <?php echo $tekst->omschrijving ?>
    </div>
    <br><br><br><br>
    <div class="col-12">
        <div>
            Hier vindt je een overzicht van alle activiteiten waar je je voor kunt inschrijven. Ook eventueel bestaande inschrijvingen kunnen hier aangepast worden.
            <?php echo anchor('Inschrijven_personeelslid', 'Inschrijven', 'class="nav-link"'); ?>
        </div>
        <div>
            Hier zijn de foto's van vorige edities van het personeelsfeest zichtbaar.
            <?php echo anchor('Foto_bekijken', 'Foto\'s bekijken', 'class="nav-link"'); ?>
        </div>
    </div>
</div>