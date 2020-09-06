<?php
	require_once '../../connect.php';
	$con 					= mysql_connect($SERVER,$USERNAME,$PASSWORD);
	mysql_select_db($BASENAME, $con);

	try {
	  $idd	              = $_POST['id_enc'];
		$date_action	      = $_POST['date_action'];
		$action  		      	= $_POST['action'];
		$date_creation 	    = $_POST['dat_cerat'];
		$type_encaisement	  = $_POST['Tencaissement'];
		$montant_encaisment = $_POST['montant'];
		$id_dev             = $_POST['id_devi'];
	  $type_presentation=$_POST['id_type'];
	  $tot_encais= $montant_encaisment;
		$ttc = $_POST['ttch'];
	  $rest=$ttc - $montant_encaisment;
	   $user=$_POST['id_user'];
	$req2="SELECT valeur FROM masterParametreValeur where id = $type_encaisement";
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
	('$ab','$numfact','$date_action','$date_creation','$montant_encaisment','$user','$action','$type_encaissement','$idd','$id_dev')";

$requete1 = mysql_query($req21) or die( mysql_error() ) ;
if($requete1)
  {


	echo '<center><div form-row> <div style="margin-top:4rem;" class="alert alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>bravo!</strong>vous donner sont ajouter avec succès
           	</div></div>';
			echo '</center>' ;

  }
  else
  {
    echo("L'insertion à échouée") ;
  }


  if (isset($_POST['id_enc'])!= "") {
		 
	   $req2="SELECT id FROM encaissement  ORDER BY id DESC LIMIT 1";
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
	$ab=1;
	}
	

	$req21="insert into encaissement (id,id_encaissement,type_prestation,id_devis,date_creation,userr_creat,total_encai,ttc,reste_encai) values
	('$ab','$idd','$type_presentation','$id_dev','$date_creation','$user','$montant_encaisment','$ttc','$rest')";

 $requete = mysql_query($req21)   or die( mysql_error() ) ;
 	
if($requete)
  {


	echo '<center><div form-row> <div style="margin-top:4rem;" class="alert alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>bravo!</strong>vous donner sont ajouter avec succès
           	</div></div>';
			echo '</center>' ;

  }
  else
  {
    echo("L'insertion à échouée") ;
  }

	
	}
	
	}


		 catch (exception $e)
	 {
			echo $e->getMessage() , "\n";
		}

?>
