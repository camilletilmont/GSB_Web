<?php


$nom = htmlspecialchars(trim($_POST['nom'])).'%';
$prenom = htmlspecialchars(trim($_POST['prenom'])).'%';
$adresse = htmlspecialchars(trim($_POST['adresse'])).'%';
$departement = htmlspecialchars(trim($_POST['departement'])).'%';
$ville = htmlspecialchars(trim($_POST['ville'])).'%';
$specialites = htmlspecialchars(trim($_POST['specialites'])).'%';

function affichage(&$n,&$p,&$a,&$d,&$v,&$s){
  include('connecBDD.php');

  try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }

  try{
    $sql = $bdd->prepare("SELECT PRA_NOM_PRATICIEN as nom,PRA_PRENOM_PRATICIEN as prenom, PRA_ADRESSE_PRATICIEN as adresse,
      PRA_CP_PRATICIEN as codePostal,PRA_VILLE_PRATICIEN as ville,TYP_LIBELLE_TYPE_PRATICIEN as type  FROM PRATICIEN P,
      TYPE_PRATICIEN TP WHERE P.TYP_CODE_TYPE_PRATICIEN = TP.TYP_CODE_TYPE_PRATICIEN AND PRA_NOM_PRATICIEN LIKE :nom
      AND PRA_PRENOM_PRATICIEN LIKE :prenom AND PRA_ADRESSE_PRATICIEN LIKE :adresse AND PRA_CP_PRATICIEN LIKE :code
      AND PRA_VILLE_PRATICIEN LIKE :ville AND TYP_LIBELLE_TYPE_PRATICIEN LIKE :type ORDER BY nom ASC LIMIT 30");
      $sql->bindParam(':nom',$n);
      $sql->bindParam(':prenom',$p);
      $sql->bindParam(':adresse',$a);
      $sql->bindParam(':code',$d);
      $sql->bindParam(':ville',$v);
      $sql->bindParam(':type',$s);
      $sql->execute();

      foreach ($sql->fetchAll() as $row){


        echo "<tr>";
        echo "<th>";
        echo $row['nom'];
        echo "</th>";
        echo "<th>";
        echo $row['prenom'];
        echo "</th>";
        echo "<th>";
        echo $row['adresse'];
        echo "</th>";
        echo "<th>";
        echo $row['codePostal'];
        echo "</th>";
        echo "<th>";
        echo $row['ville'];
        echo "</th>";
        echo "<th>";
        echo $row['type'];
        echo "</th>";
        echo "<th>";
        if($_SESSION['nom'] == 'Admin'){
        echo '<a class="btn btn-danger col-lg-12" href="ajoutPraticien.php" role="button">Supprimer</a> ';
        echo '<a class="btn btn-warning col-lg-12" href="ajoutPraticien.php" role="button">Modifier</a> ';
        }
        echo "</th>";
        echo "</tr>";


      }
    }catch(Exception $ex){

      echo "Erreur ".$ex->getMessage();

    }
  }





  ?>
