<?php
session_start ();
if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	require_once "inc/header.php";
	require_once "inc/menu.php";
	require_once '../connect.php';
	require_once "inc/mod_utilisateur.php";
	require_once "inc/mod_statutParametre.php";

	$que_user_logged 			= mysql_query($query_user_logged);
	$result_user_logged 		= mysql_fetch_array($que_user_logged);

	$que_get_status_parameter 	= mysql_query($query_get_status_parameter);

?>
<meta charset='utf-8' />
<link rel='stylesheet' href='css/default.css?v=1.3' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
<div class="content-wrapper overfl-auto">
	<div class="page-title">
      	<div class="row">
			<div class="col-sm-6">
				<h4 class="mb-0">Ajout d'une relance</h4>
			</div>
			<?php
				// echo "<pre>";
				// while ($result_status_parameter = mysql_fetch_array($que_get_status_parameter)) {
				// 	echo $result_status_parameter['statut'] . "<hr />";
				// 	echo $result_status_parameter['id'] . "<hr />";
				// }
				// echo "</pre>";
			?>
			<div class="col-sm-6">
				<ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
					<li class="breadcrumb-item"><a href="../index.php" class="default-color">Acceuil</a></li>
				</ol>
			</div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="">
				<div class="row">
					<form method='POST' action='inc/valide_relance.php' id='frm_relance'>
						<div class="row">
							<div class="col-md-3">
								<label for='civilite_client'>Civilit&eacute;</label>
								<select class='form-control' name='civilite_client' data-rule-required="true" data-msg-required="Civilit&eacute; obligatoire">
									<option value=''>S&eacute;l&eacute;ctionnez une civilit&eacute;</option>
									<option value='Mme'>Mme</option>
									<option value='Mr'>Mr</option>
								</select>
							</div>
							<div class="col-md-3">
								<label for='nom_client'>Nom</label>
								<input type='text' id='nom_client' name='nom_client' class='form-control' data-rule-required="true" data-msg-required="Nom obligatoire" data-rule-nomValid="true" data-msg-nomValid="Nom invalide" />
							</div>
							<div class="col-md-3">
								<label for='prenom_client'>Pr&eacute;nom</label>
								<input type='text' id='prenom_client' name='prenom_client' class='form-control' data-rule-required="true" data-msg-required="Pr&eacute;noms obligatoire" data-rule-prenomValid="true" data-msg-prenomValid="Pr&eacute;noms invalide" />
							</div>
							<div class="col-md-3">
								<label for='num_tel_client'>Num t&eacute;l&eacute;phone</label>
								<input type='text' id='num_tel_client' name='num_tel_client' class='form-control' data-rule-required="true" data-msg-required="Num&eacute;ro tel obligatoire" data-rule-numeroValid="true" data-msg-numeroValid="Num&eacute;ro invalide" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label for='num_mobile_client'>Num mobile</label>
								<input type='text' id='num_mobile_client' name='num_mobile_client' class='form-control' data-rule-required="true" data-msg-required="Num&eacute;ro mobile obligatoire">
							</div>
							<div class="col-md-6">
								<label for='mail_client'>Adresse Mail</label>
								<input type='text' id='mail_client' name='mail_client' class='form-control' data-rule-required="true" data-msg-required="Mail obligatoire" data-rule-validEmail="true" data-msg-validEmail="Mail invalide">
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<label for='date_depart'>Date de d&eacute;part</label>
								<input type='text' id='date_depart' name='date_depart' class='form-control datepicker'>
							</div>
							<div class="col-md-3">
								<label for='cp_depart'>Code postal de d&eacute;part</label>
								<input type='text' id='cp_depart' name='cp_depart' class='form-control'>
							</div>
							<div class="col-md-6"></div>
						</div>
						<!-- Emplacement picto -->
						<div class="row">
							<div class="table-responsive">
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
												<input type='text' name='date_relance' id='date_relance' class='form-control datepicker' autocomplete="off" data-rule-required="true" data-msg-required="Date de la relance obligatoire" value='' placeholder='yyyy-mm-jj' data-rule-required="true" data-msg-required="Date obligatoire" />
											</td>
											<td>
												<input type='text' name='heure_relance' id='heure_relance' class='form-control' autocomplete="off" value='' placeholder='Heure de la relance' />
											</td>
											<td>
												<label for='responsable_relance'><?php echo  ucfirst($result_user_logged['nom']) ;?></label>
												<input type='hidden' name='responsable_relance' id='responsable_relance' class='form-control' value="<?php echo  $result_user_logged['id_utilisateur'];?>" />
											</td>
											<td>
												<!-- <select name='statut_relance' id='statut_relance' class='form-control' autocomplete="off"> -->
												<select name='statut_relance' id='statut_relance' class='form-control' autocomplete="off" data-rule-required="true" data-msg-required="Statut obligatoire">
													<option value=''>S&eacute;l&eacute;ctionnez un statut</option>
													<?php
														while ($result_status_parameter = mysql_fetch_array($que_get_status_parameter)) {
															echo "<option value=" . $result_status_parameter['id'] . ">". utf8_encode($result_status_parameter['statut']) . "</option>";
															// echo $result_status_parameter['statut'];
															// echo $result_status_parameter['id'];
														}
													?>
												</select>
											</td>
											<td>
												<textarea name='commentaire_relance' id='commentaire_relance' class='form-control' autocomplete="off" value='' placeholder='Commentaire sur la relance'></textarea>
											</td>
											<input type='hidden' id='id_devis' value='' />
											<input type='hidden' id='comptRelance' name='comptRelance' value='' />
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<th>Date</th>
											<th>Heure</th>
											<th>Responsable</th>
											<th>Statut</th>
											<th>Commentaire</th>
										</tr>
									</tfoot>
								</table>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type='submit' name='enreg_relance' id='saveRelance' class='btn btn-primary fl-left'><i class='fa fa-plus'></i>Enregistrer</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
</div>
<?php
	require_once"inc/footer.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<script src="js/enreg_relance.js?v=1.2"></script>
</div>
<?php
} else {
	header('location: index.php');
}
?>