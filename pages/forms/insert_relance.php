	<?php
session_start (); 	
	include("connect.php");	
	
	$id_admin=$_SESSION['id'];
	$date=$_POST['date'];
	$a=substr($date,6,4);
	$m=substr($date,3,2);
	$j=substr($date,0,2);
	$date=$a."-".$m."-".$j;
    
	$heure=$_POST['time'];	
	$dem=$_POST['dem'];
	$remarque=$_POST['remarque'];
	$remarque=str_replace("'", "&acute;",$remarque);
	$req2=mysql_query("insert into relance(	id_demande_rel,date_relance,heure_relance,remarque_relance,id_admin_rel)
	values ('$dem','$date','$heure','$remarque','$id_admin')");    
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
   header('location: ../tables/liste_devis.php');
?>	<script type="text/javascript">
document.location.href="../tables/liste_devis.php";
</script>
