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
    <?php echo pasStylesheetAan("style.css"); ?>
    <?php echo pasStylesheetAan("bootstrap.css"); ?>
    <?php echo pasStylesheetAan("bootstrap-grid.css"); ?>
    <?php echo pasStylesheetAan("bootstrap-reboot.css"); ?>


    <!--  Fontawesome css  -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <?php echo haalJavascriptOp("jquery-3.3.1.min.js"); ?>
    <?php echo haalJavascriptOp("bootstrap.js"); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script type="text/javascript">
        var site_url = '<?php echo site_url(); ?>';
        var base_url = '<?php echo base_url(); ?>';

    </script>

</head>

<body>

<div class="eigenHoofding">
    <?php echo $hoofding; ?>
</div>

<div class="eigenContent">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php echo $sidenav; ?>
    </div>
    <div class="col-12">
        <div id="page-content-wrapper">
            <div class="pagina">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
<?php echo $footer; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $('.pagina').toggleClass("toggled");
    });

</script>

</body>

</html>
