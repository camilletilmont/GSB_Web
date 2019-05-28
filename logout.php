<?php

//page realisant la destruction des informations de Sessions et de cookies lors de la déconnexion


//lance un test d'existence d'une session'
include('test_connecter.php');



//si la session actuelle a décroché on la réveille
if(!isset($_SESSION))
{
	session_start();
}

//mis à zéro et destruction des valeurs de sessions
$_SESSION = array();
unset($_SESSION["nom"]);
unset($_SESSION["matricule"]);
setcookie("nom", "", 1);
setcookie("matricule", "", 1);
session_destroy();


//redirection vers la page connexion
echo '<meta http-equiv="refresh" content="0.1;url=./connexion.php"/>';

 ?>
