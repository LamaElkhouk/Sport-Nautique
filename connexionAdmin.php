
<?php
session_start();

include'connexion.php';
$connexion = connexionBd();
if(isset($_POST["send"])){

    if(isset($_POST["emailConnect"])){
        $emailConnect=$_POST["emailConnect"];
    }else{
        $emailConnect="";
    }
    if(isset($_POST["mdpConnect"])){
        $mdpConnect=hash('sha256',$_POST['mdpConnect']);

    }else{
        $mdpConnect="";
    }


    if(!empty($emailConnect)&&!empty($mdpConnect)){

        $requete=$connexion->prepare("SELECT * FROM inscription WHERE email=? and mdp=?");

        $requete->execute(array($emailConnect,$mdpConnect));
        $info=$requete->fetchall(PDO::FETCH_OBJ);


        //si le compte n'existe pas
        if ($info == false) {
            $error = "ce compte n'existe pas...";

        } else {
            if($mdpConnect==hash('sha256','admin')) {
                foreach ($info as $userinfo) {

                    $_SESSION['id'] = $userinfo->id;
                    $_SESSION['nom'] = $userinfo->nom;
                    $_SESSION['num_tel'] = $userinfo->num_tel;
                    $_SESSION['sexe'] = $userinfo->sexe;
                    $_SESSION['naissance'] = $userinfo->naissance;
                    $_SESSION['email'] = $userinfo->email;
                    $_SESSION['mdp'] = $userinfo->mdp;


                    header("Location: ./admin/index.php?id=" . $_SESSION['id'] . "&nom=" . $_SESSION['nom']);
                }
            }else{
                $error=" seul les Administrateurs du site ont accès a cette espace ...";
            }
        }



    }else{
        $error="les champs doivent etre completé!";
    }


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
    <link href="icomoon/style.css" rel="stylesheet">
    <link href="icomoon2/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <title>Mon site</title>
</head>
<body>

<main>
    <diV id="connexion" style="background-color: rgba(127,127,127,.5)">
        <h2 id="titreFormulaire">Authentification requise </h2>
        <hr>
        <form action="" method="post">



            <p>
                <label id="labelmise"><span class="icon-user"></span><em> *</em></label> <input type="email" id="emailConnect" name="emailConnect"           placeholder="exemple@gmail.com" required/>
            </p>

            <p>
                <label id="labelmise"><span class="icon-lock"></span><em> *</em></label> 		 <input type="password"id="mdpConnect" name="mdpConnect" placeholder="Votre mot de passe" required/>
            </p>




            <!-- <input  type="submit" name="send" value="Création de compte" /> -->
            <button id="registerNew" type="submit" name="send" ><B>Connexion</B></button>
        </form>
        <?php if($error):?>
            <p style="color: red;font-size: 17px;"><strong><?=$error;?></strong></p>
        <?php endif;?>

    </diV>



</main>


</footer>
<script src="js/comportements.js"></script>
</body>
</html>
