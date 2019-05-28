<?php
//page d'accueil après la connexion

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
  <title>Menu</title>

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


  //permet à la page de se recharger automatiquement si elle persiste dans le cache
  //permet sous safari de recharger si on fait retour après la déconnexion
  window.onpageshow = function(event) {
    if (event.persisted) {
      window.location.reload() ;
    }
  };


  //popup de confirmation avant la suppression avec l'id du praticien visé en paramètre
  function conf(id){

    if (window.confirm("Voulez vous vraiment supprimer ?")) {
      window.location.replace('delete.php?id='+id);
    }
  }


  //appel de la page de modification avec l'id du praticien visé en paramètre
  function mod(id){

    window.location.replace('modifPage.php?id='+id);

  }

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
          <div class="d-flex col-lg-2"><?php echo "<br>Session : ".$_SESSION['nom']."<br><br>"; ?></div>

        </div>
      </div>
    </div>
  </section>


  <section class="bg-light">
    <div class="container">
      <div class="row d-flex pt-50">
        <div class="d-flex justify-content-between col-lg-12">

          <!-- Affichage du boutton d'ajout praticien si la session est celle de Admin-->
          <?php if($_SESSION['nom'] == 'Admin'){
          echo '<a class="btn btn-outline-info col-lg-2" href="addPage.php" role="button">Ajouter un Praticien</a>';
        }?>
          <a class="btn btn-outline-danger col-lg-2 ml-auto" href="logout.php" role="button">Deconnexion</a>
        </div>
      </div>
    </div>



    <div class="container">
      <div class="row d-flex pt-50">

        <!-- Affichage de l'ossature du tableau avec le nom des colonnes et les champs de recherche pour l'envoi en formulaire-->

        <table class="table table-striped border border-dark">
          <form method="post" action="home.php" >
            <thead class="bg-dark text-white">
              <tr>
                <th scope="col">Nom<div class="mt-10">
                  <input type="text" name="nom" placeholder="Nom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom'"  class="single-input">
                </div></th>
                <th scope="col">Prenom<div class="mt-10">
                  <input type="text" name="prenom" placeholder="Prenom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Prenom'"  class="single-input">
                </div></th>
                <th scope="col">Adresse<div class="mt-10">
                  <input type="text" name="adresse" placeholder="Adresse" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Adresse'"  class="single-input">
                </div></th>
                <th scope="col">Departement<div class="mt-10">
                  <input type="text" name="departement" placeholder="Département" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Département'" class="single-input">
                </div></th>
                <th scope="col">Ville<div class="mt-10">
                  <input type="text" name="ville" placeholder="Ville" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ville'"  class="single-input">
                </div></th>
                <th style="width: 16.66%" scope="col">Specialités<div class="mt-10">
                  <select class="form-control" name="specialites">
                    <option value=""></option>
                    <?php
                    //appel de la function d'affichage des spécialités pour le select de recherche des spés
                    selectSpe($unknow); ?>
                  </select>
                </div></th>
                <th ><button class="btn btn-info" >Rechercher</button> </th>
              </tr>
            </thead>

          </form>
          <tbody>
            <?php
            //affichage de la liste des praticiens avec les paramètres vide à la connexion
            //puis avec les paramètres souhaités pour chaque recherche
            affichage($nom,$prenom,$adresse,$departement,$ville,$specialites);

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>



  <br>
  <br>
</body>
</html>
