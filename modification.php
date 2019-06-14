<?php

//script php appelé pour la modification


//appel du test de l'existence d'une session
include('test_connecter.php');

//appel des informations pour la connexion à la BDD
include('connecBDD.php');


//recupératiion des données POST et GET envoyé par le formulaire de la page modification
$nomModif = htmlspecialchars(trim($_POST['nomModif']));
$prenomModif = htmlspecialchars(trim($_POST['prenomModif']));
$adresseModif = htmlspecialchars(trim($_POST['adresseModif']));
$codeModif = htmlspecialchars(trim($_POST['codeModif']));
$villeModif = htmlspecialchars(trim($_POST['villeModif']));
$specialitesModif = htmlspecialchars(trim($_POST['typeModif']));
$tarifModif = htmlspecialchars(trim($_POST['tarifModif']));
$idModif = htmlspecialchars(trim($_GET['id']));


//enclenche le script si la session est celle de l'Admin
if($_SESSION['nom'] == 'Admin'){

  //connexion à la BDD
  try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }


  //création et envoie de la requete de selection du type de praticien par son libellé que l'on a dans le formulaire
  try{
    $sqlType = $bdd->prepare("SELECT TYP_CODE_TYPE_PRATICIEN as codeT FROM TYPE_PRATICIEN WHERE TYP_LIBELLE_TYPE_PRATICIEN = :type");
    $sqlType->bindParam(':type',$specialitesModif);
    $sqlType->execute();


    //récupération de l'id du type de praticien pour la référence dans la table praticien
    foreach($sqlType->fetchAll() as $row){
      $typeApresModif = $row['codeT'];
    }
    
    //création et envoie de la requete de selection du tarif par son libellé que l'on a dans le formulaire
    try{
      $sqlTarif = $bdd->prepare("SELECT TAR_CODE_TARIF as codeTarif FROM TARIF WHERE TAR_LIBELLE_TARIF = :tarif");
      $sqlTarif->bindParam(':tarif',$tarifModif);
      $sqlTarif->execute();

      //récupération de l'id du tarif
      foreach($sqlTarif->fetchAll() as $row){
        $tarifApresModif = $row['codeTarif'];
      }


    try{

      //création et envoie de la requete de modification avec la récupération des données envoyées par le formulaire
      $sqlMod = $bdd->prepare("UPDATE PRATICIEN SET PRA_NOM_PRATICIEN = :nom, PRA_PRENOM_PRATICIEN = :prenom, PRA_ADRESSE_PRATICIEN = :adresse,
        PRA_CP_PRATICIEN = :codeP, PRA_VILLE_PRATICIEN = :ville, TYP_CODE_TYPE_PRATICIEN = :type, TAR_CODE_TARIF = :tarif WHERE PRA_NUM_PRATICIEN = :id");

        $sqlMod->bindParam(':nom',$nomModif);
        $sqlMod->bindParam(':prenom',$prenomModif);
        $sqlMod->bindParam(':adresse',$adresseModif);
        $sqlMod->bindParam(':codeP',$codeModif);
        $sqlMod->bindParam(':ville',$villeModif);
        $sqlMod->bindParam(':type',$typeApresModif);
        $sqlMod->bindParam(':tarif',$tarifApresModif);
        $sqlMod->bindParam(':id',$idModif);



        $sqlMod->execute();


        //fermeture de la requete de modification
        $sqlMod->closeCursor();
      }catch(Exception $e){

        echo "Erreur ".$e->getMessage();

      }

      //fermeture de la requete de selection d'id du tarif
      $sqlTarif->closeCursor();
    }catch(Exception $e){

      echo "Erreur ".$e->getMessage();
      echo "<br>erreur add";

    }


      //fermeture de la requete de récupération d'id du type de praticien
      $sqlType->closeCursor();
    }catch(Exception $ex){

      echo "Erreur ".$ex->getMessage();

    }

  }

  //redirection vers l'accueil quoi qu'il arrive
  header('location:home.php');

  ?>
