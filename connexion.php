<?php
//Création des variables
define("SERVEUR","localhost");
define("USER","phpmyadmin");
define("MDP","phpmypasswd");
define("BD","SportNautique");
// gestion de la connexion

function connexionBd($hote=SERVEUR,$username=USER,$mdp=MDP,$bd=BD)
{
    try {
        $connexion = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BD, USER, MDP);
        $connexion->exec("SET CHARACTER SET utf8");
        return $connexion;
        //Gestion des accents
    } //gestion des erreurs
    catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
    }
}
