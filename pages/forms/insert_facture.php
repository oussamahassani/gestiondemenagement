	<?php	
	session_start (); 
	include("connect.php");	
	$id_admin=$_SESSION['id'];
	$id=$_POST['dem'];
	$idd=$_POST['dev'];
	$nom=$_POST['nom'];	
	$adresse=$_POST['adresse'];
	$adresse=str_replace("'", "&acute;",$adresse);
	$prestation=$_POST['prestation'];
	$prestation=str_replace("'", "&acute;",$prestation);
	$details=$_POST['details'];
	$details=str_replace("'", "&acute;",$details);
	$ht=$_POST['ht'];
	$tva=$_POST['tva'];
	$date=$_POST['date'];
	$a=substr($date,6,4);
	$m=substr($date,3,2);
	$j=substr($date,0,2);
	$date=$a."-".$m."-".$j;
	
	$paye=$_POST['paye'];	
	$reste=$_POST['reste'];	
	$arrete=$_POST['arrete'];	
	
	 
				  $req=mysql_query("select * from facture where id_dem='$id'");
				if($result1=mysql_fetch_array($req))
				{
					$req2=mysql_query("
	UPDATE facture SET nom_client='$id',adresse='$adresse',presta='$prestation',details='$details',montant_ht='$ht',tva='$tva',montant_paye='$paye',reste='$reste',arrete='$arrete',id_admin_fac='$id_admin'
	
	where id_dem='$id' ");
	
					
				}else
				{
	
	
	$req2=mysql_query("insert into facture(nom_client,adresse,presta,details,montant_ht,tva,montant_paye,reste,arrete,date,id_dem,id_admin_fac) 
	values ('$nom','$adresse','$prestation','$details','$ht','$tva','$paye','$reste','$arrete','$date','$id','$id_admin')");
	$idf=mysql_insert_id();	
				}
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
    header('location: ../forms/facture.php?dem='.$id.'&dev='.$idd);
?>	<script type="text/javascript">
document.location.href="../forms/facture.php?dem=<?php echo $id; ?>&dev=<?php echo $idd; ?>";
</script>

