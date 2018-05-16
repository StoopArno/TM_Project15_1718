<?php
/**
 * @file views_personeelslid/foutpaginas/fout_persoonishelper.php
 *
 * View die wordt getoond wanneer de hashcode van een helper wordt gebruikt wordt voor naar de index van personeelslid te gaan.
 */
?>

<h2>Er vond een fout plaats!</h2>
<p>Uw account heeft geen toegang tot dit deel van de functionaliteit.</p>
<a href="<?php echo base_url() ?>/inschrijven_helper/index/<?php echo $hashcode ?>" class="btn btn-primary"></a>