<?php
//page de modification

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
  <title>Modification</title>

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

          <!-- Boutton d'annulation pour retourner à l'accueil-->
          <a class="btn btn-outline-info col-lg-2" href="home.php" role="button">Annuler</a>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row d-flex pt-50">

        <!-- Creation tableau formulaire pour récupérer les informations pour la modification d'un praticien-->


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

          </form>
          <tbody>
            <?php
            //affichage du praticien selectionné dans la page d'accueil par son id
            affichageModif($id);

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
