<?php
include('test_connecter.php');
include('connecBDD.php');

$nomModif = htmlspecialchars(trim($_POST['nomModif']));
$prenomModif = htmlspecialchars(trim($_POST['prenomModif']));
$adresseModif = htmlspecialchars(trim($_POST['adresseModif']));
$codeModif = htmlspecialchars(trim($_POST['codeModif']));
$villeModif = htmlspecialchars(trim($_POST['villeModif']));
$specialitesModif = htmlspecialchars(trim($_POST['typeModif']));
$idModif = htmlspecialchars(trim($_GET['id']));


if($_SESSION['nom'] == 'Admin'){

  try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }



  try{
    $sqlType = $bdd->prepare("SELECT TYP_CODE_TYPE_PRATICIEN as codeT FROM TYPE_PRATICIEN WHERE TYP_LIBELLE_TYPE_PRATICIEN = :type");
    $sqlType->bindParam(':type',$specialitesModif);
    $sqlType->execute();

    foreach($sqlType->fetchAll() as $row){
      $typeApresModif = $row['codeT'];
    }



    try{


      $sqlMod = $bdd->prepare("UPDATE PRATICIEN SET PRA_NOM_PRATICIEN = :nom, PRA_PRENOM_PRATICIEN = :prenom, PRA_ADRESSE_PRATICIEN = :adresse,
        PRA_CP_PRATICIEN = :codeP, PRA_VILLE_PRATICIEN = :ville, TYP_CODE_TYPE_PRATICIEN = :type WHERE PRA_NUM_PRATICIEN = :id");

        $sqlMod->bindParam(':nom',$nomModif);
        $sqlMod->bindParam(':prenom',$prenomModif);
        $sqlMod->bindParam(':adresse',$adresseModif);
        $sqlMod->bindParam(':codeP',$codeModif);
        $sqlMod->bindParam(':ville',$villeModif);
        $sqlMod->bindParam(':type',$typeApresModif);
        $sqlMod->bindParam(':id',$idModif);


        $sqlMod->execute();



        $sqlMod->closeCursor();
      }catch(Exception $e){

        echo "Erreur ".$e->getMessage();

      }
      $sqlType->closeCursor();
    }catch(Exception $ex){

      echo "Erreur ".$ex->getMessage();

    }

  }
  header('location:home.php');

  ?>
