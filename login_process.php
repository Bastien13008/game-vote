<?php
session_start();

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]); // Chiffrement MD5 du mot de passe

    $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // L'utilisateur est authentifié, vous pouvez effectuer les actions appropriées ici
        // Par exemple, définir une session

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header("Location: index.php"); // Redirection vers une page protégée après la bddexion réussie
        exit();
    } else {
        // Les informations de bddexion sont invalides
        // Vous pouvez afficher un message d'erreur ou effectuer une action appropriée
        echo "Nom d'utilisateur ou mot de passe invalide.";
    }
}

$bdd = null; // Fermer la bddexion PDO
?>
