
<?php /**
 * @file views_admin/admin_overzicht_helpers_personeel.php
 *
 * View die een overzicht geeft van alle helpers en personeelsleden en hun bijhordende ischrijvingen
 * De inschrijvingen van zowel de helpers en personeelsleden kunnen verwijderd en aangepast worden.
 *Er kunnen ook nieuwe personen met inschrijvingen toegevoegd worden
 *      - Krijgt een dagonderdelen-array binnen.
 *      - Krijgt een helpers-array binnen.
 *      - Krijgt een personeelsleden-array binnen.
 *      - Krijgt een inschrijvingen-array binnen
 *      - Krijgt een shiftinschrijvingen-array binnen
 *      - Krijgt een shifturen-array binnen
 *      - Krijgt een shiften-array binnen
 */
?>


  
   <script>

    $(document).ready(function () {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $("#editpersoneel").click(function () {
            if ($("#editpersoneel").hasClass("glyphicon-pencil")) {
                $(".edit").removeClass("hidden");
                $(".aanpasbug").removeClass("hidden");
                $("#editpersoneel").removeClass("glyphicon-pencil");
                $("#editpersoneel").addClass("glyphicon-floppy-save");

            }
            else {
                $(".edit").addClass("hidden");
                $(".aanpasbug").addClass("hidden");
                $("#editpersoneel").removeClass("glyphicon-floppy-save");
                $("#editpersoneel").addClass("glyphicon-pencil");

            }


        });
        $("#printpersoneel").click(function () {
            $("#printhelper").hide();
            $("#voegpersoneelslidtoe").hide();
            $("#personeelh2").hide();
            $(".page-footer").hide();
            print();
            $("#printhelper").show();
            $("#personeelh2").show();
            $(".page-footer").show();

            $("#voegpersoneelslidtoe").show();

        });
        $("#printhelpers").click(function () {
            $("#printpers").hide();
            $("#personeelh2").hide();
            $("#voegpersoneelslidtoe").hide();
            $("#voeghelpertoe").hide();
            $("#helpersh2").hide();
            $(".page-footer").hide();
            print();
            $("#printpers").show();

            $(".page-footer").show();
            $("#voeghelpertoe").show();
            $("#voegpersoneelslidtoe").show();
            $("#personeelh2").show();
            $("#helpersh2").show();
        });
        $("#edithelper").click(function () {
            if ($("#edithelper").hasClass("glyphicon-pencil")) {
                $(".edithelper").removeClass("hidden");
                $(".aanpasbug3").removeClass("hidden");
                $("#edithelper").removeClass("glyphicon-pencil");
                $("#edithelper").addClass("glyphicon-floppy-save");

            }
            else {
                $(".edithelper").addClass("hidden");
                $(".aanpasbug3").addClass("hidden");
                $("#edithelper").removeClass("glyphicon-floppy-save");
                $("#edithelper").addClass("glyphicon-pencil");

            }


        });
        $('.verwijderknop').click(function () {
            var id;

            id = $(this).attr('id');

            verwijderKnop(id);
        });

        $("#voeghelpertoe").click(function () {

            $(".voeghelpertoe").removeClass("hidden");
            //hierzo

            $("#annuleerhelper").removeClass("hidden");
            $(".voeghelpertoeknop").removeClass("hidden");

        });

        $("#voegpersoneelslidtoe").click(function () {

            $(".voegpersoneelslidtoe").removeClass("hidden");

        });
        $(".editpersoneelslid").click(function () {

            $(".voegpersoneelslidtoe").removeClass("hidden");

        });
        $("#annuleer").click(function () {
            $(".voegpersoneelslidtoe").addClass("hidden");
        });
        $("#annuleerhelper").click(function () {

            $("#annuleerhelper").addClass("hidden");
            $(".voeghelpertoeknop").addClass("hidden");
            $(".voeghelpertoe").addClass("hidden");
        });
    });
