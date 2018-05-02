<?php echo form_open('overzicht_helpers_personeelsleden/wijzigpersoon');?>
<div class="col-sm-12 col-md-6 col-lg-6">
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

    <button type="submit" class="col-lg-6 btn btn-primary btn-organisator">Opslaan</button>


</div>
<div class="col-sm-12 col-md-6 col-lg-6">
    <h2 class="align-left">Inschrijvingen wijzigen</h2>
    <div class="col-sm-12 col-md-6 col-lg-6">

        <?php
        $dagonderdeelidoud = "";
        $total = count($opties);
        $tel = 0;
        foreach ($opties as $optie) {
            $tel++;
            if ($total / 2 < $tel) {
                echo "</div><div class='col-lg-6'>";
                $tel = 0;
            }
            $dagonderdeelid = $optie->dagonderdeelId;
            if ($dagonderdeelid != $dagonderdeelidoud) {
                echo '<h4>' . $optie->dagonderdeel->naam . '</h4>';
            }
                foreach ($inschrijvingen as $inschrijving){
                echo '<p>'. $inschrijving->optieid .'</p>';
                if ($inschrijving->optieid= $optie->id){

                }
                }
                echo '<p ><input class="form-check-input" name="inschrijvingen[]" type="checkbox" value="' . $optie->id . '" id="' . $optie->id . '" > &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <label class="filter form-check-label" for="' . $optie->id . '">' . $optie->optie . '
    </label></p>';

            $dagonderdeelidoud = $dagonderdeelid;
        }
        ?>

</div>
</div>



    </form>
    
