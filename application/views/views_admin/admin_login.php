
<?php
/**
 * @file views_admin/admin_login.php
 *
 * Hier moet de organisator inloggen voor hij/zij met de applicatie kan werken.
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titel ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php

 echo pasStylesheetAan("bootstrap.css");
echo pasStylesheetAan("bootstrap-grid.css");
 echo pasStylesheetAan("bootstrap-reboot.css");
 echo haalJavascriptOp("jquery-3.3.1.min.js");
echo haalJavascriptOp("bootstrap.js");

echo pasStylesheetAan('helper.css');
echo pasStylesheetAan("mdb.min.css");
echo pasStylesheetAan('admin_login.css');?>
<div class="schermLogin">
    <div class="loginBox">
        <h3>Admin personeelsfeest</h3>
        <?php echo toonAfbeelding("logo_TM.png", array( "class" => "user"))?>

        <?php
        if(($this->session->flashdata('error')) != null)
        {
            echo '<p class="flash">' . $this->session->flashdata('error') . '</p>';
        }
        ?>


        <?php echo form_open('aanmelden/meldAan');?>
        <div class="inputBox">
            <input type="text" name="admin_login" placeholder="Login">
            <span><i class="fa fa-user" aria-hidden="true"></i></span>
        </div>
        <div class="inputBox">
            <input type="password" name="admin_pass" placeholder="Wachtwoord">
            <span><i class="fa fa-lock" aria-hidden="true"></i></span>
        </div>
        <input type="submit" name="" value="Login">
        </form>
    </div>
</div>






<div class="footerLogin">
    <!--Footer-->
    <footer class="page-footer font-small stylish-color-dark pt-4 mt-4">

        <!--Footer Links-->
        <div class="container text-center text-md-left">
            <hr>
            <!-- Footer links -->
            <div class="row text-center text-md-left mt-3 pb-3">

                <!--First column-->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold">Teamleden</h5>
                    <div>
                        Lindert Van de Poel
                    </div>
                    <div>
                        Arno Stoop
                    </div>
                    <div>
                        Sander Philipsen
                    </div>
                    <div>
                        Dean Clerckx
                    </div>
                    <div>
                        Yorben Onsia
                    </div>

                </div>
                <!--/.First column-->

                <hr class="w-100 clearfix d-md-none">

                <!--Second column-->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold">Team</h5>
                    <div>
                        Team 15
                    </div>
                    <div>
                        Whiskeypedia
                    </div>
                </div>
                <!--/.Second column-->

                <hr class="w-100 clearfix d-md-none">

                <!--Third column-->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold">Opdrachtgever</h5>
                    <div>
                        Natalie Smets
                    </div>
                </div>
                <!--/.Third column-->

                <hr class="w-100 clearfix d-md-none">

                <!--Fourth column-->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold">Functionaliteit</h5>
                    <div>Organisator aanmelden</div>
                </div>
                <!--/.Fourth column-->

            </div>
            <!-- Footer links -->

            <hr>

            <div class="row py-3 d-flex align-items-center">

                <!--Grid column-->
                <div class="col-md-8 col-lg-8">

                    <!--Copyright-->
                    <p class="text-center text-md-left grey-text">Eindverantwoordelijke: <strong>Lindert Van de Poel</strong></a></p>
                    <!--/.Copyright-->

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 col-lg-4 ml-lg-0">

                    <!--Social buttons-->
                    <div class="text-center text-md-right">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1" href="https://nl-nl.facebook.com/ThomasMoreBE/"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1" href="https://twitter.com/thomasmorebe"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1" href="https://www.linkedin.com/company/thomas-more/?originalSubdomain=nl"><i class="fa fa-linkedin"></i></a></li>
                            <li class="list-inline-item"><a class="btn-floating btn-sm rgba-white-slight mx-1" href="https://www.thomasmore.be/"><i class="fa fa-graduation-cap"></i></a></li>
                        </ul>
                    </div>
                    <!--/.Social buttons-->

                </div>
                <!--Grid column-->

            </div>

        </div>

    </footer>
    <!--/.Footer-->
</div>


</body>
</html>