<?php

$query_get_status_parameter = "
	SELECT id, valeur 
	FROM `masterParametreValeur` mpv
	WHERE idMasterParametre = 11
";
$con 				= mysql_connect($SERVER,$USERNAME,$PASSWORD);
// associationTypeService
// client

?>