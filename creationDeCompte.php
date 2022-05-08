<?php
include'connexion.php';
$connexion = connexionBd();
if(isset($_POST["send"])){

    if(isset($_POST["nom"])){
        $nom=$_POST["nom"];
    }else{
        $nom="";
    }

    if(isset($_POST["num_tel"])){
        $num_tel=$_POST["num_tel"];
    }else{
        $num_tel="";
    }

    if(isset($_POST["sexe"])){
        $sexe=$_POST["sexe"];
    }else{
        $sexe="";
    }


    if(isset($_POST["naissance"])){
        $naissance=$_POST["naissance"];
    }else{
        $naissance="";
    }


    if(isset($_POST["email"])){
        $email=$_POST["email"];
    }else{
        $email="";
    }

    if(isset($_POST["mdp"])){
        $mdp=hash('sha256',$_POST['mdp']);


    }else{
        $mdp="";
    }
    //verifier si motPasse==motPasse2
    if(isset($_POST["mdp2"])){
        $mdp2=hash('sha256',$_POST['mdp2']);

    }else{
        $mdp2="";
    }









    if(!empty($nom)&&!empty($num_tel)&&!empty($sexe)&&!empty($naissance)&&!empty($email)&&!empty($mdp)&&!empty($mdp2)){




        $requete="SELECT * FROM inscription WHERE email='$email'";

        $resultat=$connexion->query($requete);
        $info=$resultat->fetch(PDO::FETCH_OBJ);





        if($mdp==$mdp2) {  //si les mots de passes sont identique
            //si le compte n'existe pas
            if ($info == false) {
                $requete2 = "insert into inscription values(NULL ,'$nom','$num_tel','$sexe','$naissance','$email','$mdp')";
                $resultat = $connexion->exec($requete2);
                $msg = "insertion reussit!";
                header("Location: connexionCompte.php");

            } else {
                $error = "ce compte existe déjà";

            }
        }else{
            $error="les mdp ne sont pas identique";
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

    <diV id="registration">
        <h2 id="titreFormulaire">Inscription : </h2>
        <hr>
        <form action="" method="post">

            <p>
                <label id="labelmise">Nom <em>*</em> </label>		<input type="text" id="nom" name="nom" value="Martin Dupont" required/>
            </p>

            <p>
                <label id="labelmise">Numéro de téléphone </label>		 <input type="text" id="num_tel" name="num_tel" placeholder="06 89 52 41 99"
                                                                                      />
            </p>

            <p>
                <label id="labelmise">Sexe</label>
                <select name="sexe" id="sexe">
                    <option value="Homme" name="sexe">Homme</option>
                    <option value="Femme" name="sexe">Femme</option>
                </select>
            </p>

            <p>
                <label id="labelmise">Date de naissance <em>*</em></label>		 <input type="date" id="naissance" name="naissance" required/>
            </p>

            <p>
                <label id="labelmise">Email <em>*</em></label>		 <input type="email" id="email" name="email" placeholder="exemple@gmail.com"required/>
            </p>

            <p>
                <label id="labelmise">Mot de passe <em>*</em></label>		 <input type="password"id="mdp" name="mdp" required/>
            </p>
            <p>
                <label id="labelmise">Confirmer le mot de passe <em>*</em></label>		 <input type="password"id="mdp2" name="mdp2" required/>
            </p>

            <input id="accepter" type="checkbox" name="accepter" required/>
            <label> J'accepte <a>les termes et conditions</a> et <a>la politique de confidentialité</a> </label>


            <!-- <input  type="submit" name="send" value="Création de compte" /> -->


                <button id="registerNew" type="submit" name="send" ><B>Création de compte</B></button>


        </form>


        <?php if($msg):?>
            <p><?=$msg;?></p>
        <?php else:?>
            <p><?=$error;?></p>
        <?php endif;?>

    </diV>


</main>

<script src="js/comportements.js"></script>
</body>
</html>
