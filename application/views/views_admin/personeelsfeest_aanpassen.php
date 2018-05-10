<link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.nl.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="../../../assets/css/style.css">

<div class="container">
    <div class="col-sm-12 col-md-6">
        <h2>Personeelsfeest aanpassen</h2>

        <div>
            <p>
                Als je de datum van een personeelsfeest wilt wijzigen dan kun je dat hier doen.
            </p>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <?php echo form_open('personeelsfeest_aanmaken/wijzig/' . $personeelsfeest->id); ?>
        <div class="row">
            <div class="col-8">
                <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="nl-BE">
                    <input type="text" class="form-control" name="personeelsfeestDate" value="<?php echo zetOmNaarDDMMYYYY($personeelsfeest->datum); ?>">
                    <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span> </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary knop" value="Pas aan" class="col-2">
        </div>
        </form>

    </div>

</div>