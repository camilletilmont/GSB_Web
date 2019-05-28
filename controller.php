<?php

//page de control de l'identifiant et du matricule

//recupération des données de connexions pour la BDD
include('./connecBDD.php');


//récupération du nom et matricule envoyé par le formulaire de connexion
$nom = $_POST['nom'];
$matricule = $_POST['matricule'];



try{

//connexion à la BDD

  $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);

try{
  //preparation et envoi de la requette SQL pour récupérer le visiteur selon le Matricule
  //rentré
  $req = $bdd->prepare('SELECT VIS_NOM_VISITEUR FROM VISITEUR WHERE VIS_MATRICULE_VISITEUR = :mat');
  $req->bindParam(':mat',$matricule);
  $req->execute();
  $resultat = $req->fetch();

  //message si le Matricule n'a aucune correspondance dans la BDD
  if(!$resultat){
    echo '<body onLoad="alert(\'Matricule Inconnu.\')">';
    echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';


    // activation de la session et redirection vers la page principale si
    //le nom donné correspond à celui lié au matricule donné
  }else if($nom == $resultat['VIS_NOM_VISITEUR']){
    session_start();
    $_SESSION['nom'] = $nom;
    $_SESSION['matricule']= $matricule;
    header('location:home.php');

    //message d'erreur si le nom ne correspond pas à celui lié au matricule donné

  }else{
    echo '<body onLoad="alert(\'Nom Incorrect.\')">';
    echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';
  }

  //affichage d'erreurs si la requete envoyée est mauvaise
}catch(Exception $ex){
  echo "Erreur :".$ex->getMessage();

}

  //affichage d'un message si la connexion à la BDD ne se fait pas
}catch(Exception $ex){
  echo '<body onLoad="alert(\'Problème Connexion à la BDD.\')">';
  echo '<meta http-equiv="refresh" content="0;URL=connexion.php">';

}

?>
