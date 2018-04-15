<?php
    $locatieDropdown = array();
    foreach($locaties as $locatie){
        $locatieDropdown[$locatie->id] = ucfirst($locatie->locatie);
    }
    $dagonderdeelDropdown = array();
    foreach($dagonderdelenDropdown as $dagonderdeel){
        $dagonderdeelDropdown[$dagonderdeel->id] = ucfirst($dagonderdeel->naam);
    }
    $optieDropdown = array();
    //var_dump($optieDropdown);
    foreach($opties as $optie){
        $optieDropdown[$optie->id] = ucfirst($optie->optie . " - " . $optie->dagonderdeel);
    }
?>

<div class="row">
    <h4 class="col-5">Taken en shiften</h4>
    <h4 class="col-7 text-right "><a href="Dagonderdelen_beheren" class="">Dagonderdelen<i class="fa fa-angle-double-right fa-lg"></i></a></h4>
</div>

<div class="table-responsive">
    <table class="table table-hover col-12">
        <thead>
            <tr>
                <th scope="col">Naam</th>
                <th scope="col">Omschrijving</th>
                <th scope="col">Locatie</th>
                <th scope="col">Dagonderdeel</th>
                <th scope="ool">Optie</th>
                <th scope="col" class="text-center">Hoort bij een optie</th>
                <th scope="col" colspan="2" class="text-center"><a class="btn-primary btn" id="newTaak" href="TakenEnShiften_beheren/taakToevoegen" role="button">Nieuwe taak</a></th>
                <th scope="col" class="text-center">Shiften <br><i class="fa fa-angle-double-down fa-lg"></i></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($taken as $taak){ ?>
            <tr>
                <td>
                    <?php $formnaam= "taakForm" . $taak->id;
                        echo form_open("TakenEnShiften_beheren/taakWijzigen", array("method" => "post", "name" => $formnaam, "id" => $formnaam));
                        echo form_input(array("type" => "text", "name" => "taakNaam", "class" => "form-control taakId" . $taak->id, "disabled" => "true", "form" => $formnaam), ucfirst($taak->naam));
                        echo form_hidden("taakId", $taak->id);
                        echo form_hidden("personeelsfeestId", $taak->personeelsfeestId);
                        echo form_close();
                    ?>
                </td>
                <td><?php echo form_input(array("type" => "text", "name" => "taakOmschrijving", "class" => "form-control taakId" . $taak->id, "disabled" => "true", "form" => $formnaam), ucfirst($taak->omschrijving)); ?></td>
                <td><?php echo form_dropdown("locatieId", $locatieDropdown, array($taak->locatieId), array("class" => "form-control taakId" . $taak->id, "disabled" => "true", "size" => 1, "form" => $formnaam));?></td>
                <td id="dagonderdeelDropdownCell<?php echo $taak->id ?>">
                    <?php if($taak->optieId != null){?>
                    Dagonderdeel kan niet apart worden gekozen.
                    <?php } else {
                        echo form_dropdown("dagonderdeelId", $dagonderdeelDropdown, array($taak->dagonderdeelId), array("class" => "form-control taakId" . $taak->id, "disabled" => "true", "size" => 1, "form" => $formnaam));
                    } ?>
                </td>
                <td id="optieDropdownCell<?php echo $taak->id ?>">
                    <?php if($taak->optieId != null){ ?>
                        <?php echo form_dropdown("optieId", $optieDropdown, array($taak->optieId), array("class" => "form-control taakId" . $taak->id, "disabled" => "true", "size" => 1, "form" => $formnaam));?>
                    <?php } else{ ?>
                        Deze taak hoort niet bij een optie.
                    <?php } ?>
                </td>
                <td class="text-center">
                    <?php if($taak->optieId != null){ ?>
                        <?php echo form_input(array("type" => "checkbox", "name" => "taakHeeftOptie", "class" => "checkboxHeeftOptie taakId" . $taak->id, "data-taakid" => $taak->id, "disabled" => "true", "form" => $formnaam, "checked" => "true"));?>
                    <?php } else{ ?>
                        <?php echo form_input(array("type" => "checkbox", "name" => "taakHeeftOptie", "class" => "checkboxHeeftOptie taakId" . $taak->id, "data-taakid" => $taak->id, "disabled" => "true", "form" => $formnaam));?>
                    <?php } ?>
                </td>
                <td class="text-center"><i class="fa fa-edit fa-2x taakActie taakEdit" data-taakid="<?php echo $taak->id ?>"></i></td>
                <td class="text-center"><a href="TakenEnShiften_beheren/taakVerwijderen/<?php echo $taak->id ?>"><i class="fa fa-trash fa-2x taakActie taakDelete text-dark"></i></a></td>
                <td class="text-center"><i class="fa fa-list-ul fa-2x taakActie taakDetails text-dark" id="taakDetails<?php echo $taak->id ?>" data-taakid="<?php echo $taak->id ?>"></i></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<div class="shiften"></div>
<script>
    function getComboBoxDagonderdelen(taakId){
        var combobox = "<select name='dagonderdeelId' class='form-control taakId'" + taakId + " size=1 form='taakForm'" + taakId + ">"
        $.ajax({
            url : "Dagonderdelen_beheren/getDagonderdelenLocatieNotNull",
            dataType: 'json',
            async: false,
            success: function(data){
                $.each(data, function(index, obj){
                    combobox += "<option value=" + obj["id"] + ">" + ucfirst(obj["naam"]) + "</option>"
                });
                combobox += "</select>";
            }
        });
        return combobox;
    }

    function getComboBoxOpties(taakId){
        var combobox = "<select name='optieId' class='form-control taakId" + taakId + "' size=1 form='taakForm" + taakId + "'>"
        $.ajax({
            url : "Dagonderdelen_beheren/getOptiesWithTaken",
            dataType: 'json',
            async: false,
            success: function(data){
                $.each(data, function(index, obj){
                    combobox += "<option value=" + obj["id"] + ">" + ucfirst(obj["optie"]) + " - " + ucfirst(obj["dagonderdeel"]) + "</option>"
                });
                combobox += "</select>";
            }
        });
        return combobox;
    }

    function ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    function haalShiftenOp(taakId){
        var retValue = "";
        $.ajax({
            url:"TakenEnShiften_beheren/haalAjaxOp_TaakDetails/" + taakId,
            async : false,
            success: function( data ){
                retValue = data;
            }
        });
        return retValue;
    }

    $(document).ready(function() {
        //Maak de velden van een bepaalde taak beschikbaar of submit de taak.
        $(".taakActie.taakEdit").on("click", function(){
            if($(this).hasClass("fa-edit")){
                $(".taakId" + $(this).data("taakid")).prop("disabled", false);
                $(this).removeClass("fa-edit").addClass("fa-check");
            } else{
                $("form[name=taakForm" + $(this).data("taakid") + "]").submit();
            }
        });

        $(".taakActie.taakDetails").on("click", function(){
            $(".shiften").empty().append(haalShiftenOp($(this).data("taakid")));
        });

        <?php if(isset($taakToClick)){ ?>
        //Trigger het click event de taak waar iets is in aangeapst.
        //Note: Deze code moet altijd na de code komen waarin er iets met dit click event gedaan wordt.
        $('#taakDetails<?php echo $taakToClick ?>').trigger('click');
        <?php } ?>


        $(".checkboxHeeftOptie").on("change", function(){

            if($(this).prop("checked")){
                $("#dagonderdeelDropdownCell" + $(this).data("taakid")).empty().append("Dagonderdeel kan niet apart worden gekozen.");
                $("#optieDropdownCell" + $(this).data("taakid")).empty().append(getComboBoxOpties($(this).data("taakid")));
            } else{
                $("#dagonderdeelDropdownCell" + $(this).data("taakid")).empty().append(getComboBoxDagonderdelen("taak", $(this).data("taakid")));
                $("#optieDropdownCell" + $(this).data("taakid")).empty().append("Deze taak hoort niet bij een optie.");
            }
        });

    });
</script>
