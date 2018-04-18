<script>
    $(document).ready(function () {

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
        $("#voeghelpertoe").click(function () {

            $(".voeghelpertoe").removeClass("hidden");


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
            $(".voeghelpertoe").addClass("hidden");
        });

    });
</script>
<div>


</div>
<div class="col-lg-12">
    <h2>Personeel <i id="editpersoneel" class="glyphicon glyphicon-pencil" aria-hidden="true"></i></h2>


    <table class="table text-center col-lg-12 ">

        <tr class="table-kleur">
            <td class="aanpasbug hidden"></td>
            <td>Naam</td>
            <?php
            foreach ($dagonderdelen as $dagonderdeel) {

                $begintijd = explode(" ", $dagonderdeel->begintijd);
                $eindtijd = explode(" ", $dagonderdeel->eindtijd);

                $begintijdpertwee = explode(":", $begintijd[1]);
                $eindtijdpertwee = explode(":", $eindtijd[1]);

                echo "<td class=''> <p class='' >  " . $begintijdpertwee[0] . ":" . $begintijdpertwee[1] . "-" . $eindtijdpertwee[0] . ":" . $eindtijdpertwee[1] . "</p><p>" . $dagonderdeel->naam . "</p></td>";

            }
            ?>


            <?php
            foreach ($personeelsleden as $personeelslid) {

                echo "<tr><td class='edit hidden' >";
                echo anchor('Overzicht_helpers_personeelsleden/index/' . $personeelslid->id, ' ', ' class="glyphicon text-dark glyphicon-pencil editpersoneelslid"');
                echo anchor('Overzicht_helpers_personeelsleden/verwijderPersoneelslid/' . $personeelslid->id, ' ', 'class=" text-dark  glyphicon glyphicon-trash verwijderpersoneelslid"') . "</td>";

                echo " <td> " . $personeelslid->naam . " " . $personeelslid->voornaam . "</td>";

                foreach ($dagonderdelen as $dagonderdeel) {
                    $fix = 0;
                    foreach ($dagonderdeel->opties as $optie) {

                        if ($optie->inschrijvingen != null) {

                            foreach ($optie->inschrijvingen as $inschrijving) {
                                if ($inschrijving->persoonid == $personeelslid->id) {
                                    echo "<td>" . $optie->optie . "</td>";
                                    $fix = 1;
                                }

                            }
                        }


                    }
                    if ($fix == 0) {
                        echo "<td>/</td>";
                    }

                }
                echo "</tr>";
            }

            ?>

    </table>
</div>
<?php
if ($lid == "") {
    $familienaam = "";
    $voornaam = "";
    $tel = "";
    $email = "";
} else {
    $familienaam = $lid->naam;
    $voornaam = $lid->voornaam;
    $tel = $lid->gsm_nummer;
    $email = $lid->email;
}

?>

<h2><i id="voegpersoneelslidtoe" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i></h2>


<div class="voegpersoneelslidtoe hidden col-sm-12 col-md-12 col-lg-12 ">
    <div class="col-lg-12">
        <?php echo form_open('overzicht_helpers_personeelsleden/voegPersoneelslidToe'); ?>
        <div class="col-lg-8">

            <div class="form-group  ">
                <label for="voornaam">Voornaam</label>
                <?php echo '   <input required type="text" class="form-control" placeholder="Voornaam" value="' . $voornaam . '" name="voornaam">' ?>
                <small class="form-text text-muted">Voer hier de voornaam in.</small>
            </div>
            <div class="form-group">
                <label for="familienaam">Familienaam</label>
                <?php
                echo '<input type="text" required class="form-control" placeholder="Familienaam" name="familienaam" id="familienaam" value="' . $familienaam

                    . '"> '?>
                <small class="form-text text-muted">Voer hier de familienaam in.</small>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <?php echo '      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="' . $email . '" placeholder="Email"
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
            <h2>Inschrijven voor</h2>
            <div class="col-lg-6 ">

                <?php
                $dagonderdeelidoud = "";
                $total = count($opties);
                $tel = 0;
                foreach ($opties as $optie) {
                    $tel++;
                    if ($total / 2 < $tel) {
                        echo "</div><div class='col-lg-6'>";
                        $tel = 0;
                    }
                    $dagonderdeelid = $optie->dagonderdeelId;
                    if ($dagonderdeelid != $dagonderdeelidoud) {
                        echo '<h4>' . $optie->dagonderdeel->naam . '</h4>';
                    }
                    echo '<p ><input class="form-check-input" name="inschrijvingen[]" type="checkbox" value="' . $optie->id . '" id="' . $optie->id . '" > &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <label class="filter form-check-label" for="' . $optie->id . '">' . $optie->optie . '
        </label></p>';
                    $dagonderdeelidoud = $dagonderdeelid;
                }
                ?>
            </div>
        </div>
        <button type="submit" class="col-lg-2 btn btn-primary ">Voeg toe</button>
        <button id="annuleer" class="col-lg-2  btn btn-danger ">Annuleer</button>
        <?php form_close() ?>
    </div>
