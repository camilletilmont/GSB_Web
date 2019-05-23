<?php
include('./connecBDD.php');

$nom = $_POST['nom'];
$matricule = $_POST['matricule'];
try{
$bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
}catch(Exception $ex){
    echo '<body onLoad="alert(\'Problème Connexion à la BDD.\')">';
    echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

}

$req = $bdd->prepare('SELECT VIS_MATRICULE_VISITEUR FROM VISITEUR WHERE VIS_NOM_VISITEUR = :nom');
$req->execute(array('nom' => $nom));
$resultat = $req->fetch();


if(!$resultat){
  echo '<body onLoad="alert(\'Nom Inconnu.\')">';
  echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

}else if($matricule == $resultat['VIS_MATRICULE_VISITEUR']){
  session_start();
  $_SESSION['nom'] = $nom;
  $_SESSION['matricule']= $matricule;
  header('location:home.php');

}else{
  echo '<body onLoad="alert(\'Matricule Incorrect.\')">';
  echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';
}


?>
