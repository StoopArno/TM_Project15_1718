<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Team 15">

    <title>Project 15_1718</title>

    <!-- Bootstrap Core CSS -->

    <?php echo pasStylesheetAan("bootstrap.css"); ?>
    <?php echo pasStylesheetAan("bootstrap-grid.css"); ?>
    <?php echo pasStylesheetAan("bootstrap-reboot.css"); ?>
    <?php echo pasStylesheetAan("style.css"); ?>

<?php?>
    <script type="text/javascript">

    </script>

</head>

<body>

<!-- Navigatie -->


<!-- Pagina inhoud -->
<div class="col-lg-12 ">

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <?php echo $hoofding; ?>
    </header>


    <!-- inhoud meegegeven in controller-->

    <div class="row">
        <div class="col-lg-12 hero-feature">
            <div class="thumbnail" style="padding: 20px">
                <div class="caption">
                    <p>
                        <?php echo $inhoud; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <footer>
    <!-- Footer -->
        <?php echo $footer ?>
    </footer>
    
</div>


</body>

</html>
