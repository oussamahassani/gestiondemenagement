<?php
//param�tres de la base de donn�es 
//serveur mysql

$SERVER='localhost';
$USERNAME='root';
$PASSWORD='';
$BASENAME='superdemsxbase1';
/*
$SERVER='superdemsxbase1.mysql.db';
$USERNAME='superdemsxbase1';
$PASSWORD='Assistline2020';
$BASENAME='superdemsxbase1';
*/
//connexion au serveur Mysql
mysql_connect($SERVER,$USERNAME,$PASSWORD).
//selection de la BD
mysql_select_db($BASENAME);
?>
