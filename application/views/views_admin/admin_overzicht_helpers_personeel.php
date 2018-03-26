<script>
    $(document).ready(function () {
        $("#editpersoneel").click(function (){
     if(     $( "#editpersoneel" ).hasClass("glyphicon-pencil")){
         $( ".edit" ).removeClass( "hidden" );
         $( ".aanpasbug" ).removeClass( "hidden" );
         $( "#editpersoneel" ).removeClass( "glyphicon-pencil" );
         $( "#editpersoneel" ).addClass( "glyphicon-floppy-save" );

     }
     else{
         $( ".edit" ).addClass( "hidden" );
         $( ".aanpasbug" ).addClass( "hidden" );
         $( "#editpersoneel" ).removeClass( "glyphicon-floppy-save" );
         $( "#editpersoneel" ).addClass( "glyphicon-pencil" );

     }


        });

        $("#voegpersoneelslidtoe").click(function (){
            $( ".voegpersoneelslidtoe" ).removeClass( "hidden" );
        });
        $("#annuleer").click(function (){
            $( ".voegpersoneelslidtoe" ).addClass( "hidden" );
        });

    });
</script>

<div class="col-lg-12">
<div class="row omschrijving">

    <div class="col-lg-3 omschrijvingtitel">
        <h2>
            <?php
            echo $tekst->naam;
            ?>
        </h2>
    </div>
<div class="col-lg-8 offset-1 omschrijvingtekst ">
<p>
<?php
echo $tekst->omschrijving;
?>
</p>
</div>

</div>
<div class="col-lg-12">

 <h2>Personeel  <i id="editpersoneel" class="glyphicon glyphicon-pencil" aria-hidden="true"></i></h2>
    <?php
    echo form_open('/');?>
    <div class="inputBox ">
        <input type="text" name="personeel" placeholder="zoeken op naam"  class="col-lg-11 offset-1" >
        <span><i class="fa fa-user" aria-hidden="true"></i></span>
    </div>
    </form>
<table class="table col-lg-11 offset-1">

<tr>
    <td class="aanpasbug hidden"></td>
    <td>Naam</td>
    <?php
    foreach ($dagonderdelen as $dagonderdeel){

        $begintijd = explode(" ", $dagonderdeel->begintijd);
        $eindtijd = explode(" ", $dagonderdeel->eindtijd);

        $begintijdpertwee = explode(":",$begintijd[1]);
        $eindtijdpertwee = explode(":",$eindtijd[1]);
            if ($dagonderdeel->naam=="fuif"){

                echo "<td>" . $dagonderdeel->naam ."</td>";
            }

        elseif ($dagonderdeel->naam=="vervoer"){

            echo "<td>" . $dagonderdeel->naam ."</td>";
        }

            else{
                echo "<td>" . $begintijdpertwee[0]  .":" . $begintijdpertwee[1] . "-" . $eindtijdpertwee[0] . ":" . $eindtijdpertwee[1] ."</td>";
            }
    }
    ?>
</tr>

    <?php
    foreach ($personeelsleden as $personeelslid){

    echo "<tr><td class='edit hidden' ><i id='editpersoneelslid' class='glyphicon glyphicon-pencil' aria-hidden='true'></i>";

    echo anchor('Overzicht_helpers_personeelsleden/verwijderPersoneelslid/' . $personeelslid->id,' ', 'class="glyphicon glyphicon-trash verwijderpersoneelslid"'). "</td>";

    echo " <td> ".$personeelslid->voornaam . " " . $personeelslid->naam . "</td>";

    foreach ($dagonderdelen as $dagonderdeel){

       foreach ($dagonderdeel->opties as $optie){

    foreach ($optie->inschrijvingen as $inschrijving){
        if ($inschrijving->persoonid == $personeelslid->id){
            echo "<td>" . $optie->optie ."</td>";

        }
        else{
            echo "<td>/</td>";
        }
           }
       }
    }
echo "</tr>";
    }

    ?>

</table>

  <h2>  <i id="voegpersoneelslidtoe" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i></h2>


        <div class="voegpersoneelslidtoe hidden col-sm-12 col-md-12 col-lg-6 offset-1 ">

            <?php echo form_open('overzicht_helpers_personeelsleden/voegPersoneelslidToe');?>

            <div class="form-group">
                <label for="familienaam">Familienaam</label>
                <input type="text" class="form-control" placeholder="Familienaam" name="familienaam">
                <small class="form-text text-muted">Voer hier de familienaam in.</small>
            </div>
            <div class="form-group  ">
                <label for="voornaam">Voornaam</label>
                <input type="text" class="form-control" placeholder="Voornaam" name="voornaam">
                <small class="form-text text-muted">Voer hier de voornaam in.</small>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email">
                <small id="emailHelp" class="form-text text-muted">Voer hier de email in.</small>
            </div>


            <div class="form-group">
                <label for="number">GSM Nummer</label>
                <input type="number" min="0" class="form-control" id="gsm" aria-describedby="emailHelp" placeholder="GSM Nummer" name="gsm">
                <small id="emailHelp" class="form-text text-muted">Voer hier de GSM nummer in.</small>
            </div>






            <button type="submit" class="col-lg-2 btn btn-primary ">Voeg toe</button>
            </form>

            <button id="annuleer" class="col-lg-2  btn btn-danger ">Annuleer</button>

    </div>
<div class="col-lg-12">
    <h2>Helpers</h2>

    <?php

    echo form_open('/');?>
    <div class="inputBox ">
        <input type="text" name="personeel" placeholder="zoeken op naam"  class="col-lg-11 offset-1" >
        <span><i class="fa fa-user" aria-hidden="true"></i></span>
    </div>


    </form>
</div>
</div>
</div>