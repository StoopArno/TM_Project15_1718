<div class="row">
    <?php foreach($fotos as $foto){ ?>
        <div class="col-3 offset-1 foto-item text-center">
            <?php echo toonSavedAfbeelding($foto->fotonaam, array('height' => '200px', 'class' => 'image-fluid')) ?>
            <a href="Foto_beheren/fotoVerwijderen/<?php echo $foto->id ?>" class="deleteImg" ><i class="fa fa-3x fa-times-circle "></i></a>
        </div>
    <?php } ?>
</div>
<h3>Afbeelding toevoegen:</h3>
<div class="row col-6">
    <?php
        echo form_open_multipart('foto_beheren/fotoToevoegen');
        echo form_hidden('personeelsfeestId', $personeelsfeestId);
        echo form_input(array('type' => 'file', 'name' => 'userImage', 'id'=>'filePath', 'class' => 'col-s12'));
        echo form_input(array('type' => 'submit', 'value' => 'Bestand uploaden', 'class' => 'btn btn-secondary col-12 fotoBtn'));
    ?>
</div>
<script>

</script>


