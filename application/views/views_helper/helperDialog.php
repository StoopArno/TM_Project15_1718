<div class="modal-header">
    <h4 class="modal-title"><?php echo $shift->omschrijving; ?></h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>

</div>
<div class="modal-body">
    <?php
    if($shiftInschrijvingen != null) {
        ?>
        <ul>
            <?php
            if($shiftInschrijvingen != null) {
                foreach($shiftInschrijvingen as $SI) {
                    ?>
                    <li><?php echo $SI->persoon->voornaam . " " . $SI->persoon->naam; ?></li>
                    <?php
                }
            }

            ?>
        </ul>
        <?php
    } else {
        ?>
            <p>Er zijn nog geen inschrijvingen voor deze shift!</p>
        <?php
    }
    ?>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
</div>