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
    
    
<div id="resultatRecherche">
    <div class="row">   
    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive" id="resultatRecherche">
             <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
              <tr>
                      <th>N° Demande </th>
                      <th width="18%">Client</th>
                      <th width="22%">Départ</th>
                      <!---<th width="18%">Arrivée</th>!--->
                      
                      <th width="22%">Autre</th>
                       <th width="18%">Visite</th>
                      
                      
                      <th></th>
                    </tr>
              </thead>
              <tbody>
              <?php
              
              
             
              $req=mysql_query("select *,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr ,
              com.nom AS nomCom, com.prenom as prenomCom, com.civilite as civiliteCom,
              client.nom AS nomclient, client.prenom as prenomclient, client.civilite as civiliteclient,
              SV.valeur AS statutVisite, SV.code AS codeCouleurVisite 
              FROM visite
              INNER JOIN demande ON id_dem_vis= demande.id_dem
              LEFT JOIN utilisateur com ON com.id_utilisateur=id_com
              LEFT JOIN masterParametreValeur SV ON SV.id=id_statut_vis
              INNER JOIN client  on demande.id_client=client.id_client  
              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
              where id_client_B2B='$id_client_B2B' 
              order by demande.id_dem DESC");
              while($result=mysql_fetch_array($req))
              {				
              ?>
                  <tr style="background-color:<?php echo $result['codeCouleurVisite']; ?>">
                      <td><?php echo $result['id_dem']; ?>
                      
                      
              </td>
                      <td><?php echo $result['civiliteclient']." ".$result['nomclient']." ".$result['prenomclient'];
                                echo '<br>';
                                echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile'];
                                echo '<br>';
                                echo /*'Email : '.*/ $result['email'];
                          ?> 
                      </td>
                      <td><?php  echo 'Adresse : '.$result['adresse_dep'];
                                 echo ' - '.$result['code_postale_dep']." - ".$result['ville_dep'];
                                 echo '<br>';
                                 
                                 
                                 echo 'Logement : '.$result['libelleTypeLogement_dep'];?> 
                      </td>
                      <!---<td>
                        arrivée
                          </td>!--->
                        
                      <td>
                      <?php     $date_dep=$result['date_dep'];$a=substr($date_dep,0,4);$m=substr($date_dep,5,2);$j=substr($date_dep,8,2);
                                 if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                 echo 'Date de déménagement  : '.$date_dep;
                                 echo $result['periode_dep'];
echo '<br>';
             echo 'Volume : '.$result['volume'];
                                 echo '<br>';
                                 echo 'Type service : '.$result['typefacturation'];
                              
                          ?> 
                     
                      </td>
                      <td><?php
                         $date_vis=$result['date_vis'];	$a=substr($date_vis,0,4);	$m=substr($date_vis,5,2);$j=substr($date_vis,8,2);
                         echo 'Date : '.$j."/".$m."/".$a;
                         echo '<br>';
                         echo 'Heure : '.substr($result['heure_vis'],0,5);
                         echo '<br>';
                         echo 'Commercial : '.$result['nomCom']." ".$result['prenomCom'];
                        
                              
                          ?> 
                     
                      </td>
                      <td style="text-align:center;">
                      <?php echo 'Visiste '.$result['statutVisite']; ?>
                      <br>
                      

                      
                      <a target="new" href="../pages/TCPDF-master/examples/visite.php?dem=<?php echo $result['id_dem']; ?>">
                      <i class="fa fa-file-pdf-o" style="font-size:25px;" ></i>
                      </a>
                      <a href="modif_visite.php?id_visite=<?php echo $result['id_visite']; ?>">
                      <i class="fa fa-pencil" style="font-size:25px;" ></i>
                      </a>

                      
                      </td>
                  </tr>
                  <?php 

              

}
?>
             
</tbody>
           </table>
          
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