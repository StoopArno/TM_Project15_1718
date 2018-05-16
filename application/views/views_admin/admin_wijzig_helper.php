<?php /**

* @file views_admin/admin_wijzig_helper.php
*
* View die een helper weergeeft met zijn shiften waar hij komt helper
* De inschrijvingen en gegevens van dit helper kunnen worden gewijzigd.
*      - Krijgt een Persoon-array binnen
*      - Krijgt een shiften-array binnen.*  -
*      - Krijgt een inschrijvingen-array binnen
 *
*
*/
?>


<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
<?php echo form_open('overzicht_helpers_personeelsleden/wijzighelper');

?>
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




    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <h2 class="align-left">Inschrijvingen wijzigen</h2>
        <div class="col-sm-12 col-md-6 col-lg-6">

            <?php

            $beginuuroud="";
            $teller=0;
            foreach ($shiften as $shift) {
                $help=0;
                $beginuur = explode(" ", $shift->beginuur);
                $einduur = explode(" ", $shift->einduur);
                $beginuurenmin= explode(":", $beginuur[1]);
                    $einduurenmin= explode(":", $einduur[1]);
                if ($teller == 3){
                    echo ' </div><div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> ';
                }
                if ($beginuur[1]!= $beginuuroud){
                    echo '<h2>'.$beginuurenmin[0] . ':' . $beginuurenmin[1] . '-'.  $einduurenmin[0] . ':' . $einduurenmin[1] . '</h2>';
                    $teller+=1;
                }
                foreach ($inschrijvingen as $inschrijving){
                    if ($inschrijving->shiftid==$shift->id && $help==0){
                        $help=1;
                        echo '<p class="row"><input class="form-check-input" checked name="inschrijvingen[]" type="checkbox" value="' . $shift->id . '" id="' . $shift->id . '" >  &nbsp;&nbsp;&nbsp; ' . $shift->omschrijving ;
                    }
                }



                $beginuuroud=$beginuur[1];
                if ($help ==0){
                    echo '<p class="row"><input class="form-check-input"  name="inschrijvingen[]" type="checkbox" value="' . $shift->id . '" id="' . $shift->id . '" >  &nbsp;&nbsp;&nbsp; ' . $shift->omschrijving ;
                }
            }


            ?>




        </div>
    </div>

    <button type="submit" class=" btn btn-primary ">Opslaan</button>



    </form>
</div>
