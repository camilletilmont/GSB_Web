<?php
include('test_connecter.php');
include('connecBDD.php');
$id = $_GET['id'];


if($_SESSION['nom'] == 'Admin'){
  try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }


  try{


    $sql1 = $bdd->prepare("DELETE FROM POSSEDER WHERE PRA_NUM_PRATICIEN = :ident1");
    $sql1->bindParam(':ident1',$id);
    $sql1->execute();
    $sql1->closeCursor();
    try{
      $sql2 = $bdd->prepare("DELETE FROM PRATICIEN WHERE PRA_NUM_PRATICIEN = :ident2");
      $sql2->bindParam(':ident2',$id);
      $sql2->execute();
      $sql2->closeCursor();
    }catch(Exception $e){

      echo "Erreur ".$e->getMessage();

    }


  }catch(Exception $ex){

    echo "Erreur ".$ex->getMessage();

  }


}
header('location:home.php');

?>
