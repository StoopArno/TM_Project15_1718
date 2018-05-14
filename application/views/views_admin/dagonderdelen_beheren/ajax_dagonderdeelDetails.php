<?php
/**
 * @file views_admin/dagonderdelen_beheren/ajax_dagonderdeelDetails.php
 *
 * View wordt opgehaald vanuit de view admin_overzicht_dagonderdelen.php wanneer de admin de opties van een dagonderdeel wilt zien en eventueel aanpassen.
 *      - Krijgt een lovatie-array binnen.
 *      - krijgt een optie-array binnen.
 */
?>

<?php
    foreach($locaties as $locatie){
        $locatieDropdown = array();
        foreach($locaties as $locatie){
            $locatieDropdown[$locatie->id] = ucfirst($locatie->locatie);
        }
    }
?>
<div class="col-12">
    <h4>Opties</h4>

    <div class="table-responsive">
        <table class="table table-hover col-12">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Min inschrijvingen</th>
                <th>Max inschrijvingen</th>
                <th>Locatie</th>
                <th class="text-center">Heeft helpers nodig</th>
                <th class="text-center">Personeelsleden kunnen inschrijven</th>
                <th class="text-center">Specifieke locatie nodig</th>
                <th colspan="2" class="text-center"><a class="btn-primary btn" id="newOptie" href="Dagonderdelen_beheren/optieToevoegen/<?php echo $dagonderdeelId ?>" role="button">Nieuwe optie</a></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($opties as $optie){ ?>
                <tr>
                    <td>
                        <?php
                            $optieFormNaam = "optieForm" . $optie->id;
                            echo form_open("Dagonderdelen_beheren/optieWijzigen", array("method" => "post", "name" => $optieFormNaam, "id" => "$optieFormNaam"));
                            echo form_input(array("type" => "text", "name" => "optieNaam", "class" => "form-control optieId" . $optie->id, "form" => $optieFormNaam, "disabled" => "true"), ucfirst($optie->optie));
                            echo form_hidden("optieid", $optie->id);

                            echo form_hidden("dagonderdeelId", $optie->dagonderdeelId);
                            echo form_close();
                        ?>
                    </td>
                    <td>
                        <?php echo form_input(array("type" => "number", "name" => "minInschrijvingen", "class" => "form-control optieId" . $optie->id, "form" => $optieFormNaam, "disabled" => "true"), $optie->minAantalInschrijvingen); ?>
                    </td>
                    <td>
                        <?php echo form_input(array("type" => "number", "name" => "maxInschrijvingen", "class" => "form-control optieId" . $optie->id, "form" => $optieFormNaam, "disabled" => "true"), $optie->maxAantalInschrijvingen); ?>
                    </td>
                    <td id="optieDropDownCell<?php echo $optie->id ?>">
                        <?php if($optie->locatieId == null){ ?>
                            De locatie wordt gedefinieerd bij het dagonderdeel.
                        <?php } else{ ?>
                            <?php echo form_dropdown("locatieId", $locatieDropdown, array($optie->locatieId), array("class" => "form-control optieId" . $optie->id, "disabled" => "true", "size" => 1, "form" => $optieFormNaam)) ?>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <?php
                        if($optie->helper_nodig == "nee"){
                            echo form_input(array("type" => "checkbox", "name" => "helper_nodig", "value" => "ja", "class" => "optieId" . $optie->id, "data-optieid" => $optie->id, "disabled" => "true", "form" => $optieFormNaam));
                        } else{
                            echo form_input(array("type" => "checkbox", "name" => "helper_nodig", "value" => "ja", "class" => "optieId" . $optie->id, "data-optieid" => $optie->id, "disabled" => "true", "form" => $optieFormNaam, "checked" => "true"));
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <?php
                        if($optie->personeel_kan_inschrijven == "nee"){
                            echo form_input(array("type" => "checkbox", "name" => "personeel_kan_inschrijven", "value" => "ja", "class" => "optieId" . $optie->id, "data-optieid" => $optie->id, "disabled" => "true", "form" => $optieFormNaam));
                        } else{
                            echo form_input(array("type" => "checkbox", "name" => "personeel_kan_inschrijven", "value" => "ja", "class" => "optieId" . $optie->id, "data-optieid" => $optie->id, "disabled" => "true", "form" => $optieFormNaam, "checked" => "true"));
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <?php if($optie->locatieId == null){ ?>
                            <?php echo form_input(array("type" => "checkbox", "name" => "optieHeeftLocatie", "class" => "checkboxOptielocatie optieId" . $optie->id, "data-optieid" => $optie->id, "disabled" => "true", "form" => $optieFormNaam));?>
                        <?php } else{ ?>
                            <?php echo form_input(array("type" => "checkbox", "name" => "optieHeeftLocatie", "class" => "checkboxOptielocatie optieId" . $optie->id, "data-optieid" => $optie->id, "disabled" => "true", "form" => $optieFormNaam, "checked" => "true"));?>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <i class="fa fa-edit fa-2x dagonderdeelActie optieEdit" data-optieid="<?php echo $optie->id ?>"></i>
                    </td>
                    <td class="text-center">
                        <a  class="text-dark"><i class="fa fa-trash fa-2x dagonderdeelActie optieDel" data-optieid="<?php echo $optie->id ?>"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="OptieDialoog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4>Ben je zeker dat je deze optie wilt verwijderen?</h4>
            <div>
                <button class="verwijderKnop btn btn-danger left">Verwijder</button>
                <button class="annuleerKnop btn btn-primary right">Annuleer</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".dagonderdeelActie.optieEdit").on("click", function(){
            if($(this).hasClass("fa-edit")){
                $(".optieId" + $(this).data("optieid")).prop("disabled", false);
                $(this).removeClass("fa-edit").addClass("fa-check");
            } else{
                $("form[name=optieForm" + $(this).data("optieid") + "]").submit();
            }
        });

        $(".checkboxOptielocatie").on("change", function(){
            if($(this).prop("checked")){
                console.log(getCombobox("optie", $(this).data("optieid")));
                $("#optieDropDownCell" + $(this).data("optieid")).empty().append(getCombobox("optie", $(this).data("optieid")));
            } else{
                console.log("Checked");
                $("#optieDropDownCell" + $(this).data("optieid")).empty().append("De locatie wordt gedefinieerd bij het dagonderdeel");
            }
        });

        var id;
        $('.optieDel').click(function() {
            id = $(this).data("optieid");
            $('#OptieDialoog').modal('show');
        });

        $('.verwijderKnop').click(function() {
            $('#OptieDialoog').modal('toggle');
            verwijderOptie(id);
        });

        $('.annuleerKnop').click(function() {
            $('#OptieDialoog').modal('toggle');
        });
    });

    function verwijderOptie(id){
        window.location.href = site_url + "/Dagonderdelen_beheren/optieVerwijderen/" + id;
    }
</script>