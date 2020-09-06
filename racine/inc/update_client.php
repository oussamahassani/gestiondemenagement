	<?php	

	session_start (); 

	require_once '../../connect.php';
	$id_client=$_POST['id_client'];
	
	$ClientB2B=$_POST['isClientB2B'];
	
	

	
     
    if ($ClientB2B =="1")
	{
		echo $ClientB2B;
	 //Informations générales 
	 $raisonSocialeClientB2B=$_POST['raisonSocialeClientB2B'];
	 $pays=$_POST['pays'];
	 $ville=$_POST['ville'];
	 $codepostal=$_POST['codepostal'];
	 $adresse=$_POST['adresse'];
	 $emailClientB2B=$_POST['emailClientB2B'];
	 $telClientB2B=$_POST['telClientB2B'];
	 $Siret=$_POST['Siret'];
     $date_activation=$_POST['date_activation'];
     $a=substr($date_activation,6,4);
     $m=substr($date_activation,3,2);
     $j=substr($date_activation,0,2);
	 $date_activation=$a."-".$m."-".$j;
	 
	 //Informations responsable 
	 $civiliteResponsable=$_POST['civiliteResponsable'];
	 $prenomResponsable=$_POST['prenomResponsable'];
	 $nomResponsable=$_POST['nomResponsable'];
	 $professionResponsable=$_POST['professionResponsable'];
	 $pseudoskypeResponsable=$_POST['pseudoskypeResponsable'];
	 $telResponsable=$_POST['telResponsable'];
	 $telMobileResponsable=$_POST['telMobileResponsable'];
	 $emailResponsable=$_POST['emailResponsable'];

	//Informations Cron Envoi Lead
	$cronActif=$_POST['cronActif'];
	$nbMaxEnvoiLead=$_POST['nbMaxEnvoiLead'];
	$solde=$_POST['solde'];
	$volumeMin=$_POST['volumeMin'];
	$volumeMax=$_POST['volumeMax'];
	$codesPostauxDepart=$_POST['codesPostauxDepart'];
	$codesPostauxArrivee=$_POST['codesPostauxArrivee'];
	$req2=mysql_query("Update client SET clientB2B=1,type_client='2',civilite='$civiliteResponsable',nom='$nomResponsable',prenom='$prenomResponsable',tel='$telResponsable',
	telMobile='$telMobileResponsable',profession='$professionResponsable',pseudoskype='$pseudoskypeResponsable',email='$emailResponsable',raisonsociale='$raisonSocialeClientB2B',
	pays='$pays',ville='$ville',codepostal='$codepostal',adresse='$adresse',emailClientB2B='$emailClientB2B',telClientB2B='$telClientB2B',
	siret='$Siret',date_activation='$date_activation',cronActif=$cronActif,nbMaxEnvoiLead='$nbMaxEnvoiLead',solde='$solde',volumeMin='$volumeMin',volumeMax='$volumeMax',
	codesPostauxDepart='$codesPostauxDepart',codesPostauxArrivee='$codesPostauxArrivee' where id_client='$id_client'" );
	
	}else
    {
	
	$typeClient=$_POST['typeClient'];
	
	if($typeClient=="1")
	{
		echo ($typeClient);
	$civilite=$_POST['civilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$telephone=$_POST['telephone'];
	$telMobile=$_POST['telMobile'];
	$email=$_POST['email'];
	$req2=mysql_query("Update client SET clientB2B=0,type_client='$typeClient',civilite='$civilite',nom='$nom',prenom='$prenom',tel='$telephone',telMobile='$telMobile',email='$email' where id_client='$id_client'");
	//echo("Update client SET clientB2B=0,type_client='$typeClient',civilite='$civilite',nom='$nom',prenom='$prenom',tel='$telephone',email='$email' where id_client='$id_client'");
}
	else
	{
	$nomPro=$_POST['nomPro'];
	$telephonePro=$_POST['telephonePro'];
	$emailPro=$_POST['emailPro'];
	$req2=mysql_query("Update client SET clientB2B=0,type_client='$typeClient',raisonsociale='$nomPro',tel='$telephonePro',email='$emailPro' where id_client='$id_client'");
    }
	   
    }


	?>
<script type="text/javascript">
	document.location.href="../liste_client.php";
	
	</script>

