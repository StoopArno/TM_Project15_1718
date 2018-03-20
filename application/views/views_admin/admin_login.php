<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titel ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php
echo pasStylesheetAan('admin_login.css');
?>
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

</body>
</html>