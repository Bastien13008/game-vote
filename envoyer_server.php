<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input1 = $_POST["input1"];
    $input2 = $_POST["input2"];
    $input3 = $_POST["input3"];
    $input4 = $_POST["input4"];
    $input5 = $_POST["input5"];
    $input6 = $_POST["input6"];
    $categorie = $_POST["categorie"];
    $vote = 0;
    $subscribe = 0;

    // Récupérer l'ID de l'utilisateur
    $requete = $bdd->prepare('SELECT id FROM user WHERE username = :username');
    $requete->bindParam(':username', $_SESSION['username']);
    $requete->execute();
    $reponse = $requete->fetch(PDO::FETCH_ASSOC);
    $id_user = $reponse['id'];

    $requeteCategorie = $bdd->prepare('SELECT * FROM categorie WHERE name = :name');
    $requeteCategorie->bindParam(':name', $categorie);
    $requeteCategorie->execute();
    $row = $requeteCategorie->fetch(PDO::FETCH_ASSOC);

    $finishcategorie = $row["id"];


    // Insérer les données dans la table "t_server"
    $insertion = $bdd->prepare('INSERT INTO t_server (name, description, vote, img, subscribe, discord, link, ip, id_user, id_categorie) VALUES (:name, :description, :vote, :img, :subscribe, :discord, :link, :ip, :id_user, :id_categorie)');
    $insertion->bindParam(':img', $input1);
    $insertion->bindParam(':name', $input2);
    $insertion->bindParam(':description', $input3);
    $insertion->bindParam(':discord', $input4);
    $insertion->bindParam(':link', $input5);
    $insertion->bindParam(':ip', $input6);
    $insertion->bindParam(':id_categorie', $finishcategorie);
    $insertion->bindParam(':id_user', $id_user);
    $insertion->bindParam(':vote', $vote);
    $insertion->bindParam(':subscribe', $subscribe);

    $insertion->execute();

    // Redirection vers la page des serveurs après l'insertion
    header("Location: Profil.php");
    exit();
}
?>
