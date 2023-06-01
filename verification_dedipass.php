<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dedipassCode = $_POST["dedipass_code"];
    $serverId = $_POST["server_id"];

    // Vérifier le code Dedipass
    $dedipassUrl = "http://api.dedipass.com/v1/pay/?public_key=17a3d407fc4cddd954877909c3b87ff1&private_key=64b0b7e6ecf99858d5ab7ad35e407af16aa4618c&code=" . $dedipassCode;
    $dedipassResponse = file_get_contents($dedipassUrl);
    $dedipassData = json_decode($dedipassResponse);

    if ($dedipassData->status == "success") {
        // Le code Dedipass est valide, ajouter 1 au champ "subscribe" de la table "t_server"
        $updateQuery = $bdd->prepare('UPDATE t_server SET subscribe = subscribe + 1 WHERE id = :server_id');
        $updateQuery->bindParam(':server_id', $serverId);
        $updateQuery->execute();

        // Redirection vers la page de confirmation ou autre action à effectuer
        header("Location: index.php");
        exit();
    } else {
        // Le code Dedipass est invalide, afficher un message d'erreur ou autre action à effectuer
        header("Location: profil.php");
    }
}
?>
