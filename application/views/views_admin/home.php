<?php
echo pasStylesheetAan('style.css');
$feestDropDown = array();
if($feesten != null){
    foreach($feesten as $personeelsfeest){
        $feestDropDown[$personeelsfeest->id] = "Jaar " . date_format($personeelsfeest->datum, "Y");
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="col-12">
                <h2>Welkom <?php echo $admin->voornaam; ?></h2>
            </div>
            <div class="col-12 ">
                <div>
                    Welkom! Deze applicatie laat je toe om jaarlijks het personeelsfeest van Thomas More in goede banen te leiden.
                </div>
                <div>
                    Navigeer a.d.h.v. van het menu of door de snelkoppelingen op de homepagina.
                </div>
                <br>
                <p>
                    <strong>Personeelsfeest aanmaken:</strong> Hier maak je een nieuw personeelsfeest aan.
                </p>
                <p>
                    <strong>Organisatoren beheren:</strong> Hier kan je andere organisatoren toevoegen aan de applicatie.
                </p>
                <p>
                    <strong>Helpers &amp; personeelsleden:</strong> Hier kan je helpers en organisatoren toevoegen die een email zullen ontvangen.
                </p>
                <p>
                    <strong>Teksten aanpassen:</strong> Hier kan je de teksten aanpassen die de helpers en organisatoren te zien krijgen.
                </p>
                <p>
                    <strong>Dagonderdelen beheren:</strong> Hier kan je de verschillende dagonderdelen instellen en zo het personeelsfeest samenstellen.
                </p>
                <p>
                    <strong>Taken en shiften beheren:</strong> Hier kan je de shiften indelen zodat er een vlotte werken is tijdens het personeelsfeest.
                </p>
                <p>
                    <strong>Inschrijvingen beheren:</strong> Hier kan je zien wie er van de personeelsleden &amp; helpers ingeschreven is. Hier kan je ook altijd wijzigingen aanbrengen.
                </p>
                <p>
                    <strong>Foto's beheren:</strong> Hier kan je foto's toevoegen en verwijderen van personeelsfeesten.
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">

            <h2>Navigatie homepagina</h2>
            <div class="col-12">

                <p class="btn btn-primary">
                    <?php echo anchor('aanmelden/home', '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> &nbsp; Home'); ?>
                </p>
                <p class="btn btn-primary">

                    <?php echo anchor('personeelsfeest_aanmaken/index', '<span class="	glyphicon glyphicon-gift" aria-hidden="true"></span> &nbsp; Personeelsfeest aanmaken'); ?>
                </p>

                <p class="btn btn-primary">
                    <?php echo anchor('organisator_beheren/organisatorToevoegen', '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp; Organisatoren beheren'); ?>
                </p>
                <p class="btn btn-primary">

                    <?php echo anchor('helpers_personeelsleden_toevoegen/index', '<span class="	glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp; Helpers & Personeelsleden'); ?>
                </p>
                <p class="btn btn-primary">
                    <?php echo anchor('teksten_aanpassen/index', '<span class="glyphicon glyphicon-font" aria-hidden="true"></span> &nbsp; Teksten aanpassen'); ?>
                </p>

                <p class="btn btn-primary">
                    <?php echo anchor('Dagonderdelen_beheren/index', '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> &nbsp; Dagonderdelen beheren'); ?>
                </p>

                <p class="btn btn-primary">
                    <?php echo anchor('TakenEnShiften_beheren/index', '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> &nbsp; Taken en shiften beheren'); ?>
                </p>

                <p class="btn btn-primary">

                    <?php echo anchor('Overzicht_helpers_personeelsleden/index', '<span class="	glyphicon glyphicon-list-alt" aria-hidden="true"></span> &nbsp; Inschrijvingen beheren'); ?>
                </p>
                <p class="btn btn-primary">

                    <?php echo anchor('Foto_Beheren', '<span class="	glyphicon glyphicon-picture" aria-hidden="true"></span> &nbsp; Foto\'s beheren'); ?>
                </p>

                <p class="btn btn-primary">
                    <?php echo anchor('aanmelden/meldAf', '<span class="glyphicon glyphicon-off" aria-hidden="true"></span> &nbsp; Afmelden'); ?>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Actief personeelsfeest</h2>
            <div>
                Hier kunt u het personeelsfeest kiezen dat voor u, in uw sessie, actief is.
                Dit verandert niets aan wat de helpers en personeelsleden te zien krijgen.
                Zij krijgen nog steeds het laatste nieuwe personeelsfeest te zien met bijhorende dagonderdelen, opties, enz.
            </div>
            <br>
            <div>
                <?php
                echo form_open(base_url() . "index.php/Aanmelden/VeranderPersoneeelsfeest", array("method" => 'post'));
                echo form_dropdown("feestId", $feestDropDown, array($actiefPersoneelsfeest->id), array("class" => "form-control", "size" => 1, "onchange" => "this.form.submit()"));
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>

