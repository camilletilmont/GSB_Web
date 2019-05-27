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


  try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
      echo "Erreur ".$ex->getMessage();

    }


  try{


    $sqlMod = $bdd->prepare("UPDATE PRATICIEN SET PRA_NOM_PRATICIEN = :nom, PRA_PRENOM_PRATICIEN = :prenom, PRA_ADRESSE_PRATICIEN = :adresse,
    PRA_CP_PRATICIEN = :codeP, PRA_VILLE_PRATICIEN = :ville WHERE PRA_NUM_PRATICIEN = :id");

    $sqlMod->bindParam(':nom',$nomModif);
    $sqlMod->bindParam(':prenom',$prenomModif);
    $sqlMod->bindParam(':adresse',$adresseModif);
    $sqlMod->bindParam(':codeP',$codeModif);
    $sqlMod->bindParam(':ville',$villeModif);
    $sqlMod->bindParam(':id',$idModif);


    $sqlMod->execute();




  }catch(Exception $e){

    echo "Erreur ".$e->getMessage();

  }


header('location:home.php');

?>
