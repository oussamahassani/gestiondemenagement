<?php
session_start ();
require_once '../../db.php';


    $action=$_POST['action'];
	$datee=$_POST['date'];
	$Tencaissement=$_POST['Tencaissement'];
	$date_creation=$_POST['date_creation'];
	$nom_user=$_POST['user'];
	$montant=$_POST['montant'];
	$nom_encais=$_POST['num_encaisement'];
  $id_devis=$_POST['id_devis'];
?>
<script>
 var variable2= <?php echo json_encode($id_devis); ?>;
 var variable3= <?php echo json_encode($montant); ?>;
 var variable4= <?php echo json_encode($Tencaissement); ?>;
 var variable5= <?php echo json_encode($action); ?>;
  var variable6= <?php echo json_encode($nom_user); ?>;
   var variable7= <?php echo json_encode($date_creation); ?>;
 var variable8= <?php echo json_encode($datee); ?>;

console.log("id_devis"+ variable2);
console.log("montant" + variable3);
console.log("Tencaissement" + variable4);
console.log("action" + variable5);
console.log("nom_encais" + variable6);
console.log("date_creation" + variable7);
console.log("datee" + variable8);

</script>
<?php
$req1="SELECT valeur FROM masterParametreValeur where id = $Tencaissement ";
	$requete1 = mysqli_query($con,$req1); /*or die( mysql_error()) ;*/
	$row = mysqli_fetch_assoc($requete1 );
    $type_encaissement =  $row['valeur'];
 $req22="SELECT 	id FROM facturation ORDER BY id DESC LIMIT 1";
	$requete2 = mysqli_query($con,$req22); /*or die( mysql_error()) ;*/
	   	$row1= mysqli_fetch_assoc($requete2);
	$ab = $row1['id'];
	   $ab+=1;
		$numfact = $nom_encais.'-'.$ab ;

		
	$req21="insert into facturation (id,numero_Facture,date_action,datee_creat,montant,user,action,type_encaissement,id_encaisseme,id_deviss)
	values ('$ab','$numfact','$datee','$date_creation','$montant','$nom_user','$action','$type_encaissement','$nom_encais','$id_devis')";
$requete = mysqli_query($con,$req21)  or die( mysqli_error($con) ) ;

		echo '<p>valeur de requetteee 2 est'.$nom_encais .'</p>';
	

	if($requete)
  {
    echo("L'insertion a été correctement effectuée");

	echo ' <div style="margin-top:4rem;" class="alert alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>bravo!</strong>vous donner sont ajouter avec succès
        <a class="close" href="../racine/liste_volume.php">&times;</a>
           	</div>';
			echo '</div>' ;

  }
  else
  {
    echo("L'insertion à échouée") ;
  }


?>

<script>
 var variable2= <?php echo json_encode($nom_encais); ?>;
document.location.href="../modif_encaisement.php?id_vol="+variable2
</script>
