<script>
    $('.js-pscroll').each(function(){
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function(){
            ps.update();
        })
    });
</script>
<script>
    $(document).ready(function() {
        $('.klikHelpers').click(function() {
            haalHelpersOp($(this).attr('id'));
            $('#helperDialoog').modal('show');
        });
    });

    function haalHelpersOp(shiftId) {
        $.ajax({type: "GET",
            url: site_url + "/inschrijven_helper/haalHelpersOp",
            data: {shiftId: shiftId},
            success: function (result) {
            $('#resultaat').html(result);
            },
            error: function (xhr, status, error) {
                alert ("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }
</script>

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">

                <div class="table100-head">
                    <table>
                        <thead>
                        <tr class="row100 head">
                            <th class="cell100 column1">Activiteit</th>
                            <th class="cell100 column2">Sectie</th>
                            <th class="cell100 column3">Taak</th>
                            <th class="cell100 column4">Shift</th>
                            <th class="cell100 column5">Inschrijven</th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                        <?php
                           foreach($dagonderdelen as $dag) {
                                if($dag->opties != null) {
                                    foreach($dag->opties as $dagOptie) {
                                        if($dagOptie->helper_nodig == "ja") {
                                            if($dagOptie->taken != null) {
                                                foreach($dagOptie->taken as $taak) {
                                                    if($taak->shiften != null) {
                                                        if($taak->shiften != null) {
                                                            foreach($taak->shiften as $taakShift) {
                                                                ?>
                                                         <tr class="row100 body">
                                                                <td class="cell100 column1"><?php echo $dag->naam; ?></td>
                                                                <td class="cell100 column2"><?php echo $dagOptie->optie; ?></td>
                                                                <td class="cell100 column3">
                                                                    <span data-tooltip="<?php echo $taak->omschrijving; ?>">?</span>
                                                                    <?php echo $taak->naam; ?>
                                                                </td>
                                                                <td class="cell100 column4"><?php echo $taakShift->omschrijving; ?> - <?php echo date_format($taakShift->beginuur, "H:i"); ?>-<?php echo date_format($taakShift->einduur, "H:i"); ?></td>

                                                             <td class="cell100 column5">
                                                                 <?php
                                                                 $checker = false;
                                                                 foreach($ingeschreven as $ig) {
                                                                     if($ig->shiftid == $taakShift->id) {
                                                                         $checker = true;
                                                                     }
                                                                 }

                                                                     if($checker == true) {
                                                                         ?>
                                                                         <?php echo anchor('inschrijven_helper/schrijfUit/' . $taakShift->id . '/' . $helper->hashcode, 'Uitschrijven', 'class="btn btn-warning"') ?>

                                                                         <?php
                                                                     } else {
                                                                         if($taakShift->aantalHelpers == $taakShift->maxAantalHelpers) {
                                                                                ?>
                                                                                    <button class="btn btn-danger">Volzet</button>
                                                                                <?php
                                                                         } else {
                                                                             echo anchor('inschrijven_helper/schrijfIn/' . $taakShift->id . '/' . $helper->hashcode, 'Inschrijven', 'class="btn btn-success"');
                                                                         }
                                                                     }
                                                                 ?>
                                                                    &nbsp;
                                                                 <a id="<?php echo $taakShift->id; ?>" class="klikHelpers"><?php echo $taakShift->aantalHelpers; ?>/<?php echo $taakShift->maxAantalHelpers; ?></a>
                                                             </td>
                                                          </tr>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                           }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="helperDialoog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="resultaat">

            </div>
        </div>
    </div>
</div>