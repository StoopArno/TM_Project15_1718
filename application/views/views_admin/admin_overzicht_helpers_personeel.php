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

    <h2>Personeel</h2>
    <?php
    echo form_open('/');?>
    <div class="inputBox ">
        <input type="text" name="personeel" placeholder="zoeken op naam"  class="col-lg-11 offset-1" >
        <span><i class="fa fa-user" aria-hidden="true"></i></span>
    </div>
    </form>
<table class="table col-lg-11 offset-1">

<tr>
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

    echo "<tr><td> ".$personeelslid->voornaam . " " . $personeelslid->naam . "</td>";

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