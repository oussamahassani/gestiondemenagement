	<?php	

	session_start (); 

	require_once '../../connect.php';
	$isClientB2B=$_POST['isClientB2B'];
	
	if ($isClientB2B =="1")
	{
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
	
	$req2=mysql_query("insert into client(clientB2B,type_client,civilite,nom,prenom,tel,telMobile,profession,pseudoskype,email,raisonsociale,pays,ville,codepostal,adresse,emailClientB2B,telClientB2B,siret,date_activation,cronActif,nbMaxEnvoiLead,solde,volumeMin,volumeMax,codesPostauxDepart,codesPostauxArrivee) 
	values (1,'2','$civiliteResponsable','$nomResponsable','$prenomResponsable','$telResponsable','$telMobileResponsable','$professionResponsable','$pseudoskypeResponsable','$emailResponsable','$raisonSocialeClientB2B','$pays','$ville','$codepostal','$adresse','$emailClientB2B','$telClientB2B','$Siret','$date_activation','$cronActif','$nbMaxEnvoiLead','$solde','$volumeMin','$volumeMax','$codesPostauxDepart','$codesPostauxArrivee')");
	}else

	{
	
	$typeClient=$_POST['typeClient'];

	if($typeClient==1)
	{
	$civilite=$_POST['civilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$telephone=$_POST['telephone'];
	$telMobile=$_POST['telMobile'];
	$email=$_POST['email'];
	$req2=mysql_query("insert into client(clientB2B,type_client,civilite,nom,prenom,tel,telMobile,email) values (0,'$typeClient','$civilite','$nom','$prenom','$telephone','$telMobile','$email')");
	}
	else
	{
	$nomPro=$_POST['nomPro'];
	$telephonePro=$_POST['telephonePro'];
	$emailPro=$_POST['emailPro'];
	$req2=mysql_query("insert into client(clientB2B,type_client,raisonsociale,tel,email) values (0,'$typeClient','$nomPro','$telephonePro','$emailPro')");
    }
	$idclient=mysql_insert_id();	    
    }

	
echo "insert into client(clientB2B,type_client,civilite,nom,prenom,tel,telMobile,profession,pseudoskype,email,raisonsociale,pays,ville,codepostal,adresse,emailClientB2B,telClientB2B,siret,date_activation,cronActif,nbMaxEnvoiLead,solde,volumeMin,volumeMax,codesPostauxDepart,codesPostauxArrivee) 
values (1,'2','$civiliteResponsable','$nomResponsable','$prenomResponsable','$telResponsable','$telMobileResponsable','$professionResponsable','$pseudoskypeResponsable','$emailResponsable','$raisonSocialeClientB2B','$pays','$ville','$codepostal','$adresse','$emailClientB2B','$telClientB2B','$Siret','$date_activation','$cronActif','$nbMaxEnvoiLead','$solde','$volumeMin','$volumeMax','$codesPostauxDepart','$codesPostauxArrivee')";

	
	?>
	<script type="text/javascript">
	document.location.href="../liste_client.php";
	
	</script>

