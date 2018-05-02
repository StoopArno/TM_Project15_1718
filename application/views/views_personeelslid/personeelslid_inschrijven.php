<div class="row">
    <?php foreach($dagonderdelen as $dagonderdeel){ ?>
        <div class="card inschrijfitem col-12 col-lg-6">
            <?php
            $optieDropdown = array();
            foreach($dagonderdeel->opties as $optie){
                $optieDropdown[$optie->id] = ucfirst($optie->optie);
            }
            ?>
            <h5 class="card-header row">
                <span class="col-12 col-md-6"><?php echo ucfirst($dagonderdeel->naam) ?></span>
                <span class="col-12 col-md-6"><?php echo date_format($dagonderdeel->begintijd, "H:i") ?> <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> <?php echo date_format($dagonderdeel->eindtijd, "H:i")?></span>
            </h5>
            <div class="card-body row">
                <div class="card-text col-12 col-sm-6">
                    <?php echo form_dropdown("optieId", $optieDropdown, array($optie->id), array("class" => "form-control", "size" => 1)) ?>
                </div>
                <div class="col-12 col-sm-6" >
                    <?php echo form_textarea() ?>
                </div>
            </div>
        </div>
        <br><br>
    <?php } ?>
</div>
