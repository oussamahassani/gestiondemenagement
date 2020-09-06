<?php
require_once '../../connect.php';
$query_get_all_users = "
   SELECT id_utilisateur, CONCAT(UPPER(nom), ' ', prenom) raisonSociale
   FROM utilisateur
";
// echo $query_get_all_users . "<hr />";
$que_all_users              = mysql_query($query_get_all_users);

$query_get_status_parameter = "
	SELECT id, valeur 
	FROM `masterParametreValeur` mpv
	WHERE idMasterParametre = 11
";
// echo $query_get_status_parameter;
// exit;
$que_get_status_parameter     = mysql_query($query_get_status_parameter);
$i = $_POST['i'];
?>
<tr>
	<td>
	   <input type='text' name='date_relance' id='date_relance_<?php echo $i; ?>' class='form-control datepicker' value='' autocomplete="off" data-rule-required="true" placeholder='Date de la future relance' />
	</td>
	<td>
	   <input type='text' name='heure_relance' id='heure_relance_<?php echo $i; ?>' class='form-control' value='' autocomplete="off" value='' placeholder='Heure de la future relance' />
	</td>
	<td>
	   	<select name='responsable_relance' id='responsable_relance_<?php echo $i; ?>' class='form-control' autocomplete="off">
	   		<option value=''>S&eacute;l&eacute;ctionnez un responsable</option>
			<?php
				while ($result_users = mysql_fetch_array($que_all_users)) {
					echo "<option value=" . $result_users['id_utilisateur'] . ">". $result_users['raisonSociale'] . "</option>";
				}
			?>
		</select>
	</td>
	<td>
	   <select name='statut_relance' id='statut_relance_<?php echo $i; ?>' class='form-control' autocomplete="off">
	   	<option value=''>S&eacute;l&eacute;ctionnez un statut</option>
	   <?php
	   while ($result_status_parameter = mysql_fetch_array($que_get_status_parameter)) {
	      echo "<option value=" . $result_status_parameter['id'] . ">". utf8_encode($result_status_parameter['valeur']) . "</option>";
	   }
	   ?>
	  </select>
	</td>
	<td>
	   <textarea name='commentaire_relance' id='commentaire_relance_<?php echo $i; ?>' class='form-control' autocomplete="off" value='<?php echo $data_relance['commentaire']; ?>' placeholder='Commentaire sur la relance'></textarea>
	</td>
</tr>