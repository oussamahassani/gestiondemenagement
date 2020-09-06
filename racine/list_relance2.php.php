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
     $confirm=$_GET['confirm'];
     if ($confirm != '0'  &&  $confirm!= '1')
     {$confirm = 0;
      $id_statut= 46 ;
      }
     $annule=$_GET['annule'];
     if (($annule != '0')  && ($annule!='1'))
     {$annule = 0;
     
     }
     $titre ='';
     if (($confirm == 0) &&  ($annule == 1)) 
     {$titre ='Annulés';}
     if (($confirm == 1) &&  ($annule == 0)) 
     {$titre ='Confirmés';}

     ?>
  <link rel='stylesheet' href='css/default.css?v=1.1' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
  <style type="text/css">
    .datepicker {
       width: 100% !important;
    }
    #statut_relance-error, #date_relance-error {
        margin-left: -97px;
    }
    .ui-datepicker table {
        z-index: 999 !important;
        opacity: 1 !important;
    }
  </style>
  <div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">

              <h4 class="mb-0">Liste Devis <?php echo $titre;  ?> </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
              <li class="breadcrumb-item active">Liste Devis </li>
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
                      <th>N° </th>
                      <th width="18%">Informations client</th>
                      <th width="18%">Informations départ</th>
                      <th width="18%">Informations arrivée</th>
                      <th width="18%">Informations demande</th>
                      <th width="18%">Informations devis</th>
                      
                      <th></th>
                    </tr>
              </thead>
              <tbody>
              <?php
             
              $req=mysql_query("select *,client.civilite as civiliteClient,client.nom as nomClient,client.prenom as prenomClient, concat(u.nom , ' ',u.prenom) as nom_utilisateur,statutDevis.valeur as libelleStatutDevis, ps.valeur as libellePrestation, ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr, statutDevis.id idMasterParametreValeur
              from demande
              INNER JOIN devis ON demande.id_dem=devis.id_demande 
              INNER JOIN client  on demande.id_client=client.id_client  
              LEFT JOIN utilisateur u on u.id_utilisateur=devis.id_ad_dev
              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
              LEFT JOIN masterParametreValeur  ps ON ps.id =id_prestation
              LEFT JOIN masterParametreValeur  statutDevis ON statutDevis.id =id_statut
              LEFT JOIN visite vis ON vis.id_dem_vis=demande.id_dem
              where id_client_B2B='$id_client_B2B' 
              and(  (devis.id_statut=46 AND $confirm=1) OR  (devis.id_statut IN (47,48) AND $annule=1)  OR 
              (devis.confirm=$confirm and devis.annule=$annule))  order by devis.id_devis DESC");

              while($result=mysql_fetch_array($req))
              {				
                // Check relance
                $query_relance = "
                  SELECT 
                    id 
                  FROM relanceDevis
                  WHERE idDevis = " . $result['id_devis']
                  . " ORDER BY id DESC LIMIT 1"
                ;
                $query_relance2 = mysql_query($query_relance);
                $result_relance = mysql_fetch_array($query_relance2);
                $id_relance     = $result_relance['id'];
              ?>
                  <tr>
                      <td><?php echo $result['id_devis']; ?>
                      
                      
              </td>
                      <td><?php echo $result['civiliteClient']." ".$result['nomClient']." ".$result['prenomClient'];
                                echo '<br>';
                                echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile'];
                                echo '<br>';
                                echo /*'Email : '.*/ $result['email'];
                          ?> 
                      </td>
                      <td><?php  echo 'Adresse : '.$result['adresse_dep'];
                                 echo ' - '.$result['code_postale_dep']." - ".$result['ville_dep'];
                                 echo '<br>';
                                 
                                 $date_dep=$result['date_dep'];$a=substr($date_dep,0,4);$m=substr($date_dep,5,2);$j=substr($date_dep,8,2);
                                 if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                 echo 'Date : '.$date_dep;
                          ?> 
                           <a href="" title ='<?php echo 'Logement : '.$result['libelleTypeLogement_dep'];?> '>
                           <i class="text-info ti-info"></i>...</a>
                      </td>
                      <td>
                        <?php  echo 'Adresse : '.$result['adresse_arr'];
                                 echo ' - '.$result['code_post_arr']." - ".$result['ville_arr'];
                                 echo '<br>';
                                 $date_arr=$result['date_arr'];$a=substr($date_arr,0,4);$m=substr($date_arr,5,2);$j=substr($date_arr,8,2);
                                 if ( $a == '00' ){$date_arr='';} else{$date_arr=$j."/".$m."/".$a;}
                                 echo 'Date : '.$date_arr;
                          ?> 
                          <a href="" title ='<?php echo 'Logement : '.$result['libelleTypeLogement_arr'];?> '>
                           <i class="text-info ti-info"></i>...</a>
                          </td>
                        
                      <td><?php $date_etab=$result['etablie_le'];	$a=substr($date_etab,0,4);	$m=substr($date_etab,5,2);$j=substr($date_etab,8,2);
            echo 'Demande N° : '.$result['id_dem']; 
            echo '<br>';
            echo 'Date : '.$j."/".$m."/".$a;

            echo '<br>';
            echo 'Volume : '.$result['volume'];
                                 echo '<br>';
                                 echo 'Type service : '.$result['typefacturation'];
                              
                          ?> 
                     
                      </td>
                      <td><?php $devis_etabli_le=$result['devis_etabli_le'];	$a=substr($devis_etabli_le,0,4);	$m=substr($devis_etabli_le,5,2);$j=substr($devis_etabli_le,8,2);
      
                          echo 'Prestation : '.$result['libellePrestation'];
            echo '<br>';
            echo 'Date : '.$j."/".$m."/".$a;
            echo '<br>';
             echo 'Prix : '.$result['Prix_ht'];
                                 echo '<br>';
                                 echo 'Assurance : '.$result['assurance'];
                              
                          ?> 
                     
                      </td>
                      <td>
                    <?php
                     ECHO $result['libelleStatutDevis'];
                     ?> 
                     <a href="" title ='<?php echo 'Modifié le : '.$result['dateModification'].' par '.$result['nom_utilisateur'] ;?> '>
                           <i class="text-info ti-info"></i>...</a>
                           <?php echo '<br>';
                    $id_devis=$result['id_devis'];
              $req2=mysql_query("select * from devis 
              INNER JOIN logService ON logService.id_devis=devis.id_devis 
              INNER JOIN utilisateur on utilisateur.id_utilisateur=logService.id_utilisateur where devis.id_devis='$id_devis'
               order by date_creation desc ");
      if($result2=mysql_fetch_array($req2))
      {				
             
               echo 'Envoyé par : '.$result2['nom']. ' '.$result2['prenom'] . ', Le ';
               echo  $result2['date_creation'];
      }
               ?>
<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                      <div class="dropdown-menu">
                      <a class="dropdown-item" id="modifDevis" href="modif_devis.php?dev=<?php echo $result['id_devis']; ?>&retour=2" >Modifier</a>
                      
                      <?php   if ($result['annule'] == 0)
                      { ?>
                      <a class="dropdown-item" id="ajoutdevis" href="confirm_demande.php?id_dem=<?php echo $result['id_dem']; ?>" >Ajouter devis</a>
                      <?php   if (($result['confirm'] == 0) && ($result['annule'] == 0))
                      { ?>
                <a class="dropdown-item" id="envoiParisEco" href="#" onClick="confirmer(<?php echo $result['id_devis']; ?>)" >Confirmer</a>
                <?php   } ?>
                 <!---<a class="dropdown-item" id="envoiParisEco" href="#" onClick="supprimer(<?php echo $result['id_devis']; ?>,<?php echo $confirm; ?>,<?php echo $annule; ?>)" >Supprimer</a>
                 !--->
                 <div class="dropdown-divider"></div>
                 <a   class="dropdown-item" id="pdf" target="new" href="../pages/TCPDF-master/examples/example_051.php?id=<?php echo $result['id_dem']; ?>&dev=<?php echo $result['id_devis']; ?>">PDF</a></li>

                 <?php   if ($result['confirm'] == 1)
                      { ?>
                <!--<a class="dropdown-item" id="visite" href="../pages/forms/visite.php?id_dem=" >Visite</a>
                !---><?php   if ($result['id_visite'] > 0)
                { ?>
                  <a class="dropdown-item" id="envoiParisEco" href="modif_visite.php?id_visite=<?php echo $result['id_visite']; ?>" >Visite</a>
                <?php } else 
                { ?>
                <a class="dropdown-item" id="envoiParisEco" href="ajout_visite.php?id_dem=<?php echo $result['id_dem']; ?>" >Visite</a>
                <?php } ?>

                <a class="dropdown-item" href="../pages/forms/upload_visite.php?id_dem=<?php echo $result['id_dem']; ?>">Upload visite</a>
                <a class="dropdown-item" target="new" href="../pages/TCPDF-master/examples/example_0011.php?id=<?php echo $result['id_dem']; ?>&dev=<?php echo $result['id_devis']; ?>">LV</a>
                <a class="dropdown-item" target="new" href="../pages/TCPDF-master/examples/ordredemission.php?id=<?php echo $result['id_dem']; ?>&dev=<?php echo $result['id_devis']; ?>">OM</a>
            <?php   } ?>
                <?php   if ($result['confirm'] == 0 && $result['idMasterParametreValeur'] == 45)
                        {
                          if ((!empty($id_relance)) && $id_relance > 0) { 
                        ?>
                        <a class="dropdown-item" href="enreg_relance2.php?relance=<?php echo $id_relance; ?>">Modifier la relance</a>
                <?php 
                        } else {
                        ?>
                        <a class="dropdown-item" id="relance_<?php echo $result['id_devis']; ?>" style='cursor: pointer;'>Cr&eacute;er une relance</a>
                        <?php
                        } 
                      } 
                ?>
             <div class="dropdown-divider"></div>
             <div id="demo-modal-target">
             <a class="dropdown-item" id="EnvoiMail"  TARGET="_BLANK" href="envoi_devis.php?id_devis=<?php echo $result['id_devis']; ?>" >
               </div>
               <div class="modal bd-example-modal-lg" id="sendMail<?php echo $result['id_devis']; ?>">
              
               <div id="summernote"><p>Hello Summernote</p></div>
                   </div>
               <!--- <div class="modal fade bd-example-modal-lg" id="sendMail<?php echo $result['id_devis']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
               </div>
            data-toggle="modal" data-target="#sendMail" !---> Envoi mail</a>
            <?php   }?>
            
              </div>
              <!-- Modal   -->
               
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
      

  
<?php 
require_once"inc/footer.php";
?>
</div>
<?php
} 
else
{

header('location: ../login.php');

}?>