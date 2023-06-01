<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]); // Chiffrement MD5 du mot de passe
    $permission = 0;

    $sql = "INSERT INTO user (username, password, email, permission) VALUES (:username, :password, :email, :permission)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":permission", $permission);
    $stmt->execute();

    header("Location: login.php"); // Redirection vers la page de bddexion après l'inscription
    exit();
}

$bdd = null; // Fermer la bddexion PDO
?>
