<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start ();
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	require_once "inc/header.php";
	require_once "inc/menu.php";
	require_once '../db.php';
    $query_type_parametre= "SELECT * FROM masterparametrevaleur where idMasterParametre=1";
	$date_en_cours = date("Ymd-His");

	$query_status_parameter = "select * from source";
	$que_get_statuss_parameter     = mysqli_query($con, $query_type_parametre);
	$que_get_status_parameter     = mysqli_query($con, $query_status_parameter);
?>
<meta charset='utf-8' />
<link rel='stylesheet' href='css/default.css?v=1' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
<!-- <link rel='stylesheet' href='https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css' /> -->
<style>
div:after {display:block; content:"\A0";}
</style>
<div class="content-wrapper overfl-auto">
	<div class="page-title">
      	<div class="row">
			<div class="col-sm-4">
				<h4 class="mb-0">Liste des demandes</h4>
			</div>
			<div class="col-sm-4">
				<ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
					<li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
					<li class="breadcrumb-item active">Liste  Demandes</li>
				</ol>
			</div>
        </div>
    </div>
   
	<div class="row">
		<div class="col-md-12 mrg-35">
			<div class=" card text-white bg-info mb-3">
				<form>
					<div class="row">
						<div class="col-sm-2">
							<label for='num_demande'>N&deg; Demande</label>
							<input type='text' id='num_demande' name='num_demande' class='form-control'>
						</div>
						<div class="col-md-3">
							<label for='client'>Client</label>
						
							<input type='text' id='client' name='client' class='form-control'>
						</div>
						<div class="col-md-2">
							<label for='date_future_relance'>Raison social</label>
							<input type='text' id='Raison_social' name='Raison_social' class='form-control'>
						</div>
						<div class="col-md-2">
							<label for='email'>Email</label>
							<input type='text' id='Email' name='Email' class='form-control'>
						</div>
						<div class="col-md-2">
							<label for='num_tel'>T&eacute;l&eacute;phone</label>
							<input type='text' id='tel_client' name='tel_client' class='form-control'>
						</div>
						<div class="col-sm-2">
							<label for='volume'>Volume min</label>
							<input type='text' id='volumemin' type="number" name='volumemin' class='form-control '>
						</div>
						<div class="col-sm-2">
							<label for='volume'>Volume max</label>
							<input type='text' id='volume' type="number" name='volume' class='form-control '>
						</div>
						<div class="col-md-2">
							<label for='statut_relance'>Source demande</label>
							<!--<select name='statut_relance' id='statut_relance' class='form-control'>
								<option value=''>S&eacute;l&eacute;ctionnez un statut</option>
								
							</select>-->
							<select name='source' id='source' class='form-control'>
								<option value=''>S&eacute;l&eacute;ctionnez un statut</option>
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
						<div class="col-md-2">
							<label for='client'>Type Client</label>
						<select name='type_Client' id='type_Client' class='form-control'>
						
						<?php/*
									if ($que_get_statuss_parameter) {
										while ($result_statuss_parameter = mysqli_fetch_array($que_get_statuss_parameter)) {
											echo "<option value=" . $result_statuss_parameter['id'] . ">". utf8_encode($result_statuss_parameter['valeur']) . "</option>";
										}
									} else {
										echo "Erreur : " . mysqli_error($con);
									}									
								*/?>
						<option value=''>S&eacute;l&eacute;ctionnez un type </option>
                          <option value="volvo">Particulier</option>
                           <option value="saab">Soci&eacute;t&eacute;</option>
                           <option value="mercedes">Association</option>
                           
                           </select>
						   </div>
						
						<div class="col-sm-2">
							<label for='date_depart'>CP d&eacute;part</label>
							<input type='text' id='cp_depart' name='cp_depart' class='form-control'>
						</div>
						<div class="col-sm-2">
							<label for='date_depart'>CP arriv&eacute;e</label>
							<input type='text' id='cp_arrive' name='cp_arrive' class='form-control '>
						</div>
							<div style=" padding-left: 10px;}" >
							<label for='date_future_relance'>Date creation demande</label>
							<input type='text' id='date_creation_demande' name='date_creation_demande' class='form-control datepicker '>
						</div>
						<div style=" padding-left: 10px;}">
							<label for='date_depart'>Date depart</label>
							<input type='text' id='Date_depart' name='Date_depart' class='form-control datepicker'>
						</div>
						
						<div style=" padding-left: 10px;}">
							<label for='date_depart'>Date depart avant</label>
							<input type='text' id='Date_departA' name='Date_departA' class='form-control'>
						</div>
						
						<div  style=" padding-left: 02px;}">
							<label for='date_depart'>Date depart apr&eacute;s</label>
							<input type='text' id='Date_departd' name='Date_departd' class='form-control datepicker '>
						</div>
						
						
						
						
					</div>					
					<button type='button' class='btn btn-success btn-fl-left' id='rechercher_demande' style='margin-top: 10px; float: right;'><i class='fa fa-search fa-fw'></i>Rechercher</button>
				</form>
			</div>
		</div>
	</div>
