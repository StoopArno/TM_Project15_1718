<?php
/**
 * @file views_admin/admin_navbar.php
 *
 * Dit is de balk vanboven aan de view. Hier krijg je een titel van de pagina.
 */
?>
  
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        </div>
    <a class="navbar-brand pull-left" href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>


    <a class="text-white"> <?php echo $titel ?> </a>
    




<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content"> <span class="close">&times;</span>
        <p>Some text in the Modal..</p>
    </div>
</div>
    
    
<style>
    .butt {
        color: black;
        background-color: white;
        height: 30px;
        width: 30px;
        cursor: pointer;
        position: absolute;
        right: 30px;
    }
    
    .butt:hover {
        background-color: #2B2B2B;
        color: white;
    }
</style>

</nav>
