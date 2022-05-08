<?php
session_start();
//fonction date
$date=date('d/m/Y');
//fonction pour tronquer le texte
include('utile.php');


////////////////affichage de 3 sports au hasard///////////
include('connexion.php');
//créer le point de connexion
$connexion = connexionBd();
//requete pour selectionner 3 sports au hasard
if(isset($_COOKIE['cookieCategorie'])) {

    if ($_COOKIE['cookieCategorie'] !== 'all') {
        $connexion = connexionBd();
        $numcategorie = $_COOKIE['cookieCategorie'];
        $requete = "SELECT * FROM sport_nautique where id_categorie=$numcategorie ORDER BY RAND() LIMIT 3 ";
        $resultat = $connexion->query($requete);
        $SportAuHasard = $resultat->fetchall(PDO::FETCH_OBJ);


    }
}else {
    $requete = "SELECT * FROM sport_nautique ORDER BY RAND() LIMIT 3";
    $resultat = $connexion->query($requete);
    $SportAuHasard = $resultat->fetchall(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/styleSport.css" rel="stylesheet">
    <link href="icomoon/style.css" rel="stylesheet">
    <link href="icomoon2/style.css" rel="stylesheet">
    <link href="icomoon/icomoon1/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <title>Mon site</title>
</head>
<body>
<?php include('header.php');?>
<main>


    <section class="connexion">
        <?php if($_SESSION['id']==null):?>
        <p> <B>Bienvenue  Etranger  !</B></p>
        <?php else:?>
        <p> <B>Bienvenue <?=$_SESSION['nom']?></B></p>
        <?php endif;?>
        <p> nous sommes le <B><?=$date;?><B></p>
        <section class="icone">
            <?php if($_SESSION['id']==null):?>

                <a href="connexionCompte.php"> <span class="icon-user"></span></a>
                <a href="panier.php"><span class="icon-cart"></span></a>
                <a href="creationDeCompte.php"><p>s'inscrire</p></a>

            <?php else:?>
            <a href="monCompte.php?id=<?=$_SESSION['id']?>"> <span class="icon-user"></span></a>
            <a href="panier.php"><span class="icon-cart"></span></a>
                <a href="deconnexion.php"> <span class="icon-switch" ></span></a>
            <?php endif;?>
        </section>
    </section>





    <section id="maSection">



        <img id="img" style="height: 180px" src="img/sport.jpg"  >




        <p>
            <strong> Besoin de changements ?</strong>
            Vous aimez barboter dans l’eau? Vous êtes à la recherche de nouvelles aventures sensationnelles ? Dans ce cas, nous vous proposons                     tout un tas de sports nautiques insolites, de differentes catégoreis, qui parmi eux ce trouve la cle qui  rendra votre vie                             encore plus excitante !



            pour toutes <strong>reservations / informations</strong>,veuillez nous contacter au 08239447
        </p>

    </section>

    <nav id="menu-categorie">
        <ul>
            <h2 id="titreDestination"> Tous nos sports nautiques :</h2>
            <li class=""><a href="categorie.php?cat=all"><img  src="img/sports.png" id="imgCentre" ></a></li>
            <section id="imgs">
            <li class="menu"><a href="categorie.php?cat=1"><h3 style="text-align: center;">en mer</h3><img style="width: 320px;height: 250px" src="img/mer.jpg"  ></a></li>
            <li class="menu"><a href="categorie.php?cat=2"><h3 style="text-align: center;">dans l'océan</h3><img  style="width: 320px;height: 250px" src="img/ocean.jpg" ></a></li>
            <li class="menu"><a href="categorie.php?cat=3"><h3 style="text-align: center;">en vive eau</h3><img style="width: 320px;height: 250px" src="img/eau_vive.jpg"  ></a></li>
            </section>



        </ul>
    </nav>

    <h2 id="titreDestination"> Sports à découvrir !</h2>

    <div id="troisDestinations">
        <?php foreach ($SportAuHasard as $sport):?>
        <ul id="uneDestination">

            <a href="unSport.php?sport=<?=$sport->id_sport;?>">
                <li class="elementuneDestination">

                    <img src="<?=$sport->img?>"/>
                    <section>
                        <h3> <?=$sport->nom?></h3>
                        <strong><?=$sport->prix?>€/mois</strong>
                    </section>


                </li>
            </a>

        </ul>
        <?php endforeach;?>
    </div>


</main>
<?php include('footer.php');?>
<script src="js/comportements.js"></script>
</body>
</html>