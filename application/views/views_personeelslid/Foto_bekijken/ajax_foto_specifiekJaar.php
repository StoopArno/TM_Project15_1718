<?php
/***
 * @file views_personeelslid/Foto_bekijken/ajax_foto_specifiekJaar.php
 *
 * View die wordt opgeroepen in de Controller Foto_bekijken elke jaar als de gebruiker het jaar verandert.
 *      - Krijgt een foto-array binnen.
 */
?>

<div class="row">
    <?php foreach($fotos as $foto){ ?>
        <div class="col-3 offset-1 foto-item text-center">
            <?php echo toonSavedAfbeelding($foto->fotonaam, array('height' => '200px', 'class' => 'image-fluid')) ?>
        </div>
    <?php } ?>
</div>