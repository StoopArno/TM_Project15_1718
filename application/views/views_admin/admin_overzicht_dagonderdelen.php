<h3><?php echo $titel ?></h3>

<table class="table table-bordered col-6">
    <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Begintijd</th>
            <th scope="col">Eindtijd</th>
            <th scope="col">Locatie</th>
            <th scope="col">
                <span class="">Acties</span>
                <span class="offset-6 col-6"><i class="fa fa-plus-square fa-2x"></i></span>
            </th>
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
                <td class="text-center">
                    <span class="col-4"><i class="fa fa-edit fa-2x"></i></span>
                    <span class="col-4"><i class="fa fa-trash fa-2x"></i></span>
                    <span class="col-4"><i class="fa fa-list-ul fa-2x"></i></span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    function haalBestellingOp (naam) {

    }

    $(document).ready(function(){

    });
</script>
