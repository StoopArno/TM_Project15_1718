<?php
echo pasStylesheetAan('style.css');
$feestDropDown = array();
foreach($feesten as $personeelsfeest){
    $feestDropDown[$personeelsfeest->id] = "Jaar " . date_format($personeelsfeest->datum, "Y");
}
?>

<div class="container">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="col-12">
            <h2>Welkom <?php echo $admin->voornaam; ?></h2>
        </div>
        <div class="col-12 ">
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium debitis eaque facilis in iusto
                laudantium magni mollitia, nam officia pariatur quisquam reiciendis ut vero? Aliquid facilis magni
                minima porro sapiente.
            </div>
            <div>Autem dicta hic illo perferendis rem sed vero? Dolorum ea itaque laborum quod voluptas! Ducimus, fuga
                impedit ipsa ipsum iusto libero nihil non nostrum, nulla possimus vel veniam voluptates voluptatum!
            </div>
            <div>Architecto delectus ducimus, exercitationem, impedit iure nam neque numquam officia quasi quia ratione
                sint vero. Aliquam aut blanditiis est explicabo ipsum nemo nihil nobis repellat soluta tempore?
                Laudantium, quasi, tenetur.
            </div>
            <div>Ea eos est eum expedita explicabo facilis id impedit iure mollitia nisi possimus provident quae quaerat
                quis quisquam, recusandae reprehenderit saepe tenetur ut, voluptates! Ad autem eveniet odit provident
                voluptas.
            </div>
            <div>Accusamus amet asperiores assumenda atque autem, beatae culpa dolor, explicabo id ipsa itaque labore
                maiores obcaecati officia possimus praesentium repudiandae vero! Cumque error ex harum iste modi
                molestias mollitia similique?
            </div>
            <div>Et excepturi iure laboriosam magnam provident vero. A alias assumenda at debitis eligendi ipsum
                molestias, officiis quis quisquam vel. Cupiditate eaque eius expedita ipsum, magnam maxime perferendis
                possimus quasi tempore.
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="col-12">
            <h2>Actief personeelsfeest</h2>
        </div>
        <div class="col-12">
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
        <div class="col-12 ">

        </div>
    </div>
    <!--
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group has-feedback">
            <label class="control-label" for="date">Datum</label>
            <input id="datepicker" width="276" name="date" placeholder="dd-mm-yyyy"/>
        </div>


        <script>
            $(document).ready(function () {
                $('#datepicker').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'dd-mm-yyyy',
                    language: 'nl'
                });
            });
        </script>
        -->
    </div>
</div>
