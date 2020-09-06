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
<?php require_once '../connect.php';
     $id_client_B2B=$_SESSION['id_client_B2B'];
  
     ?>
  <div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">

              <h4 class="mb-0">Liste Visite</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Liste Visite </li>
            </ol>
          </div>
        </div>
    </div>

    <form   name="contact">
          
          <div id="contenucalendrier" style="display:none;"><ul id="eventsList">
          <?php              

require_once '../connect.php';
          $req=mysql_query("SELECT date_vis,count(*) AS nbVisite FROM visite GROUP BY date_vis ");

while($result=mysql_fetch_array($req))
{	?>
       <li>
          {title:"Visites à faire : <?php echo $result['nbVisite'];?>",start:"  <?php echo $result['date_vis'];?>"}
          </li>
<?php

}

          ?>
            <?php              

require_once '../connect.php';
          $req=mysql_query("SELECT date_vis, id_visite FROM `visite`");

while($result=mysql_fetch_array($req))
{	?>
       <li>
          {title:"Visite N° <?php echo $result['id_visite'];?>",start:"  <?php $date = new DateTime($result['date_vis']);
              $time = new DateTime($result['heure_vis']);
              $merge = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));
              echo $merge->format('Y-m-d H:i:s');//echo $result['date_vis'];?>"}
          </li>
<?php

}

          ?>
        
         
</ul></div>
      </form>

      <div class="calendar-main mb-30">
      <div class="row">
      <div class="col-lg-12">
        <div id="calendar-list"></div>
        
        </div>
      </div>
   </div>
   
    
    
    </div> 
    </div> 
    </div> 

 <!--=================================
 wrapper -->
      

  
 <?php require_once"inc/footer.php"; ?>
 
<?php
} 
else
{

header('location: index.php');

}?>