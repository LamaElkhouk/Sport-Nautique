<?php
session_start();

//fonction date
$date=date('d/m/Y');
//fonction pour tronquer le texte
include('utile.php');


////////////////affichage de 3 artciles au hasard///////////
include('connexion.php');
//créer le point de connexion
$connexion = connexionBd();

if(isset($_SESSION['id'])&&!empty($_GET['id'])){
    $id=$_SESSION['id'];
    $commande="SELECT * from ligne_commande join sport_nautique where ligne_commande.id_sport=sport_nautique.id_sport and id_client='$id'";
    $resultat=$connexion->query($commande);
    $mesCommandes=$resultat->fetchall(PDO::FETCH_OBJ);

}else{
    $msg="aucune commande n'a ete enregistré ";
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


    <h2 id="titreDestination" style="margin-bottom:10%;margin-top:20%;"> mon compte </h2>
<div style="color:dimgrey; font-size: 22px">
    <p> Nom: <?=$_SESSION['nom']?> </p>
    <p> Numéro de télépone: 0<?=$_SESSION['num_tel']?></p>
    <p> Sexe: <?=$_SESSION['sexe']?></p>
    <p> Date de naissance: <?=$_SESSION['naissance']?></p>
</div>

    <h3 style="color:dimgrey; font-size: 25px;margin-bottom: 5%"> mes commandes :</h3>

    <?php if($msg):?>
        <p style="color:dimgrey;text-align: center;font-size: 20px"><?=$msg;?></p>

    <?php else:?>
        <table ">
            <tr>
                <th>l'activité choisit</th>
                <th>nom de l'activité</th>
                <th >prix unitaire</th>
                <th>nombre de séances</th>
                <th>prix</th>
            </tr>
            <?php foreach ($mesCommandes as $uneCommande):?>
                <tr>

                    <td> <img style="height: 200px; width: 300px" src="<?=$uneCommande-> img?>"/>
                    <td>  <?=$uneCommande->nom;?></td>
                    <td><?=$uneCommande->prix;?>€/mois</td>
                    <td>séance : <?=$uneCommande->nb_seance_sport;?> mois</td>
                    <td><?=$uneCommande->prix*$uneCommande->nb_seance_sport;?>€</td>


                </tr>

            <?php endforeach;?>


        </table>

    <?php endif;?>








</main>
<?php include('footer.php');?>
<script src="js/comportements.js"></script>
</body>
</html>
