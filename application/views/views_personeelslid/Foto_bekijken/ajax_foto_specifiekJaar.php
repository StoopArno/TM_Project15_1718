<div class="row">
    <?php foreach($fotos as $foto){ ?>
        <div class="col-3 offset-1 foto-item text-center">
            <?php echo toonSavedAfbeelding($foto->fotonaam, array('height' => '200px', 'class' => 'image-fluid')) ?>
        </div>
    <?php } ?>
</div>