<div class="container">
    <div class="col-sm-12 col-md-6">
        <h1>Personeelslid toevoegen</h1>
        <?php echo form_open('helpers_personeelsleden_toevoegen/personeelslidToevoegen');?>
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
            <label for="number">GSM Nummer</label>
            <input type="number" min="0" class="form-control" id="gsm" aria-describedby="emailHelp" placeholder="GSM Nummer" name="gsm">
            <small id="emailHelp" class="form-text text-muted">Voer hier de GSM nummer in.</small>
        </div>
        <div class="col-12">
            <p class="centerKnop"><button type="submit" class="btn btn-primary knop">Voeg toe</button></p>
        </div>

        </form>
    </div>
    <div class="col-sm-12 col-md-6">
        <h1>Helper toevoegen</h1>
        <?php echo form_open('helpers_personeelsleden_toevoegen/helperToevoegen');?>
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