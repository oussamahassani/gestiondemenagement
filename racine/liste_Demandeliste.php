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
div:after {display:block; content:"\A0";
 padding-left:50px;
  padding-right:50px;}
</style>
<div class="content-wrapper overfl-auto">
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
   
	<div class="card">
			<h5 class="card-title">Critères de recherche</h5>
				<form>
					<div class="form-row">
						<div  style="padding-left:20px;"class="col-sm-1">
						<label> N°</label>
						<input type='text' id='num_demande' name='num_demande' class='form-control' placeholder="N°Dm">
						</div>
						<div class="col col-md-2">
							<label>Client</label>				
							<input type='text' id='nomclient' name='nomclient' class='form-control' placeholder="Client">
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
						  <div style="padding-left:10px;" class="col-3">
						  <label>Date Création</label>
						<input type='text' id='date_creation_demande' placeholder="Date creation demande" name='date_creation_demande' class='form-control datepicker '>
						</div>
						
						   <div  style="padding-left:20px"class="col-3">
						    <label>Date Depart</label>
						<input type='text' id='Date_depart' name='Date_depart' placeholder="Date depart" class='form-control datepicker'>
						</div>
						<div style="padding-left:40px;" class="col-3">
					 <label>Date Depart Avant</label>
							<input type='text' id='Date_departA' name='Date_departA' class='form-control datepicker'placeholder="Date depart avant" >
						</div>
							
						<div style="padding-left:10px;" class="col-4">
					<label>Date Depart Apres</label>
							<input type='text' id='Date_departd' name='Date_departd' class='form-control datepicker'placeholder="Date depart aprés" >
						</div>
							
							
						
					</div>					
					<button type='button' class='btn btn-success btn-fl-left' id='rechercher_demande' style='margin:10px; float: right;'><i class='fa fa-search fa-fw'></i>Rechercher</button>
				</form>
			
	</div>
	<table id="datatable" class="table table-striped table-bordered p-0">
        
	 <div id='liste_listedemande'> </div>
	
	<table>
<?php
	require_once"inc/footer.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->
<script type="text/javascript" src='js/bootstrap-datatables/jquery.dataTables.min.js'></script>
<script src="js/gestion_listeDemande.js?v=<?php echo $date_en_cours; ?>"></script>
</div>
<?php
} else {
	header('location: ../login.php');
}
?>