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
                        <a href="<?php echo base_url() ?>index.php/Dagonderdelen_beheren/optieVerwijderen/<?php echo $optie->id ?>" class="text-dark"><i class="fa fa-trash fa-2x dagonderdeelActie optieDel" data-optieid="<?php echo $optie->id ?>"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
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
    });
</script>