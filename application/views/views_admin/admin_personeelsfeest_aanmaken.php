<link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.nl.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="../../../assets/css/style.css">

<div class="container">
    <h2>Personeelsfeest aanmaken</h2>
    <br>
    <br>
    <div class="col-sm-12 col-md-6">
        <?php echo form_open('personeelsfeest_aanmaken/maakAan/'); ?>
        <div class="row">
            <div class="col-8">
                <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="nl-BE">
                    <input type="text" class="form-control" name="personeelsfeestDate">
                    <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span> </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary knop" value="Maak aan" class="col-2">
        </div>
        </form>
    </div>
    <div class="col-sm-12 col-md-6">
        <table id="personeelsfeestTable">
            <thead>
            <tr>
                <th colspan="2">Personeelsfeest</th>
                <th></th>
                <th></th>
                <th>Actie</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($personeelsfeesten as $pf) {
            echo "<tr>";
            echo "<td>";

            echo $pf->datum;
            echo "</td>";
            ?>
            <td colspan="2">
                <?php
                echo anchor('personeelsfeest_aanmaken/verwijder/' . $pf->id, 'Verwijder');
                echo "</td>";
                echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>


</div>