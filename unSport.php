<?php
session_start();
include('connexion.php');
//créer le point de connexion
$connexion = connexionBd();
$_SESSION['nb_seance']=$_POST['nb_seance'];
$place=30;
//requete pour recuperer 1 arcticle
if ( !empty($_GET['sport']) ) {


    $numSport = $_GET['sport'];
    $sport="SELECT * FROM sport_nautique where id_sport=$numSport ";
    $resultat=$connexion->query($sport);
    $unSport=$resultat->fetchall(PDO::FETCH_OBJ);

    if(isset($_POST['nb_seance'])){
        $_SESSION['nb_seance']=$_POST['nb_seance'];
        $place=$place-1;
        foreach ($unSport as $element) {


            header('Location:panier.php?id='.$element->id_sport.'&nb_seance='.$_SESSION['nb_seance']);
        }
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

    <?php foreach ($unSport as $element):?>
    <h2 id="titreDestination" style="margin-bottom:10%;margin-top:20%;"> <?=$element->nom;?></h2>

    <section  id="maSection2" style="display: flex; flex-direction: row" >

        <ul id="uneDestination2">

            <li class="elementuneDestination2">

                <img src="<?=$element->img;?>"/>



            </li>

        </ul>

        <section id="grandeSection">

            <p>
                <?=$element->description;?>
            <p style="color:#fb9c1c"> <?=$place;?> places disponibles</p>
            </p>

            <section id="petiteSection">
                <strong><?=$element->prix;?>€/mois</strong>

                <form id="petiteSection" style="display: flex;flex-direction: row" method="post" >

                    <select name="nb_seance" >

                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <input type="submit" name="send" value="ajouter au panier"/>


                </form>
            </section>

        </section>

    </section>
    <?php endforeach;?>







</main>
<?php include('footer.php');?>
<script src="js/comportements.js"></script>
</body>
</html>
