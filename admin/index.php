<?php
session_start();
include'../connexion.php';
$connexion = connexionBd();
//selectionner toutes les categories
$requete="SELECT* FROM categorie";
$resultat = $connexion->query($requete);
$info = $resultat->fetchall(PDO::FETCH_OBJ);
//selectionner toutes les commandes
$commande="SELECT *
            from ligne_commande join sport_nautique,inscription 
            where ligne_commande.id_sport=sport_nautique.id_sport 
            and ligne_commande.id_client=inscription.id";
$resultat=$connexion->query($commande);
$ToutesLesCommandes=$resultat->fetchall(PDO::FETCH_OBJ);


if(isset($_POST["send1"])){


    if(isset($_POST["id_categorie"])){
        $id_categorie=$_POST["id_categorie"];
    }else{
        $id_categorie="";
    }


    if(isset($_POST["nom"])){
        $nom=$_POST["nom"];
    }else{
        $nom="";
    }
    if(isset($_POST["description"])){
        $description=$_POST["description"];
    }else{
        $description="";
    }


    if(isset($_POST["prix"])){
        $prix=$_POST["prix"];
    }else{
        $prix="";
    }

    if(isset($_FILES["avatar"]["name"])){
        $image="../img/sports/".$_FILES["avatar"]["name"];
    }else{
        $image="";
    }

    if(!empty($id_categorie)&&!empty($nom )&&!empty($description)&&!empty($prix)&&!empty($image)){
        $requete2="SELECT * FROM sport_nautique WHERE nom='$nom'";
        $resltat2=$connexion->query($requete2);
        $info2=$resltat2->fetch(PDO::FETCH_OBJ);

        //var_dump($info2);
        if($info2==false){
            $requete3="insert into sport_nautique values(NULL ,'$id_categorie','$nom','$description','$prix','$image')";

            move_uploaded_file($_FILES["avatar"]["tmp_name"],$image);

            $resultat=$connexion->exec($requete3);
            $msg="insertion reussit!";

        } else {
            $error="L'activité existe déjà";

        }


    }


}
/************************************************Formulaire suppression*****************************************/

if(isset($_POST["send2"])){

    if(isset($_POST["id_categorie"])){
        $id_categorie=$_POST["id_categorie"];
    }else{
        $id_categorie="";
    }


    if(isset($_POST["nom"])){
        $nom=$_POST["nom"];
    }else{
        $nom="";
    }
    if(isset($_POST["description"])){
        $description=$_POST["description"];
    }else{
        $description="";
    }


    if(isset($_POST["prix"])){
        $prix=$_POST["prix"];
    }else{
        $prix="";
    }

    if(isset($_FILES["avatar"]["name"])){
        $image="../img/sports/".$_FILES["avatar"]["name"];
    }else{
        $image="";
    }

    if(!empty($nom )&&!empty($id_categorie)){
        $requete2="SELECT * FROM sport_nautique WHERE nom='$nom'";
        $resltat2=$connexion->query($requete2);
        $info2=$resltat2->fetch(PDO::FETCH_OBJ);


        if($info2==false){
            $error="L'activité n'existe pas...";

        } else {


            $requete3="DELETE FROM sport_nautique WHERE nom='$nom'";
            $resultat=$connexion->exec($requete3);
            $msg="suppression reussit!";

        }

    }


}
/**********************************Formulaire modification******************************************************/

if(isset($_POST["send3"])){


    if(isset($_POST["id_categorie"])){
        $id_categorie=$_POST["id_categorie"];
    }else{
        $id_categorie="";
    }


    if(isset($_POST["nom"])){
        $nom=$_POST["nom"];
    }else{
        $nom="";
    }
    if(isset($_POST["description"])){
        $description=$_POST["description"];
    }else{
        $description="";
    }


    if(isset($_POST["prix"])){
        $prix=$_POST["prix"];
    }else{
        $prix="";
    }

    if(isset($_FILES["avatar"]["name"])){
        $image="../img/sports/".$_FILES["avatar"]["name"];
    }else{
        $image="";
    }

    if(!empty($id_categorie)&&!empty($nom)&&!empty($description)&&!empty($prix)&&!empty($image)){
        $requete2="SELECT * FROM sport_nautique WHERE nom='$nom'";
        $resltat2=$connexion->query($requete2);
        $info2=$resltat2->fetch(PDO::FETCH_OBJ);

        //var_dump($info2);
        if($info2==false){
            $requete3="UPDATE sport_nautique WHERE nom='$nom'";
            move_uploaded_file($_FILES["avatar"]["tmp_name"],$image);

            $resultat=$connexion->exec($requete3);

            $error="cette activité n'existe pas...";
        } else {
            $requete3="UPDATE sport_nautique SET description=:description, id_categorie=:id_categorie, prix=:prix,img=:img WHERE nom='$nom'";
            move_uploaded_file($_FILES["avatar"]["tmp_name"],$image);

            $requete3Rep=$connexion->prepare($requete3);
            $requete3Rep->bindParam(':description',$description);
            $requete3Rep->bindParam(':id_categorie',$id_categorie);
            $requete3Rep->bindParam(':prix',$prix);
            $requete3Rep->bindParam(':img',$image);

            $R=$requete3Rep->execute();
            $msg="la modification de l'activité a ete effectué !";


        }


    }


}
/********************************************************************************/

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/styleAdmin.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>
<body>


