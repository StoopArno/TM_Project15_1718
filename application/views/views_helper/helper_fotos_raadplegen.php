<script>

</script>


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



