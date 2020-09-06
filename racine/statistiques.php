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
              <h4 class="mb-0">Statistiques</h4>
             
          </div>
          <form   name="contact">
          
          <div id="contenucalendrier" style="display:none;"><ul id="eventsList">
          <?php              

require_once '../connect.php';
          $req=mysql_query("SELECT etablie_le, COUNT(*) AS NBDemande FROM `demande` WHERE id_source=5 GROUP BY etablie_le");

while($result=mysql_fetch_array($req))
{	?>
       <li>
          {title:"Fiche reçu : <?php echo $result['NBDemande'];?>",start:"  <?php echo $result['etablie_le'];?>"}
          </li>
<?php

}

          ?>
            <?php              

require_once '../connect.php';
          $req=mysql_query("SELECT date_creation, id_dem FROM `demande` WHERE id_source=5");

while($result=mysql_fetch_array($req))
{	?>
       <li>
          {title:"Réception et Envoi lead N° SUP <?php echo $result['id_dem'];?>",start:"  <?php echo $result['date_creation'];?>"}
          </li>
<?php

}

          ?>
          <?php              

require_once '../connect.php';
          $req=mysql_query("SELECT etablie_le, COUNT(*) AS NBDemande FROM `demande` WHERE id_source=5 GROUP BY etablie_le");

while($result=mysql_fetch_array($req))
{	?>
       <li>
          {title:"Fiche envoyé : <?php echo $result['NBDemande'];?>",start:"  <?php echo $result['etablie_le'];?>"}
          </li>
<?php

}

          ?>
         
</ul></div>
      </form>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
              <li class="breadcrumb-item active">Statistiques</li>
            </ol>
          </div>
        </div>
    </div>
    <!-- main body --> 
     <div class="calendar-main mb-30">
      <div class="row">
      <div class="col-lg-12">
        <div id="calendar-list"></div>
        
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