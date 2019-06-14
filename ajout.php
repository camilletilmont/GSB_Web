<?php

//script php appelé pour l'ajout d'un praticien

//appel du test de l'existence d'une session
include('test_connecter.php');

//appel des informations pour la connexion à la BDD
include('connecBDD.php');

//recupératiion des données POST et GET envoyé par le formulaire de la page d'ajout
$nomAjout = htmlspecialchars(trim($_POST['nomAjout']));
$prenomAjout = htmlspecialchars(trim($_POST['prenomAjout']));
$adresseAjout = htmlspecialchars(trim($_POST['adresseAjout']));
$codeAjout = htmlspecialchars(trim($_POST['codeAjout']));
$villeAjout = htmlspecialchars(trim($_POST['villeAjout']));
$specialitesAjout = htmlspecialchars(trim($_POST['typeAjout']));
$tarifAjout = htmlspecialchars(trim($_POST['tarifAjout']));

//enclenche le script si la session est celle de l'Admin
if($_SESSION['nom'] == 'Admin'){
  try{

    //connexion à la BDD
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }

  //création et envoie de la requete pour avoir l'id du type de praticien par rapport à son libellé
  try{
    $sqlTypeAdd = $bdd->prepare("SELECT TYP_CODE_TYPE_PRATICIEN as codeT FROM TYPE_PRATICIEN WHERE TYP_LIBELLE_TYPE_PRATICIEN = :type");
    $sqlTypeAdd->bindParam(':type',$specialitesAjout);
    $sqlTypeAdd->execute();

    //récupération de l'id de type praticien
    foreach($sqlTypeAdd->fetchAll() as $row){
      $typeApresAjout = $row['codeT'];
    }

    //création et envoie de la requete pour avoir l'id du tarif par rapport à son libellé
    try{
      $sqlTarifAdd = $bdd->prepare("SELECT TAR_CODE_TARIF as codeTarif FROM TARIF WHERE TAR_LIBELLE_TARIF = :tarif");
      $sqlTarifAdd->bindParam(':tarif',$tarifAjout);
      $sqlTarifAdd->execute();

      //récupération de l'id de type praticien
      foreach($sqlTarifAdd->fetchAll() as $row){
        $tarifApresAjout = $row['codeTarif'];
      }


      //création et envoie de la requete d'insertion d'un nouveau praticien
      try{
        $sqlAdd = $bdd->prepare("INSERT INTO PRATICIEN (PRA_NOM_PRATICIEN, PRA_PRENOM_PRATICIEN,
          PRA_ADRESSE_PRATICIEN, PRA_CP_PRATICIEN,PRA_VILLE_PRATICIEN, TYP_CODE_TYPE_PRATICIEN, TAR_CODE_TARIF)
          VALUES (:nom, :prenom, :adresse, :codeP, :ville, :type, :tarif);");
          $sqlAdd->bindParam(':nom',$nomAjout);
          $sqlAdd->bindParam(':prenom',$prenomAjout);
          $sqlAdd->bindParam(':adresse',$adresseAjout);
          $sqlAdd->bindParam(':codeP',$codeAjout);
          $sqlAdd->bindParam(':ville',$villeAjout);
          $sqlAdd->bindParam(':type',$typeApresAjout);
          $sqlAdd->bindParam(':tarif',$tarifApresAjout);
          $sqlAdd->execute();


          //fermeture de la reuqte d'ajout d'un praticien
          $sqlAdd->closeCursor();
        }catch(Exception $e){

          echo "Erreur ".$e->getMessage();
          echo "<br>erreur add";

        }

        //fermeture de la requete de selection d'id du tarif
        $sqlTarifAdd->closeCursor();
      }catch(Exception $e){

        echo "Erreur ".$e->getMessage();
        echo "<br>erreur add";

      }

    //fermeture de la requete de selection d'id du type de praticien
    $sqlTypeAdd->closeCursor();
  }catch(Exception $ex){

    echo "Erreur ".$ex->getMessage();

  }
}
//redirection quoi qu'il arrive vers l'accueil
header('location:home.php');

?>