</script>
<div>
</div>
<div class="personeel col-lg-12">

    <h2 class="text-center" id="personeelh2">Personeel <i id="editpersoneel" class="glyphicon glyphicon-pencil"
                                                          aria-hidden="true"></i><i
                id="printpersoneel" class="glyphicon glyphicon-print"></i></h2>


    <table id="printpers" class="personeeltabel table text-center col-lg-12 ">

        <tr class="table-kleur">
            <td class="aanpasbug hidden"></td>
            <td class="text-left">Naam</td>
            <?php
            foreach ($dagonderdelen as $dagonderdeel) {

                $begintijd = explode(" ", $dagonderdeel->begintijd);
                $eindtijd = explode(" ", $dagonderdeel->eindtijd);

                $begintijdpertwee = explode(":", $begintijd[1]);
                $eindtijdpertwee = explode(":", $eindtijd[1]);

                echo "<td class='text-left'> <p class='' >  " . $begintijdpertwee[0] . ":" . $begintijdpertwee[1] . "-" . $eindtijdpertwee[0] . ":" . $eindtijdpertwee[1] . "</p><p>" . $dagonderdeel->naam . "</p></td>";

            }


            ?>


            <?php
            foreach ($personeelsleden as $personeelslid) {

                echo "<tr><td class='edit hidden' >";
                echo anchor('Overzicht_helpers_personeelsleden/editPersoneelslid/' . $personeelslid->id, ' ', ' class="glyphicon text-dark glyphicon-pencil editpersoneelslid"');
                echo anchor('Overzicht_helpers_personeelsleden/verwijderPersoneelslid/' . $personeelslid->id, ' ', 'class=" text-dark  glyphicon glyphicon-trash verwijderpersoneelslid"');

                echo " <td class='text-left'> " . $personeelslid->naam . " " . $personeelslid->voornaam . "</td>";

                foreach ($dagonderdelen as $dagonderdeel) {
                    $fix = 0;
                    foreach ($dagonderdeel->opties as $optie) {

                        if ($optie->inschrijvingen != null) {

                            foreach ($optie->inschrijvingen as $inschrijving) {

                                if ($inschrijving->persoonid == $personeelslid->id) {

                                    $opmerking = $inschrijving->opmerking;
                                    echo "<td class='text-left'>" . '<i  class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="' . $opmerking . '" data-placement="top" > 
                           
 </i>' . $optie->optie . "</td>";
                                    $fix = 1;
                                }

                            }
                        }


                    }
                    if ($fix == 0) {
                        echo "<td class='text-left'></td>";
                    }

                }




                echo '</tr>';
            }

            ?>

    </table>
</div>
<?php

?>

<h2 class="text-center"><i id="voegpersoneelslidtoe" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i></h2>


<div class="voegpersoneelslidtoe hidden col-sm-12 col-md-12 col-lg-12 ">
    <div class="col-lg-12">
        <?php echo form_open('overzicht_helpers_personeelsleden/voegPersoneelslidToe'); ?>
        <div class="col-lg-8">
            <h2>persoon</h2>

            <div class="form-group">
                <label for="familienaam">Familienaam</label>
                <input type="text" class="form-control" placeholder="Familienaam" name="familienaam" required>
                <small class="form-text text-muted">Voer hier de familienaam in.</small>
            </div>
            <div class="form-group">
                <label for="voornaam">Voornaam</label>
                <input type="text" class="form-control" placeholder="Voornaam" name="voornaam" required>
                <small class="form-text text-muted">Voer hier de voornaam in.</small>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email"
                       name="email" required>
                <small id="emailHelp" class="form-text text-muted">Voer hier de email in.</small>
            </div>


            <div class="form-group">
                <label for="number">GSM Nummer</label>
                <input type="number" min="0" class="form-control" id="gsm" aria-describedby="emailHelp"
                       placeholder="GSM Nummer" name="gsm">
                <small id="emailHelp" class="form-text text-muted">Voer hier de GSM nummer in.</small>
            </div>

        </div>
        <div class="col-lg-4">
            <h2>Inschrijven voor</h2>
            <div class="col-lg-6">

                <?php
                $dagonderdeelidoud = "";
                $total = count($opties);
                $tel = 0;
                foreach ($opties as $optie) {
                    $tel++;

                    $dagonderdeelid = $optie->dagonderdeelId;
                    if ($dagonderdeelid != $dagonderdeelidoud) {
                        if ($total / 2 < $tel) {
                            echo "</div><div class='col-lg-6'>";
                            $tel = 0;
                        }
                        echo '<h4>' . $optie->dagonderdeel->naam . '</h4>';

                    }
                    echo '<p><input class="form-check-input" name="inschrijvingen[]" type="checkbox" value="' . $optie->id . '" id="' . $optie->id . '" > &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ' . $optie->optie . '
      </p>';
                    $dagonderdeelidoud = $dagonderdeelid;
                }
                ?>
            </div>


        </div>
        <div class="col-lg-12">
            <p>
                <button type="submit" class="btn btn-primary ">Voeg toe</button>
                <button id="annuleer" class="btn btn-danger red ">Annuleer</button>
            </p>

        </div>
        </form>
    </div>
</div>


<div id="printhelper" class="col-lg-12">
    <h2 class="text-center" id="helpersh2">Helpers <i id="edithelper" class="glyphicon glyphicon-pencil"
                                                      aria-hidden="true"></i> <i
                id="printhelpers" class="glyphicon glyphicon-print"></i></h2>


    <table class="table  text-center col-lg-12 ">
        <tr class="table-kleur">
            <td class="aanpasbug3 hidden"></td>
            <td class="text-lg-left">Naam</td>
            <?php

