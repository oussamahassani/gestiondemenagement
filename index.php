<?php

session_start ();

if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
	header('location: racine/index.php');
} else {
	header('location: login.php');
}
?>