<?php
session_start ();
require_once '../../connect.php';


    $action=$_POST['action'];
	$datee=$_POST['date_action'];
	$Tencaissement=$_POST['Tencaissement'];
	$date_creation=$_POST['date_creation1'];
	$nom_user=$_POST['nom_user'];
	$montant=$_POST['montant'];
	$nom_encais=$_POST['nom_encais'];
  $id_devis=$_POST['id_devis'];

$req2="SELECT valeur FROM masterParametreValeur where id = $Tencaissement  ";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	$row = mysql_fetch_assoc($requete2 );
    $type_encaissement =  $row['valeur'];
	if($_POST['nom_encais']!="")
	{ $req2="SELECT 	id FROM facturation ORDER BY id DESC LIMIT 1";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	   	$row = mysql_fetch_assoc($requete2);
	$ab = $row['id'];
	   $ab+=1;
		$numfact = $nom_encais.'-'.$ab ;
	$req21="insert into facturation (id,numero_Facture,date_action,datee_creat,montant,user,action,type_encaissement,id_encaisseme,id_deviss)
	values ('$ab','$numfact','$datee','$date_creation','$montant','$nom_user','$action','$type_encaissement','$nom_encais','$id_devis')";

		/*

	$req2=mysql_query("UPDATE encaissement  SET 	id_encaissement='$num_encaisement' ,date_creation ='$date_creation' ,total_encai = 'tot_encais' ,userr_creat='$user' ,reste_encai='$reste' ,type_prestation=' $type_presentation' where id_encaissement='$num_encaisement' ")

		or die( mysql_error() ) ;
		*/
		echo '<p>valeur de requetteee 2 est'.$nom_encais .'</p>';
	}
$requete = mysql_query($req21) or die( mysql_error() ) ;
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
document.location.href="../modif_encaisement1.php?id_vol="+variable2
</script>
