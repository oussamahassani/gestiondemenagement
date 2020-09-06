<?php
require_once '../../db.php';

if(!empty($_POST["Devis"])) {
	$query= "SELECT *  FROM devis  LEFT JOIN  demande ON demande.id_dem = devis.id_demande where demande.id_type = '" . $_POST["Devis"] . "' AND devis.id_statut=46 AND NOT EXISTS(SELECT id_devis FROM encaissement
		    WHERE devis.id_devis = encaissement.id_devis) "; 
	
	$results = mysqli_query($con, $query) or die( mysqli_error($con)) ;
?>
	<?php
	foreach($results as $devi) {
?>
	<option value="<?php echo $devi["id_devis"]; ?>"><?php echo $devi["id_devis"]; ?></option>
<?php
	}
}
?>