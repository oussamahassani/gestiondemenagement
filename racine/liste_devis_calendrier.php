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

              <h4 class="mb-0">Calendrier Devis</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Calendrier Devis </li>
            </ol>
          </div>
        </div>
    </div>

    <form   name="contact">
          
          <div id="contenucalendrier" style="display:none;"><ul id="eventsList">
          <?php              

require_once '../connect.php';
          $req=mysql_query("SELECT devis_etabli_le,count(*) AS nbDevis FROM devis GROUP BY devis_etabli_le ");

while($result=mysql_fetch_array($req))
{	?>
       <li>
          {title:"Nombre des devis établis : <?php echo $result['nbDevis'];?>",start:"  <?php echo $result['devis_etabli_le'];?>"}
          </li>
<?php

}

          ?>
            <?php              

require_once '../connect.php';
          $req=mysql_query("SELECT devis_etabli_le, id_devis,id_demande, SD.code AS codeCouleurDevis  FROM `devis`
          LEFT JOIN masterParametreValeur SD ON SD.id=id_statut");

while($result=mysql_fetch_array($req))
{	?>
       <li>
          { title:"Devis N° <?php echo $result['id_devis'];?> - Demande N° <?php echo $result['id_demande'];?> ",start:" <?php echo $result['devis_etabli_le'];?>",target:"_blank",url:"modif_devis.php?dev=<?php echo $result['id_devis']; ?>",color:"<?php echo $result['codeCouleurDevis']; ?>"}
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

      <div class="row">
        <div class="col-12 mb-30">
           <div class="card card-statistics">
            <div class="card-body">
              <div class="row">
                <div class="col-xl-8">
                  <div class="chart-wrapper" style="width: 100%; margin: 0 auto; "> 
                  <canvas id="canvas1" width="800"></canvas>
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