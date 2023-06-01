<?php
session_start();
require_once "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $requete = $bdd->prepare('SELECT * FROM user WHERE username = :id');
    $requete->bindParam(':id', $_SESSION['username']);
    $requete->execute();

    $reponse = $requete->fetch(PDO::FETCH_ASSOC);
    
    if ($reponse) {
        $user_id = $reponse['id'];

        // Vérifier si l'insertion existe déjà
        $checkVoteQuery = "SELECT id, is_activate FROM vote WHERE id = :id AND id_user = :user_id";
        $checkVoteStatement = $bdd->prepare($checkVoteQuery);
        $checkVoteStatement->bindParam(':id', $id);
        $checkVoteStatement->bindParam(':user_id', $user_id);
        $checkVoteStatement->execute();

        $existingVote = $checkVoteStatement->fetch(PDO::FETCH_ASSOC);
        header("Location: index.php"); // Redirection vers la page de bddexion après l'inscription

        if (!$existingVote) {
            // L'insertion n'existe pas, procéder à l'insertion
            $is_activate = 1;

            $insertQuery = "INSERT INTO vote (id, id_user, is_activate) VALUES (:id, :user_id, :is_activate)";
            $insertStatement = $bdd->prepare($insertQuery);
            $insertStatement->bindParam(':id', $id);
            $insertStatement->bindParam(':user_id', $user_id);
            $insertStatement->bindParam(':is_activate', $is_activate);
            $insertStatement->execute();

            // Ajouter 1 ou 2 (selon la condition) au champ "vote" de la table "t_server"
            $addVoteQuery = "UPDATE t_server SET vote = vote + :num_votes WHERE ID = :id";
            $addVoteStatement = $bdd->prepare($addVoteQuery);
            
            // Condition pour vérifier la valeur du champ "subscribe"
            $subscribeQuery = "SELECT subscribe FROM t_server WHERE ID = :id";
            $subscribeStatement = $bdd->prepare($subscribeQuery);
            $subscribeStatement->bindParam(':id', $id);
            $subscribeStatement->execute();
            $subscribeValue = $subscribeStatement->fetchColumn();

            // Déterminer le nombre de votes à ajouter
            $num_votes = ($subscribeValue > 0) ? 2 : 1;

            $addVoteStatement->bindParam(':num_votes', $num_votes);
            $addVoteStatement->bindParam(':id', $id);
            $addVoteStatement->execute();
            header("Location: index.php"); // Redirection vers la page de bddexion après l'inscription

        } else {
            // L'insertion existe déjà, vérifier la valeur de is_activate
            if ($existingVote['is_activate'] == 0) {
                // Remplacer la valeur de is_activate par 1
                $updateQuery = "UPDATE vote SET is_activate = 1 WHERE id = :id AND id_user = :user_id";
                $updateStatement = $bdd->prepare($updateQuery);
                $updateStatement->bindParam(':id', $id);
                $updateStatement->bindParam(':user_id', $user_id);
                $updateStatement->execute();

                // Ajouter 1 ou 2 (selon la condition) au champ "vote" de la table "t_server"
                $addVoteQuery = "UPDATE t_server SET vote = vote + :num_votes WHERE ID = :id";
                $addVoteStatement = $bdd->prepare($addVoteQuery);
                
                // Condition pour vérifier la valeur du champ "subscribe"
                $subscribeQuery = "SELECT subscribe FROM t_server WHERE ID = :id";
                $subscribeStatement = $bdd->prepare($subscribeQuery);
                $subscribeStatement->bindParam(':id', $id);
                $subscribeStatement->execute();
                $subscribeValue = $subscribeStatement->fetchColumn();

                // Déterminer le nombre de votes à ajouter
                $num_votes = ($subscribeValue > 0) ? 2 : 1;

                $addVoteStatement->bindParam(':num_votes', $num_votes);
                $addVoteStatement->bindParam(':id', $id);
                $addVoteStatement->execute();

            } else {
                header("Location: index.php"); // Redirection vers la page de bddexion après l'inscription
            }
        }
    }
}
?>
