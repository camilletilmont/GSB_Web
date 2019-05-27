<?php


$nom = htmlspecialchars(trim($_POST['nom'])).'%';
$prenom = htmlspecialchars(trim($_POST['prenom'])).'%';
$adresse = htmlspecialchars(trim($_POST['adresse'])).'%';
$departement = htmlspecialchars(trim($_POST['departement'])).'%';
$ville = htmlspecialchars(trim($_POST['ville'])).'%';
$specialites = htmlspecialchars(trim($_POST['specialites'])).'%';
$id = htmlspecialchars(trim($_GET['id']));


function affichage(&$n,&$p,&$a,&$d,&$v,&$s){
  include('connecBDD.php');

  try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }

  try{
    $sql = $bdd->prepare("SELECT PRA_NUM_PRATICIEN as id, PRA_NOM_PRATICIEN as nom,PRA_PRENOM_PRATICIEN as prenom, PRA_ADRESSE_PRATICIEN as adresse,
      PRA_CP_PRATICIEN as codePostal,PRA_VILLE_PRATICIEN as ville,TYP_LIBELLE_TYPE_PRATICIEN as type  FROM PRATICIEN P,
      TYPE_PRATICIEN TP WHERE P.TYP_CODE_TYPE_PRATICIEN = TP.TYP_CODE_TYPE_PRATICIEN AND PRA_NOM_PRATICIEN LIKE :nom
      AND PRA_PRENOM_PRATICIEN LIKE :prenom AND PRA_ADRESSE_PRATICIEN LIKE :adresse AND PRA_CP_PRATICIEN LIKE :code
      AND PRA_VILLE_PRATICIEN LIKE :ville AND TYP_LIBELLE_TYPE_PRATICIEN LIKE :type ORDER BY id DESC LIMIT 30");
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
        echo "<th name=".$row['id'].">";
        if($_SESSION['nom'] == 'Admin'){
        echo '<button class="btn btn-outline-danger col-lg-12" onclick="conf('.$row['id'].')" >Supprimer</button> ';
        echo '<button class="btn btn-outline-success col-lg-12"  onclick="mod('.$row['id'].')" >Modifier</a> ';
        }
        echo "</th>";
        echo "</tr>";


      }
    }catch(Exception $ex){

      echo "Erreur ".$ex->getMessage();

    }
  }


  function affichageModif(&$id){
    include('connecBDD.php');
    if($_SESSION['nom'] == 'Admin'){
    try{
      $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $ex){
      echo "Erreur ".$ex->getMessage();

    }

    try{
      $sql = $bdd->prepare("SELECT PRA_NUM_PRATICIEN as id, PRA_NOM_PRATICIEN as nom,PRA_PRENOM_PRATICIEN as prenom, PRA_ADRESSE_PRATICIEN as adresse,
        PRA_CP_PRATICIEN as codePostal,PRA_VILLE_PRATICIEN as ville,TYP_LIBELLE_TYPE_PRATICIEN as type  FROM PRATICIEN P,
        TYPE_PRATICIEN TP WHERE P.TYP_CODE_TYPE_PRATICIEN = TP.TYP_CODE_TYPE_PRATICIEN AND PRA_NUM_PRATICIEN LIKE :id;");
        $sql->bindParam(':id',$id);
        $sql->execute();

        foreach ($sql->fetchAll() as $row){

          echo '<form method="post" action="modification.php?id='.$row['id'].'" >';
          echo "<tr>";
          echo "<th>";
          echo '<div class="mt-10">';
          echo '<input style="border-color : green;" type="text" name="nomModif" id="nom" value="'.$row['nom'].'" pattern="^[A-Za-z\s]{3,25}$" class="form-control" maxlength="25" required >';
          echo "</div>";
          echo "</th>";
          echo "<th>";
          echo '<div class="mt-10">';
          echo '<input style="border-color : green;" type="text" name="prenomModif" pattern="^[A-Za-z\s]{3,25}$" id="prenom" value="'.$row['prenom'].'" maxlength="25" class="form-control" required>';
          echo "</div>";
          echo "</th>";
          echo "<th>";
          echo '<div class="mt-10">';
          echo '<input style="border-color : green;" type="text" name="adresseModif" pattern="^[0-9]{0,4},\s[A-Za-z\s]{3,98}$" id="adresse" value="'.$row['adresse'].'"  class="form-control" maxlength="100" required>';
          echo "</div>";
          echo "</th>";
          echo "<th>";
          echo '<div class="mt-10">';
          echo '<input  style="border-color : green;" type="text"  name="codeModif" pattern="^[0-9]{5,5}$" id="code" value="'.$row['codePostal'].'"  class="form-control" maxlength="5" required>';
          echo "</div>";
          echo "</th>";
          echo "<th>";
          echo '<div class="mt-10">';
          echo '<input style="border-color : green;" type="text" name="villeModif" pattern="^[A-Za-z\s]{3,45}$" id="ville" value="'.$row['ville'].'"  class="form-control" maxlength="45" required>';
          echo "</div>";
          echo "</th>";
          echo "<th>";
          echo '<div class="mt-10">';
          echo '<input style="border-color : green;" type="text" name="typeModif" id="type" value="'.$row['type'].'"  class="form-control">';
          echo "</div>";
          echo "</th>";
          echo "<th>";
          echo '<div class="mt-10">';
          echo '<button id="buttonVal" class="btn btn-outline-success col-lg-12">Valider</button> ';
          echo "</div>";
          echo "</th>";
          echo "</tr>";
          echo "</form>";


        }
      }catch(Exception $ex){

        echo "Erreur ".$ex->getMessage();

      }
    }else{
      header('location:home.php');

    }
    }


  ?>
