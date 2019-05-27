<?php
include('test_connecter.php');
include('connecBDD.php');
$nomAjout = htmlspecialchars(trim($_POST['nomAjout']));
$prenomAjout = htmlspecialchars(trim($_POST['prenomAjout']));
$adresseAjout = htmlspecialchars(trim($_POST['adresseAjout']));
$codeAjout = htmlspecialchars(trim($_POST['codeAjout']));
$villeAjout = htmlspecialchars(trim($_POST['villeAjout']));
$specialitesAjout = htmlspecialchars(trim($_POST['typeAjout']));


if($_SESSION['nom'] == 'Admin'){
  try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }


  try{
    $sqlTypeAdd = $bdd->prepare("SELECT TYP_CODE_TYPE_PRATICIEN as codeT FROM TYPE_PRATICIEN WHERE TYP_LIBELLE_TYPE_PRATICIEN = :type");
    $sqlTypeAdd->bindParam(':type',$specialitesAjout);
    $sqlTypeAdd->execute();

    foreach($sqlTypeAdd->fetchAll() as $row){
      $typeApresAjout = $row['codeT'];
    }

    try{
      $sqlAdd = $bdd->prepare("INSERT INTO PRATICIEN (PRA_NOM_PRATICIEN, PRA_PRENOM_PRATICIEN,
        PRA_ADRESSE_PRATICIEN, PRA_CP_PRATICIEN,PRA_VILLE_PRATICIEN, TYP_CODE_TYPE_PRATICIEN)
        VALUES (:nom, :prenom, :adresse, :codeP, :ville, :type);");
        $sqlAdd->bindParam(':nom',$nomAjout);
        $sqlAdd->bindParam(':prenom',$prenomAjout);
        $sqlAdd->bindParam(':adresse',$adresseAjout);
        $sqlAdd->bindParam(':codeP',$codeAjout);
        $sqlAdd->bindParam(':ville',$villeAjout);
        $sqlAdd->bindParam(':type',$typeApresAjout);
        $sqlAdd->execute();

        $sqlAdd->closeCursor();
      }catch(Exception $e){

        echo "Erreur ".$e->getMessage();
        echo "<br>erreur add";

      }

      $sqlTypeAdd->closeCursor();
    }catch(Exception $ex){

      echo "Erreur ".$ex->getMessage();

    }
  }

  header('location:home.php');

  ?>
