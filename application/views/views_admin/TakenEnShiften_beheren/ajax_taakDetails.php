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
                    <td class="text-center"><a href="<?php echo base_url() ?>index.php/TakenEnShiften_beheren/shiftVerwijderen/<?php echo $shift->id ?>"><i class="fa fa-trash fa-2x shiftActie shiftDelete text-dark"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
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
    });
</script>