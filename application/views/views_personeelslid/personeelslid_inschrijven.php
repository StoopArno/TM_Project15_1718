<div class="row">
    <?php echo form_open('inschrijven_optie/inschrijven') ?>
    <?php foreach($dagonderdelen as $dagonderdeel){ ?>
        <div class="col-sm-12 col-lg-6">
            <div class="row">
                <h3 class="col-12 col-md-6"><?php echo ucfirst($dagonderdeel->naam) ?></h3>
                <h3 class="col-12 col-md-6"><?php echo date_format($dagonderdeel->begintijd, "H:i") ?> <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> <?php echo date_format($dagonderdeel->eindtijd, "H:i")?></h3>
            </div>
            <ul class="list-group">
                <?php foreach($dagonderdeel->opties as $optie){ ?>
                    <li class="list-group-item">
                        <?php echo form_input(array('type' => 'radio', 'name' => "radio" . $dagonderdeel->naam, 'id' => 'radio' . $optie->id));
                        echo form_label(ucfirst($optie->optie), 'radio' . $optie->id) ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php echo form_close(); ?>
</div>