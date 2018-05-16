<?php
/**
 * @file views_admin/TakenEnShiften_beheren/ajax_taakDetails.php
 *
 * View dat wordt opgehaald in admin_overzicht_TakenShiften.php voor het tonen van shiften specifiek voor een taak.
 *      - Krijgt een shiften-array binnen.
 */
?>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Omschrijving</th>
                <th scope="col">Beginuur</th>
                <th scope="col">Einduur</th>
                <th scope="col" colspan="2" class="text-center"><a class="btn-primary btn" id="newShift" href="TakenEnShiften_beheren/shiftToevoegen/<?php echo $taakId ?>" role="button">Nieuwe shift</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($shiften as $shift){ ?>
                <tr>
                    <td>
                        <?php
                            $shiftFormNaam = "shiftForm" . $shift->id;
                            echo form_open("TakenEnShiften_beheren/shiftWijzigen", array("name" => $shiftFormNaam, "method" => "post", "id" => $shiftFormNaam));
                            echo form_input(array("type" => "text", "name" => "shiftOmschrijving", "class" => "form-control shiftId" . $shift->id, "disabled" => "true", "form" => $shiftFormNaam), ucfirst($shift->omschrijving));
                            echo form_hidden("shiftId", $shift->id);
                            echo form_hidden("shiftTaakId", $shift->taakid);
                            echo form_close();
                        ?>
                    </td>
                    <td><?php echo form_input(array("type" => "time", "name" => "shiftBegin", "class" => "form-control shiftId" . $shift->id, "disabled" => "true", "form" => $shiftFormNaam), date_format($shift->beginuur, "H:i")); ?></td>
                    <td><?php echo form_input(array("type" => "time", "name" => "shiftEind", "class" => "form-control shiftId" . $shift->id, "disabled" => "true", "form" => $shiftFormNaam), date_format($shift->einduur, "H:i")); ?></td>
                    <td class="text-center"><i class="fa fa-edit fa-2x shiftActie shiftEdit" data-shiftid="<?php echo $shift->id ?>"></i></td>
                    <td class="text-center"><i class="fa fa-trash fa-2x shiftActie shiftDelete text-dark" data-shiftid="<?php echo $shift->id ?>"></i></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="ShiftDialoog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4>Ben je zeker dat je deze taak wilt verwijderen?</h4>
            <div>
                <button class="verwijderKnop btn btn-danger left">Verwijder</button>
                <button class="annuleerKnop btn btn-primary right">Annuleer</button>
            </div>
        </div>
    </div>
</div>
<script>
    function verwijderShift(id){
        window.location.href = site_url + "/TakenEnShiften_beheren/shiftVerwijderen/" + id;
    }

    $(document).ready(function() {
        $(".shiftActie.shiftEdit").on("click", function(){
            if($(this).hasClass("fa-edit")){
                $(".shiftId" + $(this).data("shiftid")).prop("disabled", false);
                $(this).removeClass("fa-edit").addClass("fa-check");
            } else{
                $("form[name=shiftForm" + $(this).data("shiftid") + "]").submit();
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
        $('.shiftDelete').click(function() {
            id = $(this).data("shiftid");
            $('#ShiftDialoog').modal('show');
        });

        $('.verwijderKnop').click(function() {
            $('#ShiftDialoog').modal('toggle');
            verwijderTaak(id);
        });

        $('.annuleerKnop').click(function() {
            $('#ShiftDialoog').modal('toggle');
        });
    });
</script>