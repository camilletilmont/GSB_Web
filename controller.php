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

$req = $bdd->prepare('SELECT VIS_NOM_VISITEUR FROM VISITEUR WHERE VIS_MATRICULE_VISITEUR = :mat');
$req->bindParam(':mat',$matricule);
$req->execute();
$resultat = $req->fetch();


if(!$resultat){
  echo '<body onLoad="alert(\'Matricule Inconnu.\')">';
  echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

}else if($nom == $resultat['VIS_NOM_VISITEUR']){
  session_start();
  $_SESSION['nom'] = $nom;
  $_SESSION['matricule']= $matricule;
  header('location:home.php');

}else{
  echo '<body onLoad="alert(\'Nom Incorrect.\')">';
  echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';
}


?>
