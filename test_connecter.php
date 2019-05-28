<?php

	//script php permettant de vérifier si l'utilisateur est connecté,
	//s'il ne l'est pas alors il est redirigé vers la page de connexion.

	//vérifie si une session existe, au cas ou l'actuel se serait endormie elle la réveille
	if(!isset($_SESSION))
	{
		session_start();
	}
	//Si il n'y a pas de session active (et donc pas de valeur associé à la clé 'nom')
	//alors redirection vers la page de connexion
	if (!(isset($_SESSION["nom"])))
	{
		echo '<script>window.location.replace("./connexion.php");</script>';
		exit();
	}
?>
