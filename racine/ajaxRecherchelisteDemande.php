<?php
session_start (); 
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
require_once"inc/header.php";
require_once"inc/menu.php";
require_once '../db.php';
$query_status_parameter = "select * from source";

$que_get_status_parameter     = mysqli_query($con, $query_status_parameter);

?>
<style type="text/css">
div:after {display:block; content:"\A0";
}
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
   
   .pagination
   {display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}
   .pagination>li{display:inline}
   .pagination>li{display:inline}
 .pagination>li>a,
 .pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd}
 .pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}
 .pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}
 .pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,
 .pagination>li>span:hover{z-index:2;color:#23527c;background-color:#eee;border-color:#ddd}
 .pagination>.active>a,.pagination>.active>a:focus,.pagination>.active>a:hover,
 .pagination>.active>span,.pagination>.active>span:focus,
 .pagination>.active>span:hover{z-index:3;color:#fff;cursor:default;background-color:#337ab7;border-color:#337ab7}
 .pagination>.disabled>a,.pagination>.disabled>a:focus,.pagination>.disabled>a:hover,.pagination>.disabled>span,
 .pagination>.disabled>span:focus,
 .pagination>.disabled>span:hover{color:#777;cursor:not-allowed;background-color:#fff;border-color:#ddd}.pagination-lg>li>a,
 .pagination-lg>li>span{padding:10px 16px;font-size:18px;line-height:1.3333333}
</style>
<meta charset='utf-8' />
<link rel='stylesheet' href='css/default.css?v=1' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
<!-- <link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css' /> -->
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
<div class="card text-danger font-weight-bold bg-primary">
			<h5 class="card-title">Critères de recherche</h5>
				<form id="addCommentForm">
					<div class="form-row">
						<div  style="padding-left:20px;"class="col-sm-1">
						<label> N°</label>
						<input type='text' id='num_demande' name='num_demande' class='form-control' placeholder="N°Dm">
						</div>
						<div class="col col-md-2">
							<label>Client</label>				
							<input type='text' id='nomclient' name='nomclient' class='form-control rounded ' placeholder="Client">
						</div>
						
						<div class="col col-md-3">
						<label>Raison Social</label>	
						<input type='text' id='raison_social' name='raison_social' class='form-control' placeholder="Raison social">
						</div>
						<div class="col col-md-3">
						<label>Email</label>	
						<input type='text' id='Email' name='Email' class='form-control' placeholder="Email">
						</div>
						<div style="padding-right:20px;" class="col-md-3">
						<label>Numero telepehone </label>
						<input type='text' id='tel_client' name='tel_client' class='form-control' placeholder="téléphone">
						</div>
							<div style="padding-left:20px;" class="col col-sm-1">
							<label >V Min</label>
							<input id='volumemin' name='volumemin' type="number" min="0" class='form-control ' placeholder="V Mn">
						</div>
						<div class="col col-sm-1">
						<label>V Max</label>
					<input id='volume' name='volume' type="number" min="0" class='form-control ' placeholder="V Mx">
						</div>
						
					
						<div class="col-sm-3">
							<label>Source Demande</label>
							<select name='source' id='source' class='form-control' placeholder="Source demande">
							<option value=''>Source Demande</option>
								<?php
									if ($que_get_status_parameter) {
										while ($result_status_parameter = mysqli_fetch_array($que_get_status_parameter)) {
											echo "<option value=" . $result_status_parameter['id_source'] . ">". utf8_encode($result_status_parameter['nom_source']) . "</option>";
										}
									} else {
										echo "Erreur : " . mysqli_error($con);
									}									
								?>
							</select>
							</div>
							<div class="col-sm-3">
								<label>Type Client</label>
					<select name='type_Client' id='type_Client' class='form-control' placeholder="Type client">
						<!--<option value=''>Type client </option>
						<?php
								/*	if ($que_get_statuss_parameter) {
										while ($result_statuss_parameter = mysqli_fetch_array($que_get_statuss_parameter)) {
											echo "<option value=" . $result_statuss_parameter['id'] . ">". utf8_encode($result_statuss_parameter['valeur']) . "</option>";
										}
									} else {
										echo "Erreur : " . mysqli_error($con);
									}		*/							
								?>  -->
						<option value=''>Type client </option>
                          <option value="1">Particulier</option>
                           <option value="2">Soci&eacute;t&eacute;</option>
                           <option value="3">Association</option>
                           
                           </select> 
						   </div>
						   <div class="col-sm-2">
						   <label>Code Depart</label>
                 <input type='text' id='cp_depart' name='cp_depart' class='form-control' placeholder="CP depart">
						</div>
						<div  style="padding-right:20px;"class="col-sm-2">
						<label>Code Arriver</label>
					<input type='text' id='cp_arrive' name='cp_arrive'  class='form-control' placeholder="CP arriver">
						</div>
						  <div style="padding-left:20px;" class="col-2">
						  <label>Date Création</label>
						<input type='text' id='date_creation_demande' placeholder="Date creation demande" name='date_creation_demande' class='form-control datepicker '>
						</div>
						
						   <div  style="padding-left:20px"class="col-3">
						    <label>Date Depart</label>
						<input type='text' id='Date_depart' name='Date_depart' placeholder="Date depart" class='form-control datepicker'>
						</div>
						<div style="padding-left:20px;" class="col-3">
					 <label>Date Depart Avant</label>
							<input type='text' id='Date_departA' name='Date_departA' class='form-control datepicker'placeholder="Date depart avant" >
						</div>
							
						<div style="padding-left:20px;" class="col-3">
					<label>Date Depart Apres</label>
							<input type='text' id='Date_departd' name='Date_departd' class='form-control datepicker'placeholder="Date depart aprés" >
						</div>
							
							
						
					</div>					
					<button type='button' class='btn btn-success btn-fl-left' id='rechercher_demande' style='margin:10px; float: right;'><i class='fa fa-search fa-fw'></i>Rechercher</button>
				</form>
			
	</div>
   <div id="resultatRecherche">
      <div class="row">   
         <div class="col-xl-12 mb-30">     
            <div class="card card-statistics h-100"> 
               <div class="card-body">
                  <div class="table-responsive" id="resultatRecherche">
                     <table  class="table table-striped table-bordered p-0">
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

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }

	$total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 


	$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `demande`");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1;
	 $id_client_B2B=$_SESSION['id_client_B2B'];
	$query_search = "

			 select * ,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr from demande
                              INNER JOIN client  on demande.id_client=client.id_client
							  INNER JOIN source on demande.id_source=source.id_source 
                              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
                              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
                              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
                              LEFT JOIN visite vis ON vis.id_dem_vis=demande.id_dem
							  LEFT JOIN  masterParametreValeur type ON type.id = client.type_client
                             where demande.conf=0  and id_client_B2B='$id_client_B2B' order by demande.id_dem DESC LIMIT $offset, $total_records_per_page";
                              
		
		// echo $query_search;
		$req = mysqli_query($con, $query_search);
		$r = mysqli_fetch_assoc($req);
		$num = mysqli_num_rows ( $req );
		echo("<script>console.log('nombre de ligne: " . $num. "');</script>");
			echo("<script>console.log('total pages: " . $total_no_of_pages . "');</script>");
		if ($req) {
			

		?>
		<div id="resultatRecherche">
		
									<?php
									
									
   						while($result=mysqli_fetch_array($req)) {
									?>
										<tr>
											<form id='frm_list_relance_id' method='POST'>
											 
                                  
                              
											<td><?= $result['id_dem']; ?></td>
										    <td><?=$result['civilite']." ".$result['nom']." ".$result['prenom'];?><br>
											Tel :<?= $result['tel']."- Tel mobile ".$result['telMobile']; ?><br>
											Email:<?=$result['email'];?><br>
																							
											<td>Adresse : <?=$result['adresse_dep'];?>
											-<?=$result['code_postale_dep']." - ".$result['nom']; ?><br>
											<?php 
											$date_dep=$result['date_dep'];
                                            $a=substr($date_dep,0,4);
                                            $m=substr($date_dep,5,2);
                                            $j=substr($date_dep,8,2);
                                           if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                           echo 'Date : '.$date_dep;
									?>
			                               
									          
											</td>
								           	<td>Adresse  :<?=$result['adresse_arr'];?>
											- <?=$result['code_post_arr']." - ".$result['ville_arr'];?><br>
											<?php $date_arr=$result['date_arr'];
                                          $a=substr($date_arr,0,4);
                                          $m=substr($date_arr,5,2);
                                          $j=substr($date_arr,8,2);
                                          if ( $a == '00' ){$date_arr='';} else{$date_arr=$j."/".$m."/".$a;}
                                          echo 'Date : '.$date_arr;?> 
										  <a href="" title ='<?php echo 'Logement : '.$result['libelleTypeLogement_arr'];?> '>
                                    <i class="text-info ti-info"></i>...
                                 </a></td>	
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
											</form>
										</tr>
										
									<?php
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
						<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>
<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>

					</div>
				</div>
			</div>
		</div>
	
		<?php
		}
		mysqli_close($con);
	
	
	
	require_once"inc/footer.php";
}

else {
   header('location: index.php');
}
?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->
<script type="text/javascript" src='js/bootstrap-datatables/jquery.dataTables.min.js'></script>
<script src="js/gestion_listeDemande.js?v=<?php echo $date_en_cours; ?>"></script>
	
	<script>
	
    /* The following code is executed once the DOM is loaded */

    /* This flag will prevent multiple comment submits: */
   
   function loadresultatRecherche() {
	    var working = false;
    $.ajax({
         type: 'POST',
         url: "ajax/ajaxRecherchelisteDemande.php",
         data: $('#addCommentForm').serialize(), 
         success: function(response) {
           // alert("Submitted comment"); 
             $("#resultatRecherche").html(response);
         },
        error: function() {
             //$("#commentList").append($("#name").val() + "<br/>" + $("#body").val());
            alert("ereuur");
        }
     });
};
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
	    format: "dd-mm-yyyy",
	    firstDay: 1,
	    isRTL: false,
	    showMonthAfterYear: false,
	    yearSuffix: ''
	};
		
$("#rechercher_demande").click(function(){
  loadresultatRecherche();
     });
	</script>