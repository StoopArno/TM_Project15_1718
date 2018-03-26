<?php
echo pasStylesheetAan('style.css');
?>

<div class="container">

    <div class="col-12">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="row">
                <h2>Organisatoren info & verwijderen</h2>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <?php
                        foreach($admins as $admin){
                            if($admin->voornaam == "Admin") {
                                ?>
                                 <a class="list-group-item list-group-item-action active" id="<?php echo $admin->naam; ?>" data-toggle="list" href="#<?php echo $admin->id; ?>" role="tab" aria-controls="<?php echo $admin->id;?>"><?php echo $admin->voornaam; ?></a>
                                <?php
                                } else {
                                ?>
                                <a class="list-group-item list-group-item-action" id="<?php echo $admin->naam; ?>" data-toggle="list" href="#<?php echo $admin->id; ?>" role="tab" aria-controls="<?php echo $admin->id;?>"><?php echo $admin->voornaam; ?></a>
                                <?php
                            }

                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8">

                    <div class="tab-content" id="nav-tabContent">
                        <?php
                        foreach($admins as $admin){
                            ?>
                            <div class="tab-pane fade" id="<?php echo $admin->id;?>" role="tabpanel" aria-labelledby="<?php echo $admin->naam; ?>">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th>Voornaam:</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        if($admin->voornaam == "") {
                                            ?>
                                            <td>/</td>
                                            <?php
                                        } else {
                                            ?>
                                            <td><?php echo $admin->voornaam; ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <th>Achternaam:</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        if($admin->naam == "") {
                                            ?>
                                            <td>/</td>
                                            <?php
                                        } else {
                                            ?>
                                            <td><?php echo $admin->naam; ?></td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        if($admin->email == "") {
                                            ?>
                                            <td>/</td>
                                            <?php
                                        } else {
                                            ?>
                                            <td><?php echo $admin->email; ?></td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <th>GSM:</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        if($admin->gsm_nummer == "") {
                                            ?>
                                            <td>/</td>
                                            <?php
                                        } else {
                                            ?>
                                            <td><?php echo $admin->gsm_nummer; ?></td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        if($admin->voornaam != "Admin") {
                                            ?>
                                            <th>Organisator verwijderen:</th>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        if($admin->voornaam != "Admin") {
                                            ?>
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
            <div class="row">
                <div class="col-12">
                    <h2>Organisator toevoegen</h2>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <?php echo form_open('organisator_toevoegen/voegToe');?>
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
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email" required>
                        <small id="emailHelp" class="form-text text-muted">Voer hier de email in.</small>
                    </div>

                    <div class="form-group">
                        <label for="wachtwoord">Wachtwoord</label>
                        <input type="password" class="form-control" id="wachtwoord" placeholder="Wachtwoord" name="wachtwoord" required>
                    </div>
                    <div class="form-group">
                        <label for="number">GSM Nummer</label>
                        <input type="number" min="0" class="form-control" id="gsm" aria-describedby="emailHelp" placeholder="GSM Nummer" name="gsm">
                        <small id="emailHelp" class="form-text text-muted">Voer hier de GSM nummer in.</small>
                    </div>
                    <div class="col-12">
                        <p class="centerKnop"><button type="submit" class="btn btn-primary knop">Voeg toe</button></p>
                    </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
























</div>
