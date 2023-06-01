<?php
require_once "config.php";

// Vérifier si le paramètre GET "id" est présent
if (isset($_GET['id'])) {
    // Récupérer l'identifiant du serveur depuis le paramètre GET
    $idServeur = $_GET['id'];

    // Vérifier si les données du formulaire sont soumises
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les valeurs des champs du formulaire
        $input1 = $_POST['input1'];
        $input2 = $_POST['input2'];
        $input3 = $_POST['input3'];
        $input4 = $_POST['input4'];
        $input5 = $_POST['input5'];
        $input6 = $_POST['input6'];
        $categorie = $_POST['categorie'];



        $requeteCategorie = $bdd->prepare('SELECT * FROM categorie WHERE name = :name');
        $requeteCategorie->bindParam(':name', $categorie);
        $requeteCategorie->execute();
        $row = $requeteCategorie->fetch(PDO::FETCH_ASSOC);

        $finishcategorie = $row["id"];

        // Effectuer la mise à jour des données dans la table t_serveur
        $requeteUpdateServeur = $bdd->prepare('UPDATE t_server SET img = :img, name = :name, description = :description, discord = :discord, link = :link, ip = :ip, id_categorie = :id_categorie WHERE id = :idServeur');
        $requeteUpdateServeur->bindParam(':img', $input1);
        $requeteUpdateServeur->bindParam(':name', $input2);
        $requeteUpdateServeur->bindParam(':description', $input3);
        $requeteUpdateServeur->bindParam(':discord', $input4);
        $requeteUpdateServeur->bindParam(':link', $input5);
        $requeteUpdateServeur->bindParam(':ip', $input6);
        $requeteUpdateServeur->bindParam(':id_categorie', $finishcategorie);
        $requeteUpdateServeur->bindParam(':idServeur', $idServeur);

        if ($requeteUpdateServeur->execute()) {
            // Redirection vers la page de succès ou autre traitement souhaité
            header("Location: profil.php");
            exit();
        } else {
            // Gérer l'échec de la mise à jour (afficher un message d'erreur, rediriger, etc.)
            echo "Erreur lors de la mise à jour du serveur.";
        }
    } else {
        // Si aucune donnée de formulaire n'est soumise, afficher un message d'erreur
        echo "Aucune donnée de formulaire soumise.";
    }
} else {
    // Si aucun identifiant de serveur n'est fourni, afficher un message d'erreur
    echo "Aucun identifiant de serveur fourni.";
}
?>
