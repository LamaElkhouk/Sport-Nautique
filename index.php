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
<?php include('header.php');?>

<main>
    <section class="cercles">
        <a href="pageAccueil.php"><div class="cercle" onmouseover="mOver(this)" onmouseout="mOut(this)" style="color:white; font-size:35px;text-shadow: 1px 1px 2px grey;    padding-top: 100px; padding-left:40px;">
                <img id="logo1" src="img/sailboat-1.png">

            </div>
        </a>
        <a href="connexionCompte.php"><div class="cercle" onmouseover="mOver2(this)" onmouseout="mOut(this)" style="color:white; font-size:35px;text-shadow: 1px 1px 2px grey;padding-top: 100px;padding-left:65px;">
                <span id="logo2" class="icon-user"></span>
            </div></a>

    </section>

</main>
<?php include('footer.php');?>
<script src="js/comportements.js"></script>
</body>
</html>