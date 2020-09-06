<?php	
	include("connect.php");	
	
	$dem=$_POST['dem'];
    $date=$_POST['date'];
	$heure=$_POST['heure'];	
	$com=$_POST['commercial'];
	
	$remarque=$_POST['remarque'];
	
	$req2=mysql_query("insert into visite(date_visite,heure_visite,id_com,remarque_visite) values ('$date','$heure','$com','$remarque')");
	    
	
	if($req2)
	{echo "truee";}else
	{echo "false";}
   header('location: ../forms/insert_source.php?a=1');
?>	<script type="text/javascript">
document.location.href="../forms/insert_source.php?a=1";
</script>
*/
?>