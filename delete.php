<?php

//script php appelé pour l'effacement d'un praticien

//appel du test de l'existence d'une session
include('test_connecter.php');

//appel des informations pour la connexion à la BDD
include('connecBDD.php');


//récupération de l'id
$id = $_GET['id'];

//enclenche le script si la session est celle de l'Admin
if($_SESSION['nom'] == 'Admin'){
  try{

    //connexion à la BDD
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }



  //créaton et envoie de la requete pour effacer les références au praticien dans la table POSSEDER
  try{


    $sql1 = $bdd->prepare("DELETE FROM POSSEDER WHERE PRA_NUM_PRATICIEN = :ident1");
    $sql1->bindParam(':ident1',$id);
    $sql1->execute();

    //fermeture de la requete 1
    $sql1->closeCursor();

    //si la première requete est bonne, création et envoie de la requete pour effacer
    //le praticien
    try{
      $sql2 = $bdd->prepare("DELETE FROM PRATICIEN WHERE PRA_NUM_PRATICIEN = :ident2");
      $sql2->bindParam(':ident2',$id);
      $sql2->execute();

      //fermeture de la seconde requete
      $sql2->closeCursor();
    }catch(Exception $e){

      echo "Erreur ".$e->getMessage();

    }


  }catch(Exception $ex){

    echo "Erreur ".$ex->getMessage();

  }


}

//redirection vers l'accueil quoi qu'il arrive
header('location:home.php');

?>
