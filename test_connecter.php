<?php
	//Permet de vérifier si l'utilisateur est connecté, s'il ne l'est pas alors il est redirigé vers la page de connexion.
	if(!isset($_SESSION))
	{
		session_start();
	}
	if (!(isset($_SESSION["nom"])))
	{
		echo "Vous devez être connecté pour faire cela !<br>";
		echo "Redirection automatique vers la <a href='./connexion.php'>page de connexion</a>";
		echo '<script>window.location.replace("./connexion.php");</script>';
		exit();
	}
?>
