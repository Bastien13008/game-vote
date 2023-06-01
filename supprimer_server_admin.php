<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];


// Supprimer les votes liés au serveur
$suppressionVotes = $bdd->prepare('DELETE FROM vote WHERE id = :id');
$suppressionVotes->bindParam(':id', $id, PDO::PARAM_INT);
$suppressionVotes->execute();

// Supprimer le serveur de la table "t_server"
$suppression = $bdd->prepare('DELETE FROM t_server WHERE id = :id');
$suppression->bindParam(':id', $id, PDO::PARAM_INT);
$suppression->execute();


        // Redirection vers la page des serveurs après la suppression
        header("Location: backoffice.php");
        exit();
    }
}
?>
