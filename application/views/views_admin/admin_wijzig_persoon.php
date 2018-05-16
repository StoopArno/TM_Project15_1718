<?php /**

* @file views_admin/admin_wijzig_persoon.php
*
* View die een personeelslid weergeeft met zijn inschrijvingen
* De inschrijvingen en gegevens van dit personeelslid kunnen worden gewijzigd.
*      - Krijgt een Persoon-array binnen
*      - Krijgt een opties-array binnen.
 *     - Krijgt een Inschrijvingen-array binnen.
*
*/


echo form_open('overzicht_helpers_personeelsleden/wijzigpersoon');

 ?>
<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
    <h2>Persoon wijzigen</h2>

    <div class="form-group hidden">
        <input type="text" class="form-control" value="<?php echo $persoon->id ?>" name="id">

    </div>
    <div class="form-group">
        <label for="familienaam">Familienaam</label>
        <input type="text" class="form-control" value="<?php echo $persoon->naam ?>" name="familienaam">
        <small class="form-text text-muted">Voer hier de familienaam in.</small>
    </div>
    <div class="form-group">
        <label for="voornaam">Voornaam</label>
        <input type="text" class="form-control" value="<?php echo $persoon->voornaam ?>" name="voornaam">
        <small class="form-text text-muted">Voer hier de voornaam in.</small>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"value="<?php echo $persoon->email ?>" name="email">
        <small id="emailHelp" class="form-text text-muted">Voer hier de email in.</small>
    </div>

    <div class="form-group">
        <label for="number">GSM Nummer</label>
        <input type="number" min="0" class="form-control" id="gsm" aria-describedby="emailHelp"
               value="<?php echo $persoon->gsm_nummer ?>" name="gsm">
        <small id="emailHelp" class="form-text text-muted">Voer hier de GSM nummer in.</small>
    </div>




</div>
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
    <h2>Inschrijven voor</h2>
    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 ">

        <?php
        $dagonderdeelidoud = "";
        $total = count($opties);
        $tel = 0;
        $hulp="";
        foreach ($opties as $optie) {
            $tel++;

            $dagonderdeelid = $optie->dagonderdeelId;
            if ($dagonderdeelid != $dagonderdeelidoud) {
                if ($total / 3 < $tel) {
                    echo "</div><div class='col-lg-6'>";
                    $tel = 0;
                }
                echo '<h3 class="text-lg-left text-left">' . $optie->dagonderdeel->naam . '</h3>';

            }

            foreach ($inschrijvingen as $inschrijving) {
                if ($inschrijving->optieid == $optie->id) {
                    $hulp = 1;
                    echo '<p class="row"><input class="form-check-input" checked name="inschrijvingen[]" type="checkbox" value="' . $optie->id . '" id="' . $optie->id . '" >  &nbsp;&nbsp;&nbsp; ' . $optie->optie . '
        </p>';
                }

            }
            if ($hulp==0){
                echo '<p class=" text-left row"><input class="form-check-input"  name="inschrijvingen[]" type="checkbox" value="' . $optie->id . '" id="' . $optie->id . '" >  &nbsp;&nbsp;&nbsp; ' . $optie->optie . '
        </p>';
            }
            $dagonderdeelidoud = $dagonderdeelid;
        }
        ?>
    </div>


</div>


<div class=" row col-12">
    <p class="text-lg-left text-left">
        <button type="submit" class=" btn btn-primary">Opslaan</button>
    </p>
</div>
    </form>

