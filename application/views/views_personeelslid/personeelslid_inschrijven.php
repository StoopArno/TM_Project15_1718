<div class="table-responsive table-hover">
    <table class="table">
        <thead>
        <tr class="">
            <th scope="col" class="">Dagonderdeel</th>
            <th scope="col" class="">Uur</th>
            <th scope="col" class="">Opties</th>
            <th scope="col" class="">
                Commentaar
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Hier kan je opmerkingen meegeven die de organisator zou moeten weten. Bijvoorbeeld allergieën en eventuele beperkingen?"></i>
            </th>
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
                <?php if(!$dagonderdeel->heeftInschrijving){ ?>
                    <tr class="optieRow">
                        <td class="align-middle">
                            <?php
                            echo $dagonderdeel->naam;

                            $formnaam = "dagonderdeelForm" . $dagonderdeel->id;
                            echo form_open("Inschrijven_personeelslid/inschrijven", array("method" => "post", "name" => $formnaam, "id" => $formnaam));
                            //Bepaalt welke key de radiobutton zal teruggeven in post
                            echo form_hidden("dagonderdeelKey", "dagonderdeelKey" . $dagonderdeel->id);
                            echo form_close();
                            ?>
                        </td>
                        <td class="align-middle"><?php echo date_format($dagonderdeel->begintijd, "H:m") ?>
                            <i class="fa fa-arrow-right"></i> <?php echo date_format($dagonderdeel->eindtijd, "H:m") ?></td>
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

                                    <?php
                                    $attributenRadio = null;
                                    $attributenRadio["name"] = "dagonderdeelKey" . $dagonderdeel->id;
                                    $attributenRadio["id"] = "optie" . $optie->id;
                                    $attributenRadio["class"] = "col-2";
                                    $attributenRadio["form"] = $formnaam;
                                    //Bepalen of er nog ingeschreven kan worden adhv aantal inschrijvingen.
                                    //Name komt overeen met de dagonderdeelKey die in een hidden veld staat.
                                    if($optie->aantalInschrijvingen >= $optie->maxAantalInschrijvingen){
                                        $attributenRadio["disabled"] = "true";
                                    }
                                     echo form_radio($attributenRadio, $optie->id);

                                     echo form_label(ucfirst($optie->optie), "optie" . $optie->id, array("class" => "col-8 text-left")) ?>
                                    <span class="col-2"><?php echo $optie->aantalInschrijvingen . "/" . $optie->maxAantalInschrijvingen ?></span>
                                    </p>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td class="align-middle"><?php echo form_textarea(array("rows" => $opties, "form" => $formnaam, "class" => "form-control", "name" => "opmerking")) ?></td>
                        <td class="align-middle">
                            <?php echo form_submit("", "Inschrijven", array("class" => "btn btn-primary inschrijfSubmit", "data-formnaam" => $formnaam)) ?>
                        </td>
                    </tr>


                <?php } else{ ?>


                    <tr class="optieRow">
                        <td class="align-middle">
                            <?php
                            echo $dagonderdeel->naam;

                            $formnaam = "dagonderdeelForm" . $dagonderdeel->id;
                            echo form_open("Inschrijven_personeelslid/wijzigen", array("method" => "post", "name" => $formnaam, "id" => $formnaam));
                            //Bepaalt welke key de radiobutton zal teruggeven in post
                            echo form_hidden("dagonderdeelKey", "dagonderdeelKey" . $dagonderdeel->id);
                            echo form_hidden("inschrijvingId", $dagonderdeel->inschrijving->id);
                            echo form_close();
                            ?>
                        </td>
                        <td class="align-middle"><?php echo date_format($dagonderdeel->begintijd, "H:m") ?> -> <?php echo date_format($dagonderdeel->eindtijd, "H:m") ?></td>
                        <td class="align-middle opties<?php echo $formnaam ?> cellOpties">
                            <?php foreach($dagonderdeel->opties as $optie){
                                $teller++;
                                ?>
                                <?php if($optie->personeel_kan_inschrijven == "ja"){ ?>
                                    <?php if($opties == 1){ ?>
                                        <p class="optieLastInschrijfItem optieInschrijfItem optieOnlyInschrijfItem row col-12">
                                    <?php } else if($teller == $opties){ ?>
                                        <p class="optieLastInschrijfItem optieInschrijfItem row col-12">
                                    <?php } else{ ?>
                                        <p class="optieMiddleInschrijfItem optieInschrijfItem row col-12">
                                    <?php } ?>

                                    <?php //Name komt overeen met de dagonderdeelKey die in een hidden veld staat.
                                    $attributenRadio = null;
                                    $attributenRadio["name"] = "dagonderdeelKey" . $dagonderdeel->id;
                                    $attributenRadio["id"] = "optie" . $optie->id;
                                    $attributenRadio["class"] = "col-2";
                                    $attributenRadio["form"] = $formnaam;
                                    if($optie->id == $dagonderdeel->inschrijving->optieid){
                                        $attributenRadio["checked"] = "true";
                                    }
                                    if($optie->aantalInschrijvingen >= $optie->maxAantalInschrijvingen){
                                        $attributenRadio["disabled"] = "true";
                                    }
                                    echo form_radio($attributenRadio, $optie->id);
                                    echo form_label(ucfirst($optie->optie), "optie" . $optie->id, array("class" => "col-8 text-left")); ?>
                                    <span class="col-2"><?php echo $optie->aantalInschrijvingen . "/" . $optie->maxAantalInschrijvingen ?></span>
                                    </p>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <?php $rows = 3;
                        if($opties > 3){$rows = $opties;}?>
                        <td class="align-middle"><?php echo form_textarea(array("rows" => $rows, "form" => $formnaam, "class" => "form-control", "name" => "opmerking", "value" => $dagonderdeel->inschrijving->opmerking)) ?></td>
                        <td class="align-middle">
                            <p><?php echo form_submit("", "Inschrijving wijzigen", array("class" => "btn btn-primary ", "form" => $formnaam)) ?></p>
                            <p><a href="#" data-dagonderdeelid="<?php echo $dagonderdeel->inschrijving->id ?>" class="btn btn-primary uitschrijfKnop">Uitschrijven</a></p>
                        </td>
                    </tr>
                <?php } ?>
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

        $(".uitschrijfKnop").on('click', function(){
            var dagonderdeel = $(this).data('dagonderdeelid');
            if(confirm('Weet u zeker dat u zich wilt uitschrijven?')){
                window.location = "<?php echo base_url() ?>index.php/Inschrijven_personeelslid/uitschrijven/" + dagonderdeel;
            }
        })

        $('[data-toggle="tooltip"]').tooltip();
    })
</script>