<!--
<div class="container">
    <div>
        <h2 class="inschrijfHeader">Schrijf je hier in om te komen helpen</h2>

    </div>
    <table class="tableInschrijvingen">
<tbody>
-->
<?php
/*
foreach($dagonderdelen as $dag) {
    ?>
    <tr>
        <th class="mainTh"><?php echo $dag->naam; ?></th>
        <?php
        if($dag->opties != null) {
            ?>
            <td>
                <table class="">
                    <?php
                    foreach($dag->opties as $dagOptie) {
                        if($dagOptie->helper_nodig == "ja") {
                            ?>
                            <tr>
                                <th class="optieTh"><?php echo $dagOptie->optie; ?></th>
                                <?php
                                if($dagOptie->taken != null) {
                                    ?>
                                    <td>
                                        <table class="">
                                            <?php
                                            foreach($dagOptie->taken as $taak) {
                                                ?>
                                                <tr>
                                                    <th class="taakTh"><?php echo $taak->naam; ?></th>
                                                    <?php
                                                    if($taak->shiften != null) {
                                                        ?>
                                                        <td>
                                                            <table class="">
                                                                <?php
                                                                foreach($taak->shiften as $taakShift) {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="tdShift"><?php echo $taakShift->omschrijving; ?></td>
                                                                        <td><?php echo date_format($taakShift->beginuur, "H:i"); ?>-<?php echo date_format($taakShift->einduur, "H:i"); ?></td>
                                                                        <?php
                                                                        $checker = false;
                                                                        foreach($ingeschreven as $ig) {
                                                                            if($ig->shiftid == $taakShift->id) {
                                                                                $checker = true;
                                                                            }
                                                                        }
                                                                        if($checker == true) {
                                                                            ?>
                                                                            <td><?php echo anchor('inschrijven_helper/schrijfUit/' . $taakShift->id . '/' . $helper->hashcode, 'Uitschrijven', 'class="btn btn-warning"') ?></td>

                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <td><?php echo anchor('inschrijven_helper/schrijfIn/' . $taakShift->id . '/' . $helper->hashcode, 'Inschrijven', 'class="btn btn-success"') ?></td>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <td><?php echo $taakShift->aantalHelpers; ?>/<?php echo $taakShift->maxAantalHelpers; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </table>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </table>
                                    </td>
                                    <?php
                                }

                                ?>
                            </tr>

                            <?php

                        }

                    }
                    ?>
                </table>
            </td>
            <?php
        }
        ?>
    </tr>
    <?php
}
*/
?>
<!--
</tbody>

    </table>
</div>
-->



<!----------------------------------------------------------------------------------------------------------------------------------------------->
<?php
echo haalJavascriptOp("jquery-3.3.1.min.js");
echo haalJavascriptOp("popper.js");
echo haalJavascriptOp("select2.min.js");
echo haalJavascriptOp("perfect-scrollbar.min.js");
echo haalJavascriptOp("main.js");
echo pasStylesheetAan("animate.css");
echo pasStylesheetAan("select2.min.css");
echo pasStylesheetAan("perfect-scrollbar.css");
echo pasStylesheetAan("main.css");
echo pasStylesheetAan("font-awesome.min.css");
?>
<script>
    $('.js-pscroll').each(function(){
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function(){
            ps.update();
        })
    });
</script>

<!-- Eigen -->

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
                                                                <td class="cell100 column3"><?php echo $taak->naam; ?></td>
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
                                                                     ?>
                                                                     <?php echo anchor('inschrijven_helper/schrijfIn/' . $taakShift->id . '/' . $helper->hashcode, 'Inschrijven', 'class="btn btn-success"') ?>
                                                                     <?php
                                                                 }
                                                                 ?>
                                                                    &nbsp;
                                                                 <?php echo $taakShift->aantalHelpers; ?>/<?php echo $taakShift->maxAantalHelpers; ?>
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
