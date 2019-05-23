<?php
include('test_connecter.php');

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
     window.onpageshow = function(event) {
         if (event.persisted) {
             window.location.reload() ;
         }
     };
</script>
</head>

     <body onload="">
       <div class="container bg-ligth">
         <div class="row d-flex pt-20">
           <div class="col-lg-4">
             <h2>Liste de Praticiens</h2>
           </div>
           <div class="col-lg-4 ml-auto">
           <a class="btn btn-info" href="ajoutPraticien.php" role="button">Ajouter un Praticien</a>
           <a class="btn btn-dark" href="logout.php" onsubmit="" role="button">Deconnection</a>
         </div>
     </div>
     <div class="row pt-20">
       <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Adresse</th>
      <th scope="col">Departement</th>
      <th scope="col">Ville</th>
      <th scope="col">Specialités</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include('connecBDD.php');

    function affichage(){
    try{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $passwd);
    }catch(Exception $ex){
        echo "Erreur ".$ex->getMessage();

    }

    $sql = "SELECT PRA_NOM_PRATICIEN as nom,PRA_PRENOM_PRATICIEN as prenom, PRA_ADRESSE_PRATICIEN as adresse,
    PRA_CP_PRATICIEN as codePostal,PRA_VILLE_PRATICIEN as ville,TYP_LIBELLE_TYPE_PRATICIEN as type  FROM PRATICIEN P, TYPE_PRATICIEN TP WHERE P.TYP_CODE_TYPE_PRATICIEN = TP.TYP_CODE_TYPE_PRATICIEN;";
    foreach ($bdd->query($sql) as $row){
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
      echo "</tr>";


    }
  }

     ?>
  </tbody>
</table>

     </div>
   </div>
       <br>
       <br>
       <?php echo "<br>Nom : ".$_SESSION['nom']." <br>Matricule : ".$_SESSION['matricule']."<br><br>"; ?>
     </body>
 </html>
