<div class="table-responsive table-hover">
    <table class="table">
        <thead>
        <tr class="">
            <th scope="col" class="">Dagonderdeel</th>
            <th scope="col" class="">Uur</th>
            <th scope="col" class="">Opties</th>
            <th scope="col" class="">Commentaar</th>
            <th scope="col" class="">Inschrijven</th>
        </tr>
        </thead>
        <tbody >
        <?php foreach($dagonderdelen as $dagonderdeel){ ?>
            <?php
            $opties = 0;
            $teller = 0;
            foreach($dagonderdeel->opties as $optie){
                if($optie->personeel_kan_inschrijven == "ja"){
                    $opties++;
                }
            }
            ?>
            <?php if($dagonderdeel->opties != null){ ?>
                <tr class="optieRow">
                    <td class="align-middle">
                        <?php
                        echo $dagonderdeel->naam;

                        $formnaam = "dagonderdeelForm" . $dagonderdeel->id;
                        echo form_open("Inschrijven_personeelslid/inschrijven", array("method" => "post", "name" => $formnaam, "id" => $formnaam));
                        echo form_close();
                        ?>
                    </td>
                    <td class="align-middle"><?php echo date_format($dagonderdeel->begintijd, "H:m") ?> -> <?php echo date_format($dagonderdeel->eindtijd, "H:m") ?></td>
                    <td class="align-middle row opties<?php echo $formnaam ?>">
                        <?php foreach($dagonderdeel->opties as $optie){
                            $teller++;
                        ?>
                            <?php if($optie->personeel_kan_inschrijven == "ja"){ ?>
                                <?php if($teller == $opties){ ?>
                                    <p class="optieLastInschrijfItem optieInschrijfItem row col-12 ">
                                <?php } else{ ?>
                                    <p class="optieMiddleInschrijfItem optieInschrijfItem row col-12">
                                <?php } ?>
                                <?php echo form_radio(array("name" => $dagonderdeel->naam . $dagonderdeel->id, "id" => "optie" . $optie->id, "class" => "col-2", "form" => $formnaam), $optie->id) ?>
                                <?php echo form_label(ucfirst($optie->optie), "optie" . $optie->id, array("class" => "col-10 text-left")) ?>
                                </p>
                            <?php } ?>
                        <?php } ?>
                    </td>
                    <td class="align-middle"><?php echo form_textarea(array("rows" => $opties, "form" => $formnaam, "class" => "form-control", "name" => "commentaar")) ?></td>
                    <td class="align-middle">
                        <?php echo form_submit("", "Inschrijven", array("class" => "btn btn-primary inschrijfSubmit", "data-formnaam" => $formnaam)) ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $( document ).ready(function(){
        $(".inschrijfSubmit").on('click', function(){
            var formnaam = $(this).data("formnaam")
            var optiegekozen = false;
            $.each($(".opties" + formnaam).children(), function(int, obj){
                if($(obj).find("input").prop("checked")){
                    optiegekozen = true;
                }
            })

            if(!optiegekozen){
                alert("Gelieve een optie te kiezen voor dit dagonderdeel!");
            } else{
                console.log("#" + $(this).data("formnaam"))
                $("#" + $(this).data("formnaam")).submit();
            }
        })
    })
</script>