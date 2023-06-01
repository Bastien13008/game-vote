<?php
require_once "config.php";
// Vérifier si le paramètre GET "id" est présent
if (isset($_GET['id'])) {
    // Récupérer l'identifiant du serveur depuis le paramètre GET
    $idServeur = $_GET['id'];

    // Effectuer les opérations de suppression du serveur ici
    $requete = $bdd->prepare('DELETE FROM t_server WHERE id = :id');
    $requete->bindParam(':id', $idServeur);
    $requete->execute();

    // Afficher un message de confirmation
    header("Location: profil.php");
} else {
    // Si aucun identifiant de serveur n'est fourni, afficher un message d'erreur
    header("Location: profil.php");
}
?>
