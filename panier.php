<?php
session_start();
include('connexion.php');
//créer le point de connexion
$connexion = connexionBd();
$date=date('d/m/Y');

if(isset($_SESSION['id'])&& !empty($_GET['id']&& isset($_SESSION['nb_seance'])) ){


    $connecte = true;
    $prix_total = 0;

    //echo " nb_seance : ";
   // echo $_SESSION['nb_seance'];

   // echo " id client :";
    //echo $_SESSION['id'];

    if(!empty($_GET['id'])) {
       // echo " id_sport";
        $idSport = $_GET['id'];

        echo " ";

        $nb_seance=$_SESSION['nb_seance'];
        $id=$_SESSION['id'];
        //echo $_GET['id'];

        $requete = "SELECT * FROM sport_nautique where id_sport=$idSport";
        $resultat = $connexion->query($requete);
        $prixSport= $resultat->fetch(PDO::FETCH_OBJ);
        $confirmation = "vous avez effectuer une commande";


    }
    $requeteInsertion="insert into ligne_commande (id_commande,id_sport,nb_seance_sport,id_client) values (NULL,$idSport,$nb_seance,$id)";
    $resultat2 = $connexion->exec($requeteInsertion);
    //var_dump($resultat2);



} else {
    $connecte = false;
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/styleSport.css" rel="stylesheet">
    <link href="icomoon/style.css" rel="stylesheet">
    <link href="icomoon2/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <title>Mon site</title>
</head>
<body>
<?php include('header.php');?>
<main>


    <h2 id="titreDestination" style="margin-bottom:10%;margin-top:20%;"> mon panier</h2>
    <?php if($confirmation and $connecte==true):?>
    <figure style="margin-top: 10%;margin-bottom: 10%;">
        <img style="height: 200px; margin-left: 35%" src="img/panierAjout.png"
             alt="Elephant at sunset">
        <figcaption style="font-size: 20px ;color:#b1fa1c">
            <h3 style="margin: 10%"><?=$confirmation;?> au prix de <?=$prixSport->prix*$nb_seance?>€</h3>
        </figcaption>

        <p style="color:#74716d">voir dans vos <a style="color:#74716d"  href="monCompte.php?id=<?=$_SESSION['id']?>"> <B>commande</B></a></p>

    <?php else:?>
    <figure style="margin-top: 10%;margin-bottom: 10%;">
        <img style="height: 200px; margin-left: 35%" src="img/panier.svg"
             alt="Elephant at sunset">
        <figcaption style="font-size: 25px; margin-left: 35% ;color:#74716d"><B>votre panier est vide</B></figcaption>


        <?php endif;?>

        <?php if($_SESSION['id']==null ):?>
        <section style="display:flex; flex-direction: row">
            <p style="margin-top: 5%; font-size: 20px"> vous devez vous connecter afin d'effectuer un achat !<a href="connexionCompte.php"> connexion</a></p>

        </section>
        <?php endif;?>



</main>
<?php include('footer.php');?>
<script src="js/comportements.js"></script>
</body>
</html>
