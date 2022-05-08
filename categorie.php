<?php
session_start();
include('connexion.php');
include('utile.php');
//créer le point de connexion
$connexion = connexionBd();
$_SESSION['nb_seance']=$_POST['nb_seance'];
$place=30;
//requete pour recuperer 1 sport
if ( !empty($_GET['cat']) ) {
    setcookie('cookieCategorie',$_GET['cat']);
    if($_GET['cat']!=='all'){
//selectionner le sport selon la categorie

        $numcategorie = $_GET['cat'];
        $categorie = "SELECT * FROM sport_nautique where id_categorie=$numcategorie";
        $lesCategories = $connexion->query($categorie);
        $retour = $lesCategories->fetchall(PDO::FETCH_OBJ);


//pour recuperer les noms des categoriesdes sports
        $categorie = "SELECT * FROM categorie where id_categorie=$numcategorie";
        $lesCategories = $connexion->query($categorie);
        $retour2 = $lesCategories->fetchall(PDO::FETCH_OBJ);

    }else{
//selectionner les articles de toutes les categories

        $numcategorie = $_GET['cat'];
        $categorie = "SELECT * FROM sport_nautique";
        $uneCategorie = $connexion->query($categorie);
        $retour = $uneCategorie->fetchall(PDO::FETCH_OBJ);
    }


}


    if(isset($_POST['nb_seance'])){
        $_SESSION['nb_seance']=$_POST['nb_seance'];
        foreach ($retour as $element) {


            header('Location:panier.php?id='.$element->id_sport.'&nb_seance='.$_SESSION['nb_seance']);
        }

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
    <?php if($_GET['cat']!=='all'):?>

        <?php foreach ($retour2 as $sport):?>
            <h2 id="titreDestination" style="margin-bottom:10%;margin-top:20%;">Sports <?=$sport->nom;?></h2>

        <?php endforeach;?>
    <?php else:?>
        <h2 id="titreDestination" style="margin-bottom:10%;margin-top:20%;">  Tous Nos sports </h2>
    <?php endif;?>


    <?php foreach ($retour as $sport):?>

    <section  id="maSection2" >
        <section id="A">
        <h3><?=$sport->nom;?></h3>
        </section>
        <section id="B">
        <ul id="uneDestination2">
            <li class="elementuneDestination2">

                <img src="<?=$sport->img;?>"/>

            </li>
        </ul>

        <section id="grandeSection">

            <p>
                <?=tronquer_texte($sport->description);?>
            <p>


            <section id="petiteSection">
                <strong><?=$sport->prix;?>€/mois</strong>
                <button id="registerNew">
                    <a href="unSport.php?sport=<?=$sport->id_sport;?>">suivant</a>
                </button>


            </section>

        </section>
        </section>
    </section>
<?php endforeach;?>


</main>
<?php include('footer.php');?>
<script src="js/comportements.js"></script>
</body>
</html>
