<script>
    $(document).ready(function () {
        $("#naam").keyup(function () {
            if ($(this).val() == "") {
                $("#result").html("");
            } else {
                haalPersoneelOp($(this).val());
            }


        });


        function haalPersoneelOp(zoekstring) {

            $.ajax({
                type: "GET",
                url: site_url + "/overzicht_helpers_personeelsleden/index",
                data: {filter: zoekstring},
                success: function (result) {

                    $("#result").html(result);


                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
        }


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

        $("#voegpersoneelslidtoe").click(function () {

            $(".voegpersoneelslidtoe").removeClass("hidden");


        });
        $(".editpersoneelslid").click(function () {

            $(".voegpersoneelslidtoe").removeClass("hidden");


        });
        $("#annuleer").click(function () {
            $(".voegpersoneelslidtoe").addClass("hidden");
        });

    });
</script>
<div class="col-lg-10">
    <h2>Personeel <i id="editpersoneel" class="glyphicon glyphicon-pencil" aria-hidden="true"></i></h2>
    <div class="form-group">

        <?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'col-lg-12')) ?>
    </div>
    <div id="result">
        <table class="table col-lg-12 ">

            <tr>
                <td class="aanpasbug hidden"></td>
                <td>Naam</td>
                <?php
                foreach ($dagonderdelen as $dagonderdeel) {

                    $begintijd = explode(" ", $dagonderdeel->begintijd);
                    $eindtijd = explode(" ", $dagonderdeel->eindtijd);

                    $begintijdpertwee = explode(":", $begintijd[1]);
                    $eindtijdpertwee = explode(":", $eindtijd[1]);
                    if ($dagonderdeel->naam == "fuif") {

                        echo "<td>" . $dagonderdeel->naam . "</td>";
                    } elseif ($dagonderdeel->naam == "vervoer") {

                        echo "<td>" . $dagonderdeel->naam . "</td>";
                    } else {
                        echo "<td>" . $begintijdpertwee[0] . ":" . $begintijdpertwee[1] . "-" . $eindtijdpertwee[0] . ":" . $eindtijdpertwee[1] . "</td>";
                    }
                }
                ?>
            </tr>

            <?php
            foreach ($personeelsleden as $personeelslid) {

                echo "<tr><td class='edit hidden' >";
                echo anchor('Overzicht_helpers_personeelsleden/index/' . $personeelslid->id, ' ', ' class="glyphicon glyphicon-pencil editpersoneelslid"');
                echo anchor('Overzicht_helpers_personeelsleden/verwijderPersoneelslid/' . $personeelslid->id, ' ', 'class="glyphicon glyphicon-trash verwijderpersoneelslid"') . "</td>";

                echo " <td> " . $personeelslid->voornaam . " " . $personeelslid->naam . "</td>";

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


    <div class="voegpersoneelslidtoe hidden col-sm-12 col-md-12 col-lg-12  ">

        <?php echo form_open('overzicht_helpers_personeelsleden/voegPersoneelslidToe'); ?>

        <div class="form-group">
            <label for="familienaam">Familienaam</label>
            <?php
            echo '<input type="text" class="form-control" placeholder="Familienaam" name="familienaam" id="familienaam" value="' . $familienaam

                . '"> ' ?>
            <small class="form-text text-muted">Voer hier de familienaam in.</small>
        </div>
        <div class="form-group  ">
            <label for="voornaam">Voornaam</label>
            <?php echo '   <input type="text" class="form-control" placeholder="Voornaam" value="' . $voornaam . '" name="voornaam">' ?>
            <small class="form-text text-muted">Voer hier de voornaam in.</small>
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


        <button type="submit" class="col-lg-2 btn btn-primary ">Voeg toe</button>
        </form>

        <button id="annuleer" class="col-lg-2  btn btn-danger ">Annuleer</button>
    </div>
</div>
<div class="col-lg-2">
    <h2>Filter op</h2>

    <?php
   echo  form_open('Overzicht_helpers_personeelsleden/filter');
    $dagonderdeelidoud = "";
    foreach ($opties as $optie) {
        $dagonderdeelid = $optie->dagonderdeelId;
        if ($dagonderdeelid != $dagonderdeelidoud) {
            echo '<h4>' . $optie->dagonderdeel->naam . '</h4>';
        }
        echo '<p ><input class="form-check-input" type="radio" value="' . $optie->id . '" id="' . $optie->id . '" > &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <label class="filter form-check-label" for="' . $optie->id . '">' . $optie->optie . '
        </label></p>';


        $dagonderdeelidoud = $dagonderdeelid;
    }
echo form_submit('filter','filter');
   echo form_close();
    ?>


</div>

<div class="col-lg-12">
    <h2>Helpers</h2>

    <?php

    echo form_open('/'); ?>
    <div class="inputBox ">
        <input type="text" name="personeel" placeholder="zoeken op naam" class="col-lg-11 offset-1">
        <span><i class="fa fa-user" aria-hidden="true"></i></span>
    </div>


    </form>

</div>

