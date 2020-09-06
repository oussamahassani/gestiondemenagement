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
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0">Liste Demandes </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Liste Demandes </li>
            </ol>
          </div>
        </div>
    </div>
    <?php require_once '../connect.php';?>
    
<div id="resultatRecherche">
    <div class="row">   
    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive" id="resultatRecherche">
             <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
              <tr>
                      <th>N° </th>
                      <th width="20%">Informations client</th>
                      <th width="20%">Informations demande</th>
                      <th width="20%">Déménagement</th>
                      <th width="30%">Informations devis</th>
                      
                      <th>Visite</th>
                    </tr>
              </thead>
              <tbody>
              <?php
              
              
              $id_client_B2B=$_SESSION['id_client_B2B'];
              $req=mysql_query("select *,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr 
              ,com.nom AS nomCom, com.prenom as prenomCom, com.civilite as civiliteCom,
              client.nom AS nomclient, client.prenom as prenomclient, client.civilite as civiliteclient,
              SV.valeur AS statutVisite, SV.code AS codeCouleurVisite
              from demande
              INNER JOIN client  on demande.id_client=client.id_client  
              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
              LEFT JOIN visite vis ON vis.id_dem_vis=demande.id_dem
              LEFT JOIN utilisateur com ON com.id_utilisateur=id_com
              LEFT JOIN masterParametreValeur SV ON SV.id=id_statut_vis
              where id_client_B2B='$id_client_B2B' order by demande.id_dem DESC");
              while($result=mysql_fetch_array($req))
              {				
              ?>
                  <tr>
                      <td>
                      <a href="modif_demande.php?id_dem=<?php echo $result['id_dem']; ?>"><?php echo $result['id_dem']; ?> 
                      </a>
                      
            </td>
                      <td><?php echo $result['civiliteclient']." ".$result['nomclient']." ".$result['prenomclient'];
                                echo '<br>';
                                echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile'];
                                echo '<br>';
                                echo /*'Email : '.*/ $result['email'];
                          ?> 
                      </td>
                      <td><?php $date_etab=$result['etablie_le'];	$a=substr($date_etab,0,4);	$m=substr($date_etab,5,2);$j=substr($date_etab,8,2);
            echo 'Date : '.$j."/".$m."/".$a;
            echo '<br>';
            echo 'Volume : '.$result['volume'];
                                 echo '<br>';
                                 echo 'Type service : '.$result['typefacturation'];
                              
                          ?> 
                     
                      </td>
                      <td><?php  $date_dep=$result['date_dep'];$a=substr($date_dep,0,4);$m=substr($date_dep,5,2);$j=substr($date_dep,8,2);
                                 if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                 echo 'Date : '.$date_dep;
                                 echo '<br>';
                                 echo 'Départ : '.$result['code_postale_dep'];
                                 echo '<br>';
                                 echo 'Arrivée : '.$result['code_postale_dep'];
                                 echo '<br>';
                                 
                          ?> 
                         
                      </td>
                      <td>
                     <?php $id_demande =$result['id_dem'];
                      $reqdev=mysql_query("select *,statutDevis.valeur as libelleStatutDevis
                      FROM demande
                      INNER JOIN devis ON demande.id_dem=devis.id_demande 
                      LEFT JOIN masterParametreValeur  statutDevis ON statutDevis.id =id_statut
                      where id_client_B2B='$id_client_B2B' AND id_demande='$id_demande'  order by devis.id_devis DESC");
              while($resultdev=mysql_fetch_array($reqdev))
              {		 ?>
                 <a href="modif_devis.php?dev=<?php echo $resultdev['id_devis']; ?>"><?php echo $resultdev['id_devis']; ?> 
                 </a> - 
                 <?php 
                 echo $resultdev['libelleStatutDevis'];
                 
                 echo ' - TTC : ' ;
                 echo $resultdev['Prix_ttc']; 
               
                 $id_devis=  $resultdev['id_devis']; 
                 $req2=mysql_query("select  max(date_creation) as date_creation from devis 
              INNER JOIN logService ON logService.id_devis=devis.id_devis 
              INNER JOIN utilisateur on utilisateur.id_utilisateur=logService.id_utilisateur where devis.id_devis='$id_devis' order by date_creation desc ");
              $result2=mysql_fetch_array($req2) ;
              if ($result2['date_creation'] != '')
              {		 
               echo ' - Envoyé le ';
               echo  $result2['date_creation'];
              }
                 echo '<br>'; ?> 
                <?php }
              ?>


                      
                          </td>
                      
                      <td>
                       <?php
                        if ($result['id_visite'] > 0)
                        {
                         $date_vis=$result['date_vis'];	$a=substr($date_vis,0,4);	$m=substr($date_vis,5,2);$j=substr($date_vis,8,2);
                         echo 'Date : '.$j."/".$m."/".$a;
                         echo '<br>';
                         echo 'Heure : '.substr($result['heure_vis'],0,5);
                         echo '<br>';
                         echo 'Commercial : '.$result['nomCom']." ".$result['prenomCom'];
                         echo '<br>';
                         
                        }
                              
                          ?> 
                           <?php
                        if ($result['id_visite'] > 0)
                        {?> 
                      <span style="color:<?php echo $result['codeCouleurVisite']; ?>"><?php echo 'Visiste '.$result['statutVisite']; ?></span>
                       <?php    }?>  </td>
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
 <script language="javascript">

function supprimer(identifiant)

{

var confirmation=confirm("Voulez vous vraiment supprimer cette demande?");

if(confirmation)

{

document.location.href="inc/delete_demande.php?id_dem="+identifiant;

}

}
</script>
<?php
} 
else
{

header('location: index.php');

}?>