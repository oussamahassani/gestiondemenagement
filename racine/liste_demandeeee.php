<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {

require_once"inc/header.php";
require_once"inc/menu.php";
require_once '../connect.php';
include "inc/mod_utilisateur.php";

$date_en_cours = date("Ymd-His");
$query_source_parameter = "select * from source";
$query_status_parameter = "
   SELECT id, valeur 
   FROM `masterParametreValeur` mpv
   WHERE idMasterParametre = 11
";
$que_get_status_parameter     = mysql_query($query_status_parameter);
$que_get_source_parameter     = mysql_query($query_source_parameter);
?>
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
   
div:after {display:block; content:"\A0";}
</style>
<link rel='stylesheet' href='css/default.css?v=<?php echo $date_en_cours; ?>' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
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
 <div class="card card-statistics mb-30">
                                <div class="card-body">
                                <h5 class="card-title">Critères de recherche</h5>
                                <form name="moteur" action="" method="POST" class="form-validate form-horizontal" id="moteur">
                                  <div class="form-row">
                                            <div class="col col-md-1.5" >
                                          <input type="text" class="form-control" name="num_demande" id="num_demande" placeholder="N° Demande" >
                                            </div>
											<div class="col col-md-2" >
                                           <input type="text" class="form-control" name="client" id="client" placeholder="Client" >
                                            </div>
											<div class="col col-md-2" >
                                           <input type="text" class="form-control" name="Raison_social" id="Raison_social" placeholder="Raison social" >
                                            </div>
											<div class="col col-md-3" >
                                        <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" >
                                            </div>
												<div class="col col-sm-2" >
                                        <input type="text" class="form-control" name="tel_client" id="tel_client" placeholder="téléphone" >
                                            </div>
											 <div class="form-group col-md-1.5">
                                          <input name="volumemin"  id="volumemin" type="number" min="0" class="form-control" placeholder="Volume Min" >
                                       	 </div>
										 <div class="form-group col-md-1.5">
                                      <input name="volume" id="volume" type="number" min="0" class="form-control" placeholder="Volume Max" >
                                        </div>
										 <div class="form-group col-md-2">
                                               <!-- <label for="inputState">Type client</label>!-->
                                                <select   name="source" id="source"  class="form-control" placeholder="Source demande">
                                                <option value="-1" selected>S&eacute;l&eacute;ctionnez un source</option>
                                                  <option value="1" selected>Plateforme SUPERDEM</option>
                                                 <option value="2">MVF Global</option>
                                                 <option value="3">BO</option>
												 <option value="4">Ancien client</option>
												 <option value="5">Plateforme DevisProx</option>
												 <option value="6">FICHES-DEMENAGEMENT</option>
												 <option value="7">Trouver mon d&eacute;m&eacute;nageur</option>
                                            </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                               <!-- <label for="inputState">Type client</label>!-->
                                                <select  name="type_Client" id="type_Client" class="form-control" placeholder="Type client">
                                                <option value="-1" selected>Type client</option>
                                                 <option value="1">Particulier</option>
                                                 <option value="2">Soci&eacute;t&eacute;</option>
												 <option value="3">Association</option>
                                                </select>
                                            </div>
											<div class="col col-sm-2" >
                                        <input type="text" class="form-control" name="code_deppart" id="code_deppart" placeholder="CP départ" >
                                            </div>
											<div class="col col-sm-2" >
                                        <input type="text" class="form-control" name="code_arriver" id="code_arriver"placeholder="CP arrivé" >
                                            </div>
                                            <div class="col col-md-2" > 
                                                <input type="text" class="form-control datepicker" placeholder="Date creation" name="date_creation_demande" id="date_creation_demande" >
                                            </div>
                                        <div class="form-group col-sm-2">
                                      <input name="dateDepart" id="Date_depart" type="text" class="form-control datepicker" placeholder="Date départ" >
                                        </div>
                                        <div class="form-group col-sm-2">
                                        <input name="datedepart_AV" id="datedepart_AV" type="text" class="form-control datepicker" placeholder="Date départ avant" >
                                        </div>
										<div class="form-group col-sm-2">
                                      <input name="Date_departd" id="Date_departd"  type="text" class="form-control datepicker" placeholder="Date départ aprés" >
                                        </div>
                                       
                                        
                                        <div class="form-group col-md-3">
                                        <button type='button' class='btn btn-success btn-fl-left' id='rechercher_demande' style='margin-top: 10px; float: right;'><i class='fa fa-search fa-fw'></i>Rechercher</button>
                                        </div>
                                        </div>
                                       </Form>
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
                              <th width="20%">Informations client</th>
                              <th width="20%">Informations départ</th>
                              <th width="20%">Informations arrivée</th>
                              <th width="20%">Autre</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $id_client_B2B=$_SESSION['id_client_B2B'];
                           $req=mysql_query("
                              select *,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr from demande
                              INNER JOIN client  on demande.id_client=client.id_client  
                              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
                              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
                              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
                              LEFT JOIN visite vis ON vis.id_dem_vis=demande.id_dem
                              where demande.conf=0  and id_client_B2B='$id_client_B2B' order by demande.id_dem DESC
                           ");
                           while($result=mysql_fetch_array($req)) {
                              // Check relance
                              $query_relance = "
                                 SELECT 
                                    id 
                                 FROM RelanceDemande
                                 WHERE id_Demande = " . $result['id_dem']
                                 . " 
                                 ORDER BY id DESC LIMIT 1
                              ";
                              // echo $query_relance;
                              $query_relance2 = mysql_query($query_relance);
                              $result_relance = mysql_fetch_array($query_relance2);
                              $id_relance     = $result_relance['id'];			
                           ?>
                           <tr>
                              <td><?php echo $result['id_dem']; ?></td>
                              <td>
                                 <?php 
                                    echo $result['civilite']." ".$result['nom']." ".$result['prenom'];
                                    echo '<br>';
                                    echo 'Tel : '.$result['tel']." - Tel mobile : ".$result['telMobile'];
                                    echo '<br>';
                                    echo /*'Email : '.*/ $result['email'];
                                 ?> 
                              </td>
                              <td>
                                 <?php  
                                    echo 'Adresse : '.$result['adresse_dep'];
                                    echo ' - '.$result['code_postale_dep']." - ".$result['ville_dep'];
                                    echo '<br>';                                 
                                    $date_dep=$result['date_dep'];
                                    $a=substr($date_dep,0,4);
                                    $m=substr($date_dep,5,2);
                                    $j=substr($date_dep,8,2);
                                    if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                    echo 'Date : '.$date_dep;
                                 ?> 
                                 <a href="" title ='<?php echo 'Logement : '.$result['libelleTypeLogement_dep'];?> '>
                                 <i class="text-info ti-info"></i>...</a>
                              </td>
                              <td>
                                 <?php  
                                    echo 'Adresse : '.$result['adresse_arr'];
                                    echo ' - '.$result['code_post_arr']." - ".$result['ville_arr'];
                                    echo '<br>';
                                    $date_arr=$result['date_arr'];
                                    $a=substr($date_arr,0,4);
                                    $m=substr($date_arr,5,2);
                                    $j=substr($date_arr,8,2);
                                    if ( $a == '00' ){$date_arr='';} else{$date_arr=$j."/".$m."/".$a;}
                                    echo 'Date : '.$date_arr;
                                 ?> 
                                 <a href="" title ='<?php echo 'Logement : '.$result['libelleTypeLogement_arr'];?> '>
                                    <i class="text-info ti-info"></i>...
                                 </a>
                              </td>
                              <td>
                                 <?php 
                                    $date_etab=$result['etablie_le'];
                                    $a=substr($date_etab,0,4);
                                    $m=substr($date_etab,5,2);
                                    $j=substr($date_etab,8,2);
                                    echo 'Date : '.$j."/".$m."/".$a;
                                    echo '<br>';
                                    echo 'Volume : '.$result['volume'];
                                    echo '<br>';
                                    echo 'Type service : '.$result['typefacturation'];                              
                                 ?>                     
                              </td>
                              <td>
                                 <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                 <div class="dropdown-menu">
                                    <a class="dropdown-item" id="sendSuperdem" href="confirm_demande.php?id_dem=<?php echo $result['id_dem']; ?>">Confirmer</a>
                                    <a class="dropdown-item" id="envoiParisEco" href="modif_demande.php?id_dem=<?php echo $result['id_dem']; ?>" >Modifier</a>
                                    <a class="dropdown-item" id="envoiParisEco" href="#" onClick="supprimer(<?php echo $result['id_dem']; ?>)" >Supprimer</a>
                                    <?php if ($result['id_visite'] > 0) { ?>
                                    <a class="dropdown-item" id="envoiParisEco" href="modif_visite.php?id_visite=<?php echo $result['id_visite']; ?>" >Visite</a>
                                    <?php } else { ?>
                                    <a class="dropdown-item" id="envoiParisEco" href="ajout_visite.php?id_dem=<?php echo $result['id_dem']; ?>" >Visite</a>
                                    <?php 
                                    }
                                    if ((!empty($id_relance)) && $id_relance > 0) { 
                                    ?>
                                    <a class="dropdown-item" href="enreg_relanceDemande.php?relance=<?php echo $id_relance; ?>">Modifier la relance</a>
                                    <?php } else { ?>
                                    <a class="dropdown-item" id="relance_<?php echo $result['id_dem']; ?>" style='cursor: pointer;'>Cr&eacute;er une relance</a>
                                    <?php } ?>
                                 </div>              
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>          
                  </div>
               </div>   
            </div>
         </div> 
      </div> 
   </div> 
  
<?php 
require_once"inc/footer.php";
?>
</div>
<?php

$que_user_logged      = mysql_query($query_user_logged);
$result_user_logged     = mysql_fetch_array($que_user_logged);

// $que_get_status_parameter   = mysql_query($query_get_status_parameter);
$que_get_status_parameter   = mysql_query("
   SELECT id, valeur 
   FROM `masterParametreValeur` mpv
   WHERE idMasterParametre = 11
");
$query_get_all_users = "
   SELECT id_utilisateur, CONCAT(UPPER(nom), ' ', prenom) raisonSociale
   FROM utilisateur
";
$que_all_users              = mysql_query($query_get_all_users);
?>

<div class="modal fade" id="modalRelance" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="display:inline-table; width: 1000px; margin-left: -50%;">
            <div class="modal-header">
               <h5 class="modal-title">Ajout d'une relance</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body" style="text-align:center; background-color: #000;">
               <div class="table-responsive">
                  <form id='frmRelanceDevis' method='POST'>
                     <table class='table table-border table-striped'>
                        <thead>
                           <tr>
                              <th>Date</th>
                              <th>Heure</th>
                              <th>Responsable</th>
                              <th>Statut</th>
                              <th>Commentaire</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>
                                 <input type='text' name='date_relance' id='date_relance' class='form-control datepicker' autocomplete="off" data-rule-required="true" placeholder='Date de la relance' data-msg-required="Date de relance obligatoire" />
                              </td>
                              <td>
                                 <input type='text' name='heure_relance' id='heure_relance' class='form-control' autocomplete="off" value='' placeholder='Heure de la relance' />
                              </td>
                              <td>
                                <select name='responsable_relance' id='responsable_relance' class='form-control' autocomplete="off">
                                 <?php
                                    while ($result_users = mysql_fetch_array($que_all_users)) {
                                      $selected = ($result_users['id_utilisateur'] == $_SESSION['id']) ? "selected" : "";
                                      echo "<option value=" . $result_users['id_utilisateur'] . " $selected>". $result_users['raisonSociale'] . "</option>";
                                    }
                                 ?>
                                </select>
                              </td>
                              <td>
                                <!-- <select name='statut_relance' id='statut_relance' class='form-control' autocomplete="off"> -->
                                 <select name='statut_relance' id='statut_relance' class='form-control' autocomplete="off" data-rule-required="true" data-msg-required="Statut obligatoire">
                                 <option value=''>S&eacute;l&eacute;ctionnez un statut</option>
                                 <?php
                                 while ($result_status_parameter = mysql_fetch_array($que_get_status_parameter)) {
                                    echo "<option value=" . $result_status_parameter['id'] . ">". utf8_encode($result_status_parameter['valeur']) . "</option>";
                                 }
                                 ?>
                                </select>
                              </td>
                              <td>
                                 <textarea name='commentaire_relance' id='commentaire_relance' class='form-control' autocomplete="off" value='' placeholder='Commentaire sur la relance'></textarea>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <input type='hidden' id='valueIdDemande' name='valueIdDemande' value=''>
                  </form>                
               </div>
            </div>
          
         </div>
      </div>
   </div>
</div>


<script language="javascript">
(function() {
		jQuery.tableauRechercheRelance = function() {
			var data=$("#moteur").serialize();
			$.ajax({type : "POST",
				url : "ajax/ajaxRecherchelisteDemande1.php",
				 data : {
					num_demande 				: $('#num_demande').val(),
					client 						: $('#client').val(),
				    type_Client				    : $('#type_Client').val(),
					tel_client 					: $('#tel_client').val(),
					raison_social 				: $('#Raison_social').val(),
					Email                       : $('#Email').val(),
					Date_depart           		: $('#Date_depart').val(),
					Date_departd           		: $('#Date_departd').val(),
					Date_departA         		: $('#datedepart_AV').val(),
					source           		    : $('#source').val(),
					volume 	                 	: $('#volume').val(),
					volumemin 	                : $('#volumemin').val(),
					Date_creation_demande		: $('#date_creation_demande').val(),
					Cp_depart              		: $('#code_deppart').val(),
	                Cp_arrive              		: $('#code_arriver').val(),
				},
				dataType: "html",
				beforeSend : function() {
				//	 $("#resultatRecherche").html('<img src="images/page-load.gif" alt="" border="0" style="margin-top:0;margin-right:0">');
				},
				success : function(response) {
					$("#resultatRecherche").html(response);
				},
				error: function(error) {
					console.error(error);
				}
			});
		}
	})(jQuery);

   function confirme(identifiant)

{

var confirmation=confirm("Voulez vous vraiment supprimer ce client?");

if(confirmation)
{

document.location.href="inc/delete_client.php?id_client="+identifiant;

}

}

 
$.datepicker.regional['fr'] = {
	    closeText: '',
	    prevText: '',
	    nextText: '',
	    currentText: '',
	    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
	    monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
	    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
	    dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
	    dayNamesMin: ['D','L','M','M','J','V','S'],
	    weekHeader: 'Sem.',
	    format: "Y-m-d",
	    firstDay: 1,
	    isRTL: false,
	    showMonthAfterYear: false,
	    yearSuffix: ''
	};
$(function() {
		$(".datepicker").datepicker({
		minDate: $startDate,
			dateFormat: "yy-mm-dd"
		});
	});
$.datepicker.setDefaults($.datepicker.regional["fr"]);
$("#rechercher_demand").click(function(){
 var $this = $(this);
		$.tableauRechercheRelance()
     });

 $.tableauRechercheRelance();


function supprimer(identifiant) {
   var confirmation=confirm("Voulez vous vraiment supprimer cette demande?");

   if(confirmation) {
      document.location.href="inc/delete_demande.php?id_dem="+identifiant;
   }
}
</script>
<?php
} 
else {
   header('location: index.php');
}
?>