<?php

foreach($admins as $admin){
    if($admin->voornaam == "Admin") {
        ?>
        <a class="list-group-item list-group-item-action active" id="<?php echo $admin->naam; ?>" data-toggle="list" href="#<?php echo $admin->id; ?>" role="tab" aria-controls="<?php echo $admin->id;?>"><?php echo $admin->voornaam; ?></a>
        <?php
    } else {
        ?>
        <a class="list-group-item list-group-item-action" id="<?php echo $admin->naam; ?>" data-toggle="list" href="#<?php echo $admin->id; ?>" role="tab" aria-controls="<?php echo $admin->id;?>"><?php echo $admin->voornaam; ?></a>
        <?php
    }

}
?>