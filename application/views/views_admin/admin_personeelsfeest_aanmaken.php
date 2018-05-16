<<<<<<< HEAD
<?php 
/**
 * @file views_admin/admin_personeelsfeest_aanmaken.php
 * Hier kan de administrator een nieuw personeelsfeest aanmaken
=======
<?php
/**
 * @file views_admin/hadmin_personeelsfeest_aanmaken.php
 *
 * View die de optie geeft om een personeelsfeest aan te maken aan de hand van een nederlandse datepicker.
>>>>>>> 90e8f67fdfe1e9f7ae7a66c3723817734353784a
 */
?>
<link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.nl.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="../../../assets/css/style.css">
<script>
    $(document).ready(function() {
        var id;
        $('.verwijderPf').click(function() {
             id = $(this).attr('id');

            $('#Dialoog').modal('show');
        });

        $('.verwijderKnop').click(function() {
            $('#Dialoog').modal('toggle');
             verwijderKnop(id);
        });

        $('.annuleerKnop').click(function() {
            $('#Dialoog').modal('toggle');
        });
    });

    function verwijderKnop(id) {
        $.ajax({type: "GET",
            url: site_url + "/personeelsfeest_aanmaken/verwijder",
            data: {id: id},
            success: function (result) {
                $(".table").html(result);
            },
            error: function (xhr, status, error) {
                alert ("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }



</script>


<div class="container">
    <div class="col-sm-12 col-md-6">
        <h2>Personeelsfeest aanmaken</h2>

        <div>
            <p>
                Maak hier een nieuw personeelsfeest aan.
            </p>
        </div>
    </div>
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

        <table class="table">
            <thead>
            <tr>
                <th colspan="2">Personeelsfeesten</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($personeelsfeesten as $pf) {
                echo "<tr>";
                echo "<td>";
                echo zetOmNaarDDMMYYYY($pf->datum);
                echo "</td>";
                echo "<td>";
                ?>
                <p class="verwijderPf" id="<?php echo $pf->id; ?>">Verwijder</p>
                <?php
                echo "</td>";
                echo "<td>";
                echo anchor('personeelsfeest_aanmaken/wijzigPF/' . $pf->id, 'Wijzig');
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="Dialoog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4>Ben je zeker dat je dit personeelsfeest wilt verwijderen?</h4>
            <div>
                <button class="verwijderKnop btn btn-danger left">Verwijder</button>
                <button class="annuleerKnop btn btn-primary right">Annuleer</button>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

