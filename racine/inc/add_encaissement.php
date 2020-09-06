	<?php	

	session_start (); 

	require_once '../../connect.php';
	$idd=$_POST['num_encaisement1'];
    $type_presentation=$_POST['type_presentation1'];
	$tot_encais=$_POST['tot_encais1'];
	$rest=$_POST['rest1'];
	$date_creation=$_POST['date_creation1'];
	$num_iddevis=$_POST['num_iddevis'];
	$user=$_POST['user1'];
	$montant=$_POST['montant'];
	$Tencaissement=$_POST['Tencaissement'];
	$date_action=$_POST['date_action'];
	$action=$_POST['action'];
		$req2="SELECT valeur FROM masterParametreValeur where id = $Tencaissement";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	$row = mysql_fetch_assoc($requete2 );
    $type_encaissement =  $row['valeur'];

$req2="SELECT 	id FROM facturation ORDER BY id DESC LIMIT 1";
	$requete2 = mysql_query($req2) or die( mysql_error()) ;
	$c = mysql_num_rows($requete2);
	   if (mysql_num_rows($requete2))
	   {
	   	$row = mysql_fetch_assoc($requete2);
        $ab = $row['id'];
	   $ab+=1;
	   	}
	   else
	   {
	$ab=1;}
	

    $numfact = $idd.'-'.$ab ;
	$req21="insert into facturation (id,numero_Facture,date_action,datee_creat,montant,user,action,type_encaissement,id_encaisseme,id_deviss) values
	('$ab','$numfact','$date_action','$date_creation','$montant','$user','$action','$type_encaissement','$idd','$num_iddevis')";
$requete1 = mysql_query($req21) or die( mysql_error() ) ;
    
if($requete)
  {
    echo("L'insertion a été correctement effectuée") ;
  }
  else
  {
    echo("L'insertion à échouée") ;
  }
  
?>

	<script type="text/javascript">
	document.location.href="../liste_encaissement.php";

	
	</script>