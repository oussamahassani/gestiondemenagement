<?php

	
			// connection au serveur

			require_once '../../connect.php';

			$email=$_GET["emailClient"];
			$id_client=$_GET["id_client"];
			
            if ($id_client =="")
			$req1=mysql_query("select * from client where emailClientB2B='".$email."'  OR email='".$email."'"); 
			else 
			$req1=mysql_query("select * from client where (emailClientB2B='".$email."'  OR email='".$email."') AND id_client !='".$id_client ."'"); 
			
			if ($result1=mysql_fetch_array($req1))
			{
			  echo("Id client : ".$result1['id_client']." - Nom : ".$result1['nom']." ".$result1['prenom']." ".$result1['raisonSociale']);
			}
			
			
?>