<div id="container">
    <h1> Administration du site OpenShop</h1>

    <?php if($error):?>
        <p style="color:red;font-size: 18px><?=$error;?></p>
    <?php endif;?>
        <?php if($msg):?>
                <p style="color: yellow;font-size: 18px"><?=$msg;?></p>
    <?php endif;?>
<main>
    <form method="post" action="index.php" enctype="multipart/form-data">
        <fieldset>
            <legend><B>Ajout d'un article</B></legend>
            <p>
                <label>Nom de l'activité </label>
                <input type="text" name="nom"  />
            </p>
            <p>
                <label>Description</label>
                <input type="text" name="description" />
            </p>
            <p>
                <label>Catégorie</label>
                <select name="id_categorie">
                    <?php foreach($info as $uneinfo):?>
                        <option value="<?=$uneinfo->id_categorie?>"><?=$uneinfo->nom?></option>
                    <?php endforeach;?>


                </select>
            </p>
            <p>
                <label>prix</label>
                <input type='text' name='prix'>
            </p>
           <p>
                <label>image</label>
                <input type="file" name="avatar" accept="image/jpg" />
            </p>
        </fieldset>
        <p>
            <input type="submit" name="send1" value="Ajouter"/>
        </p>


    </form>


    <form method="post" action="index.php" enctype="multipart/form-data">
        <fieldset>
            <legend><B>Suppression d'un article</B></legend>
            <p>
                <label>Nom de l'activité </label>
                <input type="text" name="nom"  />
            </p>
            <p>
                <label>Catégorie</label>
                <select name="id_categorie">
                    <?php foreach($info as $uneinfo):?>
                        <option value="<?=$uneinfo->id_categorie?>"><?=$uneinfo->nom?></option>
                    <?php endforeach;?>


                </select>
            </p>
        </fieldset>
        <p>
            <input type="submit" name="send2" value="Supprimer"/>
        </p>


    </form>

    <form method="post" action="index.php" enctype="multipart/form-data">
        <fieldset>
            <legend><B>Modification d'un article</B></legend>
            <p>
                <label>Nom de l'activité </label>
                <input type="text" name="nom"  />
            </p>
            <p>
                <label>Description</label>
                <input type="text" name="description" />
            </p>
            <p>
                <label>Catégorie</label>
                <select name="id_categorie">
                    <?php foreach($info as $uneinfo):?>
                        <option value="<?=$uneinfo->id_categorie?>"><?=$uneinfo->nom?></option>
                    <?php endforeach;?>


                </select>
            </p>
            <p>
                <label>prix</label>
                <input type='text' name='prix'>
            </p>
            <p>
                <label>image</label>
                <input type="file" name="avatar" accept="image/jpg" />
            </p>
        </fieldset>
        <p>
            <input type="submit" name="send3" value="Modifier"/>
        </p>


    </form>
</main>
    <h2 style="margin: 5%">toutes les réservations :</h2>

  <table >
        <tr>
            <th>le client</th>
            <th>l'activité choisit</th>
            <th >prix unitaire</th>
            <th>nombre de séance</th>
            <th>prix</th>
        </tr>
        <?php foreach ($ToutesLesCommandes as $uneCommande):?>
            <tr   >
                <td ><?=$uneCommande->prenom;?> <?=$uneCommande->nom;?></td>
                <td> <img style="height: 200px; width: 300px" src="../<?=$uneCommande-> img?>"/>
                <td><?=$uneCommande->prix;?>€/mois</td>
                <td>séances : <?=$uneCommande->nb_seance_sport;?> mois</td>
                <td><?=$uneCommande->prix*$uneCommande->nb_seance_sport;?>€</td>


            </tr>

        <?php endforeach;?>
    </table>


</div>
</body>
</html>