<div id="resultatRecherche">
    <div class="row">   
    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive" id="resultatRecherche">
          <?php
		  $query_search = "

			 select * ,ts.valeur as typefacturation, tl_dep.valeur AS libelleTypeLogement_dep, tl_arr.valeur AS libelleTypeLogement_arr from demande
                              INNER JOIN client  on demande.id_client=client.id_client
							  INNER JOIN source on demande.id_source=source.id_source 
                              LEFT JOIN masterParametreValeur  tl_dep ON tl_dep.id=typeLogement_dep
                              LEFT JOIN masterParametreValeur  tl_arr ON tl_arr.id=typeLogement_arr
                              LEFT JOIN masterParametreValeur  ts ON ts.id =type_facturation
                              LEFT JOIN visite vis ON vis.id_dem_vis=demande.id_dem
							  LEFT JOIN  masterParametreValeur type ON type.id = client.type_client
                             
                          order by demande.date_creation DESC ";
                              
		
		// echo $query_search;
		$req = mysqli_query($con, $query_search);
		
		?>
		  
		  
            <table id="datatable" class="table table-striped table-bordered p-0">
			<thead>
										<tr>
											<th >N°</th>
											<th width="20px" height="10px" border align="left">Informaion client</th>
											<th width="20%">Informations départ</th>
											<th width="20%">Informaion arriver</th>
											<th width="20%">Autre</th>
										</tr>
									</thead>
              	<div class="row">
				

									
									<?php
									while($result=mysqli_fetch_array($req)) {
									?>
										<tr>
											<form id='frm_list_relance_id' method='POST'>
												<td><?= $result['id_dem']; ?></td>
											<td><?=$result['civilite']." ".$result['nom']." ".$result['prenom'];?><br>
											Num mobile :<?= $result['telMobile']; ?><br>
											Num telepone : <?= $result['tel']; ?><br>
											Email:<?=$result['email'];?><br>
											typeclient:<?=$result['type_client'];?><br>
											Raison social :<?=$result['raisonsociale'];?> </td>
												
											<td> <?php $date_dep=$result['date_dep'];
                                    $a=substr($date_dep,0,4);
                                    $m=substr($date_dep,5,2);
                                    $j=substr($date_dep,8,2);
                                    if ( $a == '00' ){$date_dep='';} else{$date_dep=$j."/".$m."/".$a;}
                                     echo 'Date  : '.$date_dep;?>
											<br>
											Adresse depart :<?=$result['adresse_arr']; ?><br>
											Code postale :<?=$result['code_postale_dep']; ?><br>
											<?php                               
                                    $date_creation=$result['date_creation'];
                                    $a=substr($date_creation,0,4);
                                    $m=substr($date_creation,5,2);
                                    $j=substr($date_creation,8,2);
                                    if ( $a == '00' ){$date_creation='';} else{$date_creation=$j."/".$m."/".$a;}
                                    echo 'Date creation : '.$date_creation;
			                               ?>
									          
											</td>
								           	<td><?php                                  
                                    $date_arr=$result['date_arr'];
                                    $a=substr($date_arr,0,4);
                                    $m=substr($date_arr,5,2);
                                    $j=substr($date_arr,8,2);
                                    if ( $a == '00' ){$date_arr='';} else{$date_arr=$j."/".$m."/".$a;}
                                    echo 'Date : '.$date_arr;
			                               ?>
											 <br>
											Adresse  :<?=$result['adresse_arr']; ?><br>
											Code postale:<?=$result['code_post_arr']?> </td>	
											<td>  
                                             <?php 
                                  
                                    echo 'Volume : '.$result['volume'];
                                    echo '<br>';
                                    echo 'Type service : '.$result['typefacturation'];  
                                    echo '<br>';									
                                    echo 'source : '.$result['nom_source'];									
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
										
									
		</div>
     

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
<script src="js/gestion_listeDemande.js?v=<?php echo $date_en_cours; ?>">


/*
function loadresultatRecherche() {
  //alert("Image is loaded");
    var data=$("#moteur").serialize();
    //alert(data);
		$.ajax({ 
		   
		   type: "POST", 
		   url: "ajax/ajaxRecherchelisteDemande.php",
		   data: data,
        beforeSend : function(){ 
							$("#resultatRecherche").html('<img src="images/pre-loader/loader-01.svg" style="padding-top:50px; margin-left:45%;" alt="" border="0">'); 
						},
		   error : function(){alert(unescape('Erreur de chargement!')); return false; },
		   success : function(returnData){
			    
				$("#resultatRecherche").html(returnData);
			}
	
     });
 
 
}

$("#btnRechercher").click(function(){
  loadresultatRecherche();
     });

    // loadresultatRecherche();


function loadresultatRecherche() {
  //alert("Image is loaded");
    var data=$("#moteur").serialize();
    //alert(data);
		$.ajax({ 
		   
		   type: "POST", 
		   url: "ajax/ajax_Liste_Client.php",
		   data: data,
        beforeSend : function(){ 
							$("#resultatRecherche").html('<img src="images/pre-loader/loader-01.svg" style="padding-top:50px; margin-left:45%;" alt="" border="0">'); 
						},
		   error : function(){alert(unescape('Erreur de chargement!')); return false; },
		   success : function(returnData){
			    
				$("#resultatRecherche").html(returnData);
			}
	
     });
 
 
}

$("#btnRechercher").click(function(){
  loadresultatRecherche();
     });

    // loadresultatRecherche();
*/
</script>
