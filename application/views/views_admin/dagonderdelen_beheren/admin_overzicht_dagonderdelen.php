<?php
    $locatieDropdown = array();
    foreach($locaties as $locatie){
        $locatieDropdown[$locatie->id] = ucfirst($locatie->locatie);
    }
?>
<div class="row">
    <h4 class="col-5">Dagonderdelen</h4>
    <h4 class="col-7 text-right "><a href="<?php echo base_url() ?>/index.php/TakenEnShiften_beheren" class="">Taken en shiften<i class="fa fa-angle-double-right fa-lg"></i></a></h4>
</div>

<div class="table-responsive">
    <table class="table table-hover col-12">
        <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Begintijd</th>
            <th scope="col">Eindtijd</th>
            <th scope="col">Locatie</th>
            <th scope="col" class="text-center">Heeft deelactiviteiten</th>
            <th colspan="2" class="text-center"><a class="btn-primary btn" id="newDagonderdeel" href="Dagonderdelen_beheren/dagonderdeelToevoegen" role="button">Nieuw dagonderdeel</a></th>
            <th scope="col" class="text-center">Opties <br><i class="fa fa-angle-double-down fa-lg"></i> </th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($dagonderdelen as $dagonderdeel) { ?>

            <tr>
                <td>
                    <?php
                        $formnaam = "dagonderdeelForm" . $dagonderdeel->id;
                        echo form_open("Dagonderdelen_beheren/dagonderdeelWijzigen", array("method" => "post", "name" => $formnaam, "id" => $formnaam));
                        echo form_hidden("dagonderdeelid", $dagonderdeel->id);
                        echo form_hidden("personeelsfeestId", $dagonderdeel->personeelsfeestId);
                        echo form_input(array("type" => "text", "name" => "dagonderdeelNaam", "class" => "form-control dagonderdeelId" . $dagonderdeel->id, "disabled" => "true", "form" => $formnaam), ucfirst($dagonderdeel->naam));
                        echo form_close();
                    ?>
                </td>
                <td><?php echo form_input(array("type" => "time", "name" => "dagonderdeelBegin", "class" => "form-control dagonderdeelId" . $dagonderdeel->id,  "disabled" => "true", "form" => $formnaam), date_format($dagonderdeel->begintijd, "H:i"));?></td>
                <td><?php echo form_input(array("type" => "time", "name" => "dagonderdeelEind", "class" => "form-control dagonderdeelId" . $dagonderdeel->id,  "disabled" => "true", "form" => $formnaam), date_format($dagonderdeel->eindtijd, "H:i")) ?></td>
                <td id="dropdownCell<?php echo $dagonderdeel->id ?>">
                    <?php if($dagonderdeel->locatieId != null){ ?>
                        <?php echo form_dropdown("locatieId", $locatieDropdown, array($dagonderdeel->locatieId), array("class" => "form-control dagonderdeelId" . $dagonderdeel->id, "disabled" => "true", "size" => 1, "form" => $formnaam)) ?>
                    <?php } else{ ?>
                        De locatie verschilt per optie
                    <?php } ?>
                </td>
                <td class="text-center">
                    <?php if($dagonderdeel->locatieId != null){ ?>
                        <?php echo form_input(array("type" => "checkbox", "name" => "dagonderdeelHeeftActiviteiten", "class" => "checkboxSubactiviteiten dagonderdeelId" . $dagonderdeel->id, "data-onderdeelid" => $dagonderdeel->id, "disabled" => "true", "form" => $formnaam));?>
                    <?php } else{ ?>
                        <?php echo form_input(array("type" => "checkbox", "name" => "dagonderdeelHeeftActiviteiten", "class" => "checkboxSubactiviteiten dagonderdeelId" . $dagonderdeel->id, "data-onderdeelid" => $dagonderdeel->id, "disabled" => "true", "form" => $formnaam, "checked" => "true"));?>
                    <?php } ?>

                </td>
                <td class="text-center"><i class="fa fa-edit fa-2x dagonderdeelActie dagonderdeelEdit" data-onderdeelid="<?php echo $dagonderdeel->id ?>"></i></td>
                <td class="text-center"><a ><i class="fa fa-trash fa-2x dagonderdeelActie dagonderdeelDelete text-dark" data-dagonderdeelid="<?php echo $dagonderdeel->id ?>"></i></a></td>
                <td class="text-center"><i class="fa fa-list-ul fa-2x dagonderdeelActie dagonderdeelDetails text-dark" id="dagonderdeelDetails<?php echo $dagonderdeel->id ?>" data-onderdeelid="<?php echo $dagonderdeel->id ?>"></i></td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="DagonderdeelDialoog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4>Ben je zeker dat je dit dagonderdeel wilt verwijderen?</h4>
            <div>
                <button class="verwijderKnop btn btn-danger left">Verwijder</button>
                <button class="annuleerKnop btn btn-primary right">Annuleer</button>
            </div>
        </div>
    </div>
</div>
<div class="row optieDetails"></div>
<script>
    function getCombobox(soortId, id){
        //SoortId verwijst naar welke id er gebruikt moet worden. bv dagonderdeelId of optieId
        //Dit wordt bepaald door de form waar ze deel van moeten uitmaken.
        var combobox = "<select name='locatieId' class='form-control " + soortId + "Id" + id + "' size=1 form='" + soortId + "Form" + id + "'>";

        $.ajax({
            url: "<?php echo base_url() ?>/index.php/Dagonderdelen_beheren/getLocaties",
            dataType: 'json',
            async : false,
            success: function (data) {
                $.each(data, function(index, obj){
                    combobox += "<option value=" + obj["id"] + ">" + ucfirst(obj["locatie"]) + "</option>";
                })
                combobox += "</select>";
            }
        });
        return combobox;
    };

    function ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    function haalOptiesOp(dagonderdeelId){
        $.ajax({
            url: "<?php echo base_url() ?>/index.php/Dagonderdelen_beheren/haalAjaxOp_dagonderdeelDetails/" + dagonderdeelId,
            success: function (data) {
                $(".optieDetails").append(data);
            }
        })
    };

    function verwijderDagonderdeel(id){
        window.location.href = site_url + "/Dagonderdelen_beheren/dagonderdeelVerwijderen/" + id;
    }

    $(document).ready(function() {

        $(".dagonderdeelActie.dagonderdeelEdit").on("click", function(){
            if($(this).hasClass("fa-edit")){
                $(".dagonderdeelId" + $(this).data("onderdeelid")).prop("disabled", false);
                $(this).removeClass("fa-edit").addClass("fa-check");
            } else{
                $("form[name=dagonderdeelForm" + $(this).data("onderdeelid") + "]").submit();
            }
        });

        $(".dagonderdeelActie.dagonderdeelDetails").on("click", function(){
            $(".optieDetails").empty();
            haalOptiesOp($(this).data("onderdeelid"));
            $(".optieDetails").show();
        });

        <?php if(isset($dagonderdeelToClick)){ ?>
        //Trigger het click event op de taak waar iets is in aangepast.
        //Note: Deze code moet altijd na de code komen waarin er iets met dit click event gedaan wordt.
        $('#dagonderdeelDetails<?php echo $dagonderdeelToClick ?>').trigger('click');
        <?php } ?>

        $(".checkboxSubactiviteiten").on("change", function(){
            if($(this).prop("checked")){
                $("#dropdownCell" + $(this).data("onderdeelid")).empty().append("De locatie verschilt per optie");
            } else{
                console.log("Checked");
                $("#dropdownCell" + $(this).data("onderdeelid")).empty().append(getCombobox("dagonderdeel", $(this).data("onderdeelid")));
            }
        });

        var id;
        $(".dagonderdeelDelete").on('click', function(){
            id = $(this).data("dagonderdeelid");
            $('#DagonderdeelDialoog').modal('show');
        })

        $('.verwijderKnop').click(function() {
            $('#DagonderdeelDialoog').modal('toggle');
            verwijderDagonderdeel(id);
        });

        $('.annuleerKnop').click(function() {
            $('#DagonderdeelDialoog').modal('toggle');
        });
    });
</script>
