<?php

$query_user_logged = "
	SELECT id_utilisateur, nom, prenom, email, login, civilite
	FROM utilisateur
	WHERE 
		id_utilisateur = " . $_SESSION['id'] . "
	ORDER BY id_utilisateur DESC
	LIMIT 1
";
$con 				= mysql_connect($SERVER,$USERNAME,$PASSWORD);



// associationTypeService
// client

?>