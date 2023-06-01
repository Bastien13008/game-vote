<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input1 = $_POST["input1"];

    // Insérer la valeur dans la table "categorie"
    $insertion = $bdd->prepare('INSERT INTO categorie (name) VALUES (:name)');
    $insertion->bindParam(':name', $input1);
    $insertion->execute();

    // Redirection vers la page de confirmation après l'insertion
    header("Location: backoffice.php");
    exit();
}
?>