</div>


<div class="hidden">
    <h2>Filter op</h2>

    <?php
    echo form_open('Overzicht_helpers_personeelsleden/filter');
    $dagonderdeelidoud = "";
    foreach ($opties as $optie) {
        $dagonderdeelid = $optie->dagonderdeelId;
        if ($dagonderdeelid != $dagonderdeelidoud) {
            echo '<h4>' . $optie->dagonderdeel->naam . '</h4>';
        }
        echo '<p ><input class="custom-radio" type="radio" value="' . $optie->id . '" id="' . $optie->id . '" > &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <label class="filter form-check-label" for="' . $optie->id . '">' . $optie->optie . '
        </label></p>';


        $dagonderdeelidoud = $dagonderdeelid;
    }
    echo form_submit('filter', 'filter');
    echo form_close();
    ?>


</div>




<div class="col-lg-12">
    <h2>Helpers <i id="edithelper" class="glyphicon glyphicon-pencil" aria-hidden="true"></i></h2>


    <table class="table text-center col-lg-12 ">
    <tr class="table-kleur">
        <td class="aanpasbug3 hidden"></td>
        <td>Naam</td>
        <?php
        foreach ($shifturen as $uur) {

            $begintijd = explode(" ", $uur->beginuur);
            $eindtijd = explode(" ", $uur->einduur);

            $begintijdpertwee = explode(":", $begintijd[1]);
            $eindtijdpertwee = explode(":", $eindtijd[1]);

            echo "<td class=''> <p class='' >  " . $begintijdpertwee[0] . ":" . $begintijdpertwee[1] . "-" . $eindtijdpertwee[0] . ":" . $eindtijdpertwee[1] . "</p></td>";

        }
        echo "</tr>";

        foreach ($helpers as $helper){
     echo '<tr>  <td class=" edithelper hidden">';
            echo anchor('Overzicht_helpers_personeelsleden/index/' . $helper->id, ' ', ' class="glyphicon text-dark glyphicon-pencil edithelper"');
            echo anchor('Overzicht_helpers_personeelsleden/verwijderHelper/' . $helper->id, ' ', 'class=" text-dark  glyphicon glyphicon-trash verwijderhelper"') . "</td>";

            echo '<td> ' . $helper->naam . " " . $helper->voornaam . '</td>';
            foreach ($shifturen as $uur){
               $fix =0;
                foreach ($shiftinschrijvingen as $inschrijving) {
                    if ($uur->id==$inschrijving->shiftid){
                        if ($helper->id == $inschrijving->persoonid) {
                            echo '<td>' . $inschrijvingenshiften[$inschrijving->shiftid]->naam . '</td>';
                            $fix =1;
                        }

                    }

                }
                if ($fix==0){
                    echo '<td> / </td>';
                }
            }
            echo '</tr>' ;
        }
        ?>



    </table>

    <h2><i id="voeghelpertoe" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i></h2>
    <div class="voeghelpertoe hidden col-sm-12 col-md-12 col-lg-12 ">
    <?php echo form_open('overzicht_helpers_personeelsleden/voeghelperToe'); ?>
    <div class="col-lg-8">

        <div class="form-group  ">
            <label for="voornaam">Voornaam</label>
            <?php echo '   <input required type="text" class="form-control" placeholder="Voornaam" value="' . $voornaam . '" name="voornaam">' ?>
            <small class="form-text text-muted">Voer hier de voornaam in.</small>
        </div>
        <div class="form-group">
            <label for="familienaam">Familienaam</label>
            <?php
            echo '<input type="text" required class="form-control" placeholder="Familienaam" name="familienaam" id="familienaam" value="' . $familienaam

                . '"> ' ?>
            <small class="form-text text-muted">Voer hier de familienaam in.</small>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <?php echo '      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="' . $email . '" placeholder="Email"
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
            <div class="col-lg-6 ">

                <?php
             foreach ($shifturen as $shift){
                 echo '<p ><input class="form-check-input" name="inschrijvingenhelper[]" type="checkbox" value="' . $shift->id . '" id="' . $shift->id . '" > &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <label class="filter form-check-label" for="' . $shift->id . '">' . $shift->omschrijving . '
        </label></p>';
             }
                ?>
            </div>
        </div>


    <button type="submit" class="col-lg-2 btn btn-primary ">Voeg toe</button>
    <button id="annuleerhelper" class="col-lg-2  btn btn-danger ">Annuleer</button>
    <?php form_close() ?>
    </div>
</div>
</div>
</div>