<h3><?php echo $titel ?></h3>
<div class="table-responsive">
    <table class="table table-hover col-12 col-md-6">
        <thead>
            <tr>
                <th scope="col">Naam</th>
                <th scope="col">Begintijd</th>
                <th scope="col">Eindtijd</th>
                <th scope="col">Locatie</th>
                <th colspan="3"><a class="btn-primary btn" href="#" role="button">HEEEEl mooooie test Link</a></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($dagonderdelen as $dagonderdeel) { ?>
                <tr>
                    <td><?php echo ucfirst($dagonderdeel->naam)  ?></td>
                    <td><?php echo date_format($dagonderdeel->begintijd, "H:i") ?></td>
                    <td><?php echo date_format($dagonderdeel->eindtijd, "H:i") ?></td>
                    <td>
                        <?php if($dagonderdeel->locatieId != null){ ?>
                            <?php echo ucfirst($dagonderdeel->locatie) ?>
                        <?php } else{ ?>
                            De locatie verschilt per optie
                        <?php } ?>
                    </td>
                    <td class="text-center"><i class="fa fa-edit fa-2x"></i></td>
                    <td class="text-center"><i class="fa fa-trash fa-2x"></i></td>
                    <td class="text-center"><i class="fa fa-list-ul fa-2x" id="detailDagonderdeel" data-dagonderdeel="<?php echo $dagonderdeel->id ?>"></i></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    function haalOptiesOp (naam) {

    }

    $(document).ready(function() {
        $("#detailDagonderdeel").on('click', function () {

            console.log("test")
        });
    });
</script>
