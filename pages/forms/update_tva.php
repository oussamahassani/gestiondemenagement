	<?php	
	session_start (); 
	include("connect.php");	
	
	$tva=$_POST['tva'];
    $id_admin=$_SESSION['id'];
	
	  $req=mysql_query("UPDATE parametre SET tva='$tva',id_admin_par='$id_admin'
	
	where id_param='1'");  
	
	if($req)
	{echo "truee";}else
	{echo "false";}
   header('location: tva.php?a=1');
?>	<script type="text/javascript">
document.location.href="tva.php?a=1";
</script>
