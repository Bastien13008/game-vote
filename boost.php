<?php
session_start();
require_once "config.php";

$updateQuery = "UPDATE vote SET is_activate = 0";
$updateStatement = $bdd->prepare($updateQuery);
$updateStatement->execute();
?>
