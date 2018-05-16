<?php
/**
 * @file views_helper/helper_fotos_raadplegen.php
 *
<<<<<<< HEAD
 * Hier kan de helper leuke herinneringen ophalen en foto's van afgelopen jaren bekijken.
 */
?>


<script>

</script>


=======
 * View die een overzicht weergeeft van de fotos van de voorbije jaren.
 */
?>
>>>>>>> 90e8f67fdfe1e9f7ae7a66c3723817734353784a
<article>
    <div class="btn-group">
        <?php
        foreach($personeelsfeesten as $personeelsfeest) {
            echo anchor('inschrijven_helper/haalFotosOp' . '/' . $helper->hashcode . '/' . $personeelsfeest->id, date_format($personeelsfeest->datum, "Y"), 'class="btn btn-primary"');
        }
        ?>
    </div>
</article>


    <div style="padding:120px 0; margin:25px auto 10px auto;">
        <div id="thumbnail-slider">
            <div class="inner">
                <ul>
                    <?php
                foreach($fotos as $foto) {
                    ?>
                    <li>
                        <?php echo toonSavedAfbeelding($foto->fotonaam, array('class' => 'thumb')) ?>
                    </li>
                    <?php
                }
                ?>
                </ul>

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



