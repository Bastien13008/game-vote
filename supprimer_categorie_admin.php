<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Supprimer les serveurs liés à la catégorie
        $suppressionServeurs = $bdd->prepare('DELETE FROM t_server WHERE id_categorie = :id');
        $suppressionServeurs->bindParam(':id', $id, PDO::PARAM_INT);
        $suppressionServeurs->execute();

        // Supprimer la catégorie de la table "categorie" en utilisant l'ID
        $suppressionCategorie = $bdd->prepare('DELETE FROM categorie WHERE id = :id');
        $suppressionCategorie->bindParam(':id', $id, PDO::PARAM_INT);
        $suppressionCategorie->execute();

        // Redirection vers la page des catégories après la suppression
        header("Location: backoffice.php");
        exit();
    }
}

?>
