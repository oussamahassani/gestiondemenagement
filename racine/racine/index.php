<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) 
{ 
?>
<?php require_once"inc/header.php"; ?>
<!--=================================
 header End-->

<!--=================================
 Main content -->
 
 
<!-- Left Sidebar End -->
<?php require_once"inc/menu.php"; ?>
<!--=================================
 Main content -->

 <!--=================================
wrapper -->


  
<div class="content-wrapper">
</div> 
    </div> 
    </div> 
    </div> 
     
 <?php require_once"inc/footer.php"; ?>
 
<?php
} 
else
{

header('location: index.php');

}?>