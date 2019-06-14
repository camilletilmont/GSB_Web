<?php

//page d'ajout d'un praticien

//appel du test de l'existence d'une session
include('test_connecter.php');

//appel le fichier php afin d'afficher les valeurs du tableaux
include('listAffichage.php');
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/fav.png">
  <!-- Author Meta -->
  <meta name="author" content="colorlib">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <!-- Site Title -->
  <title>Ajout</title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
  <!--
  CSS
  ============================================= -->
  <link rel="stylesheet" href="css/linearicons.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/main.css">
  <script type="text/javascript">


  //permet sous safari de recharger la page si on fait retour après la déconnexion
  window.onpageshow = function(event) {
    if (event.persisted) {
      window.location.reload() ;
    }
  };


</script>
</head>

<body onload="">
  <section>
    <div class="container">
      <div class="row d-flex pt-20">
        <div class="col-lg-12">
          <div class="title text-center">
            <h2>Liste de Praticiens</h2>
          </div>
          <div class="d-flex col-lg-2"><?php  "<br>Session : ".$_SESSION['nom']."<br><br>"; ?></div>
        </div>
      </div>
    </div>
  </section>


  <section class="bg-light">
    <div class="container">
      <div class="row d-flex pt-50">
        <div class="d-flex justify-content-between col-lg-12">
          <a class="btn btn-outline-info col-lg-2" href="home.php" role="button">Annuler</a>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row d-flex pt-50">

        <!-- Creation tableau formulaire pour récupérer les informations pour la création d'un praticien-->


        <!-- Header tableau-->
        <table class="table table-striped border border-dark">
          <form method="post" action="home.php" >
            <thead class="bg-dark text-white">
              <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Departement</th>
                <th scope="col">Ville</th>
                <th scope="col">Specialités</th>
                <th scope="col">Tarifs</th>
                <th ></th>
              </tr>
            </thead>


            <!-- formulaire tableau avec des insert avec des regles pour les infos à récupérer-->
          </form>
          <tbody>
            <form method="post" action="ajout.php">
              <tr>
                <th>
                  <div class="mt-10">
                    <input style="border-color : green;" type="text" placeholder="Asimov Korov" onfocus="this.placeholder = ''" name="nomAjout" id="nom" pattern="^[A-Za-z\s]{3,25}$" class="form-control" maxlength="25" required >
                  </div>
                </th>
                <th>
                  <div class="mt-10">
                    <input style="border-color : green;" type="text" placeholder="Isaac Aris" onfocus="this.placeholder = ''" name="prenomAjout" pattern="^[A-Za-z\s]{3,25}$" id="prenom" maxlength="25" class="form-control" required>
                  </div>
                </th>
                <th>
                  <div class="mt-10">
                    <input style="border-color : green;" type="text" placeholder="22, rue machin" onfocus="this.placeholder = ''" name="adresseAjout" pattern="^[0-9]{0,4},\s[A-Za-z\s]{3,98}$" id="adresse" class="form-control" maxlength="100" required>
                  </div>
                </th>
                <th>
                  <div class="mt-10">
                    <input  style="border-color : green;" type="text"  placeholder="35860" onfocus="this.placeholder = ''" name="codeAjout" pattern="^[0-9]{5,5}$" id="code" class="form-control" maxlength="5" required>
                  </div>
                </th>
                <th>
                  <div class="mt-10">
                    <input style="border-color : green;" type="text" placeholder="Saint Marcin" onfocus="this.placeholder = ''" name="villeAjout" pattern="^[A-Za-z\s]{3,45}$" id="ville" class="form-control" maxlength="45" required>
                  </div>
                </th>
                <th style="width: 16.66%">
                  <div class="mt-10">
                    <select style="border-color : green;" class="form-control" name="typeAjout" required>
                      <?php
                      //remplissage du select des spécialités par les spécialités existantes dans la bdd

                      selectSpe($unkown); ?>
                    </select>
                  </div>
                </th>
                <th style="width: 16.66%">
                  <div class="mt-10">
                    <select style="border-color : green;" class="form-control" name="tarifAjout" required>
                      <?php
                      //remplissage du select des tarifs par les tarifs existantes dans la bdd

                      selectTarif($unkown); ?>
                    </select>
                  </div>
                </th>
                <th>
                  <div class="mt-10">

                    <!-- Boutton validation du formulaire qui envoi les informations vers le fichier ajout.php-->
                    <button id="buttonVal" class="btn btn-outline-success col-lg-12">Valider</button>
                  </div>
                </th>
              </tr>
            </form>

          </tbody>
        </table>
      </div>
    </div>
  </section>



  <br>
  <br>
</body>
</html>
