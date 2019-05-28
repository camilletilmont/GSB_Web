<?php

//functions php permettant l'affichage des listes après des requetes sql


//recupératiion des données POST et GET
$nom = htmlspecialchars(trim($_POST['nom'])).'%';
$prenom = htmlspecialchars(trim($_POST['prenom'])).'%';
$adresse = htmlspecialchars(trim($_POST['adresse'])).'%';
$departement = htmlspecialchars(trim($_POST['departement'])).'%';
$ville = htmlspecialchars(trim($_POST['ville'])).'%';
$specialites = htmlspecialchars(trim($_POST['specialites'])).'%';
$id = htmlspecialchars(trim($_GET['id']));


//function d'affichage de la page d'acceuil

function affichage($n,$p,$a,$d,$v,$s){

  //récupération des données de connexion à la BDD
  include('connecBDD.php');


  //connexion à la BDD
  try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $ex){
    echo "Erreur ".$ex->getMessage();

  }
  //préparation et envoi de la requete SQL pour afficher les praticiens en partant du dernier ajouté à la BDD
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


      //affichage et mise en forme dans le tableau de la page d'acceuil de la liste récupérée
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

        //affichage des boutons de modifications de chaque ligne du tableau uniquement sur c'est
        //le compte Admin qui est enclenché
        if($_SESSION['nom'] == 'Admin'){
          echo '<button class="btn btn-outline-danger col-lg-12" onclick="conf('.$row['id'].')" >Supprimer</button> ';
          echo '<button class="btn btn-outline-success col-lg-12"  onclick="mod('.$row['id'].')" >Modifier</a> ';
        }
        echo "</th>";
        echo "</tr>";


      }

      //fermeture de la requete
      $sql->closeCursor();
    }catch(Exception $ex){

      echo "Erreur ".$ex->getMessage();

    }


  }

  //function d'affichage pour la page modification qui récupère l'id de la ligne selectionnée
  //à la page d'acceuil
  function affichageModif(&$id){

    //récupération des données de connexion à la BDD
    include('connecBDD.php');

    //vérification que la session est bien celle de l'admin
    if($_SESSION['nom'] == 'Admin'){



      //connexion à la BDD
      try{
        $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }catch(Exception $ex){
        echo "Erreur ".$ex->getMessage();

      }
      //préparation et envoie de la requete sql afin de récupérer les données du praticien
      // dont l'id a été passé en paramètre
      try{
        $sqlGen = $bdd->prepare("SELECT PRA_NUM_PRATICIEN as id, PRA_NOM_PRATICIEN as nom,PRA_PRENOM_PRATICIEN as prenom, PRA_ADRESSE_PRATICIEN as adresse,
          PRA_CP_PRATICIEN as codePostal,PRA_VILLE_PRATICIEN as ville,TYP_LIBELLE_TYPE_PRATICIEN as type  FROM PRATICIEN P,
          TYPE_PRATICIEN TP WHERE P.TYP_CODE_TYPE_PRATICIEN = TP.TYP_CODE_TYPE_PRATICIEN AND PRA_NUM_PRATICIEN LIKE :id;");
          $sqlGen->bindParam(':id',$id);
          $sqlGen->execute();


          //récupération et affichage des données du praticien selectionné à la page d'acceuil
          //Affichage des données dans des inputs afin de pouvoir les Modifier
          //verification par regex pour chaque input
          //et création du bouton afin de validier les modificiations. Il appelera modification.php
          foreach ($sqlGen->fetchAll() as $row){

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
            echo "<th style=\"width: 16.66%\">";
            echo '<div class="mt-10">';
            echo '<select style="border-color : green;" class="form-control" name="typeModif">';
            echo selectSpe($row['type']);
            echo '</select>';
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
          //fermeture de la requete
          $sqlGen->closeCursor();

          //affichage d'erreur si la requete n'est pas bonne
        }catch(Exception $ex){

          echo "Erreur ".$ex->getMessage();

        }

        //redirection si l'utilisateur n'est pas Admin
      }else{
        header('location:home.php');

      }
    }

      //function permettant d'afficher un select regroupant toutes las valeurs existantes
      //de type de praticien (qu'on appelera Spécialité ici) de la BDD
      function selectSpe(&$default){

        //recupération informations de connexions a la BDD
        include('connecBDD.php');


        //connexion à la BDD
        try{
          $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
          $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          //message si erreur de connexion
        }catch(Exception $ex){
          echo "Erreur ".$ex->getMessage();

        }


        //préparation et envoie de la requete SQL afin de récupérer les libellés de tous les types de praticiens
        try{
          $sqlSel = $bdd->prepare("SELECT TYP_LIBELLE_TYPE_PRATICIEN as lib FROM TYPE_PRATICIEN ORDER BY TYP_LIBELLE_TYPE_PRATICIEN ASC");
          $sqlSel->execute();

          //récupération des données de la requéte et mise en forme
          foreach ($sqlSel->fetchAll() as $row){
            if($row['lib'] == $default){
              //valeur selectionnée par défaut lorsqu'elle correspont à la valeur existante pour un praticien
              //selectionné dans la BDD
              echo '<option value="'.$row['lib'].'" selected>'.$row['lib'].'</option><br>';

            }else{
              echo '<option value="'.$row['lib'].'">'.$row['lib'].'</option><br>';
            }
          }

          //fermeture de la requete
          $sqlSel->closeCursor();

          //message d'erreur si la requete est mauvaise
        }catch(Exception $e){
          echo "Erreur ".$e->getMessage();

        }

      }


      ?>
