<?php print_r($inschrijvingen) ?>
<div class="col-sm-12 col-md-6 col-lg-6">
    <h2>Persoon wijzigen</h2>
    <?php echo form_open('overzicht_helpers_personeelsleden/wijzigpersoon');?>
    <div class="form-group hidden">

        <input type="text" class="form-control" value="<?php echo $persoon->id ?>" name="id">

    </div>
    <div class="form-group">
        <label for="familienaam">Familienaam</label>
        <input type="text" class="form-control" value="<?php echo $persoon->naam ?>" name="familienaam">
        <small class="form-text text-muted">Voer hier de familienaam in.</small>
    </div>
    <div class="form-group">
        <label for="voornaam">Voornaam</label>
        <input type="text" class="form-control" value="<?php echo $persoon->voornaam ?>" name="voornaam">
        <small class="form-text text-muted">Voer hier de voornaam in.</small>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"value="<?php echo $persoon->email ?>" name="email">
        <small id="emailHelp" class="form-text text-muted">Voer hier de email in.</small>
    </div>

    <div class="form-group">
        <label for="number">GSM Nummer</label>
        <input type="number" min="0" class="form-control" id="gsm" aria-describedby="emailHelp" value="<?php echo $persoon->gsm_nummer ?>" name="gsm">
        <small id="emailHelp" class="form-text text-muted">Voer hier de GSM nummer in.</small>
    </div>

    <button type="submit" class="col-lg-6 btn btn-primary btn-organisator">Opslaan</button>

    </form>
    <?php echo  anchor('overzicht_helpers_personeelsleden/index' ,  '<button id="annuleerhelper" class="col-lg-2  btn btn-danger ">Annuleer</button>' )?>
</div>