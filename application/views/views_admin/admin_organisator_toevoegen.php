<?php
echo pasStylesheetAan('style.css');
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">

    <div class="col-12">
        <h2>Organisatoren beheren (verwijderen)</h2>
        <div class="list-group" id="list-tab" role="tablist">
            <?php
            foreach($admins as $admin){
                ?>
                <a class="list-group-item list-group-item-action" id="<?php echo $admin->naam; ?>" data-toggle="list" href="#<?php echo $admin->id; ?>" role="tab" aria-controls="<?php echo $admin->id;?>"><?php echo $admin->voornaam; ?></a>
                <?php
            }
            ?>
        </div>

        <br>

        <div class="col-12">

            <div class="tab-content" id="nav-tabContent">
                <?php
                foreach($admins as $admin){
                    ?>
                    <div class="tab-pane fade" id="<?php echo $admin->id;?>" role="tabpanel" aria-labelledby="<?php echo $admin->naam; ?>">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Voornaam:</th>
                                    <td><?php echo $admin->voornaam; ?></td>
                                </tr>
                                <tr>
                                    <th>Achternaam:</th>
                                    <td><?php echo $admin->naam; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $admin->email; ?></td>
                                </tr>
                                <tr>
                                    <th>GSM:</th>
                                    <td><?php echo $admin->gsm_nummer; ?></td>
                                </tr>
                                <tr>

                                    <?php
                                    if($admin->voornaam != "Admin") {
                                        ?>
                                        <th>Organisator verwijderen:</th>
                                        <td><?php echo anchor('organisator_toevoegen/verwijderOrganisator/' . $admin->id,'Verwijder', 'class="btn btn-danger"'); ?></td>
                                    <?php
                                    }
                                    ?>


                                </tr>
                            </tbody>
                        </table>


                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
            
    </div>


        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h2>Organisator toevoegen</h2>
            <?php echo form_open('organisator_toevoegen/voegToe');?>
            <div class="form-group">
                <label for="familienaam">Familienaam</label>
                <input type="text" class="form-control" placeholder="Familienaam" name="familienaam">
                <small class="form-text text-muted">Voer hier de familienaam in.</small>
            </div>
            <div class="form-group">
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
                <label for="wachtwoord">Wachtwoord</label>
                <input type="password" class="form-control" id="wachtwoord" placeholder="Wachtwoord" name="wachtwoord">
            </div>
            <div class="form-group">
                <label for="number">GSM Nummer</label>
                <input type="number" min="0" class="form-control" id="gsm" aria-describedby="emailHelp" placeholder="GSM Nummer" name="gsm">
                <small id="emailHelp" class="form-text text-muted">Voer hier de GSM nummer in.</small>
            </div>

            <button type="submit" class="btn btn-primary">Voeg toe</button>
            </form>
        </div>
    </div>


</div>