$ouduur="";
            foreach ($shifturen as $uur) {


                $nieuwuur=$uur->beginuur;

        if ($nieuwuur!=$ouduur){
    $begintijd = explode(" ", $uur->beginuur);
    $eindtijd = explode(" ", $uur->einduur);

    $begintijdpertwee = explode(":", $begintijd[1]);
    $eindtijdpertwee = explode(":", $eindtijd[1]);


    echo "<td class='text-lg-left'> <p class='' >  " . $begintijdpertwee[0] . ":" . $begintijdpertwee[1] . "-" . $eindtijdpertwee[0] . ":" . $eindtijdpertwee[1] . "</p></td>";

            }

            $ouduur=$nieuwuur;
            }
            echo "</tr>";

            foreach ($helpers as $helper) {
                $helperid = $helper->id;

                echo '<tr>  <td class=" row edithelper hidden">';
                echo anchor('Overzicht_helpers_personeelsleden/editHelper/' . $helper->id, ' ', ' class="glyphicon text-dark glyphicon-pencil edithelper"');
                echo anchor('Overzicht_helpers_personeelsleden/verwijderHelper/' . $helper->id, ' ', 'class=" text-dark left  glyphicon glyphicon-trash verwijderhelper"') . "</td>";

                echo '<td class="text-lg-left"> ' . $helper->naam . " " . $helper->voornaam . '</td>';
                $oud="";
                foreach ($shifturen as $uur) {
                    $helper = 0;

                    $nieuw = $uur->beginuur;
                    if ($nieuw != $oud) {


                        foreach ($shiften as $shift) {
                            if ($shift->beginuur == $uur->beginuur) {
                                foreach ($shiftinschrijvingen as $shiftinschrijving) {

                                    if ($shiftinschrijving->shiftid == $shift->id && $helper == 0 && $helperid == $shiftinschrijving->persoonid) {

                                        $helper = 1;
                                        echo '<td class="text-lg-left">' . $shift->omschrijving . '</td>';

                                    }
                                }
                            }
                        }
                        if ($helper == 0) {

                            echo '<td class="text-lg-left"></td>';
                        }

                    }
                    $oud = $nieuw;

                }
                echo '</tr>';
            }
            ?>


    </table>

    <h2 class="text-center"><i id="voeghelpertoe" class="  glyphicon glyphicon-plus-sign" aria-hidden="true"></i></h2>
    <?php echo form_open('overzicht_helpers_personeelsleden/voeghelperToe'); ?>
    <div class="voeghelpertoe hidden  ">

        <div class="col-lg-8">
            <h2>Helper</h2>
            <div class="form-group  ">
                <label for="voornaam">Voornaam</label>
                <?php echo '   <input required type="text" class="form-control" placeholder="Voornaam" name="voornaam">' ?>
                <small class="form-text text-muted">Voer hier de voornaam in.</small>
            </div>
            <div class="form-group">
                <label for="familienaam">Familienaam</label>
                <?php
                echo '<input type="text" required class="form-control" placeholder="Familienaam" name="familienaam" id="familienaam" 

                    > ' ?>
                <small class="form-text text-muted">Voer hier de familienaam in.</small>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <?php echo '      <input type="email" class="form-control" id="email" aria-describedby="emailHelp"  placeholder="Email"
                           name="email"> ' ?>
                <small id="emailHelp" class="form-text text-muted">Voer hier de email in.</small>
            </div>


            <div class="form-group">
                <label for="number">GSM Nummer</label>
                <input type="number" min="0" class="form-control" id="gsm" aria-describedby="emailHelp"
                       placeholder="GSM Nummer" name="gsm">
                <small id="emailHelp" class="form-text text-muted">Voer hier de GSM nummer in.</small>
            </div>
        </div>
        <div class="col-lg-4">
            <h2>Komt helpen bij</h2>
            <div class="col-sm-6 col-md-6 col-lg-6">

                <?php

                $beginuuroud = "";

                $teller = 0;
                foreach ($shiften as $shift) {
                    if ($teller == 3) {
                        echo '</div><div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">';
                    }

                    $beginuur = explode(" ", $shift->beginuur);
                    $einduur = explode(" ", $shift->einduur);
                    $beginuurenmin = explode(":", $beginuur[1]);
                    $einduurenmin = explode(":", $einduur[1]);

                    if ($beginuur[1] != $beginuuroud) {
                        $teller += 1;
                        echo '<h3>' . $beginuurenmin[0] . ':' . $beginuurenmin[1] . '-' . $einduurenmin[0] . ':' . $einduurenmin[1] . '</h3>';
                    }


                    echo '<p class="row"><input class="form-check-input"  name="inschrijvingenhelper[]" type="checkbox" value="' . $shift->id . '" id="' . $shift->id . '" >  &nbsp;&nbsp;&nbsp; ' . $shift->omschrijving;


                    $beginuuroud = $beginuur[1];

                }


                ?>


            </div>
        </div>


    </div>
    <button type="submit" class="hidden voeghelpertoeknop btn btn-primary ">Voeg toe</button>
    <button id="annuleerhelper" class="hidden btn btn-danger red ">Annuleer</button>
    <?php form_close() ?>

</div>
</div>
</div>