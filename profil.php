<?php
session_start();
require_once "config.php";

$requete = $bdd->prepare('SELECT * FROM user WHERE username = :id');
$requete->bindParam(':id', $_SESSION['username']);
$requete->execute();
$reponse = $requete->fetch(PDO::FETCH_ASSOC);

$id_user = $reponse['id'];
$permission = $reponse['permission'];

$serveurs = $bdd->prepare('SELECT * FROM t_server WHERE id_user = :id_user');
$serveurs->bindParam(':id_user', $id_user);
$serveurs->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <ul>
        <?php 
        if (!isset($_SESSION['loggedin'])) {
            echo '            
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Register</a></li>';
        } else {
            echo '
            <li><a href="index.php">Home</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="logout.php">Logout</a></li>';
        }
        ?>
        </ul>
    </div>

    <div class="profile-box">
        <?php
        echo '<img src="https://mineskin.eu/avatar/' . $reponse["username"] . '/100.png">';
        echo '<h2>' . $reponse["username"] . '</h2>';
        echo '<p>Email: ' . $reponse["email"] . '</p>';
        ?>
        <a href="backoffice.php"><button class="backoffice-button">Backoffice</button></a>
    </div>

    <div class="form-box">
        <form action="envoyer_server.php" method="POST">
        <label for="input1">Image:</label>
        <input type="text" name="input1" value="" required><br>
        
        <label for="input2">Nom:</label>
        <input type="text" name="input2" value="" required><br>
        
        <label for="input3">Description:</label>
        <input type="text" name="input3" value="" required><br>
        
        <label for="input4">Discord:</label>
        <input type="text" name="input4" value="" required><br>
        
        <label for="input5">Lien:</label>
        <input type="text" name="input5" value="" required><br>
        
        <label for="input6">IP:</label>
        <input type="text" name="input6" value="" required><br>
        
        <label for="categorie">Catégorie:</label>
        <select name="categorie" id="categorie">
            <?php
            // Effectuer la requête pour récupérer les catégories de la table "categorie"
            $requeteCategorie = $bdd->query('SELECT * FROM categorie');
            while ($row = $requeteCategorie->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($row["name"] == $reponseserver["categorie_name"]) ? 'selected="selected"' : '';
                echo '<option value="' . $row["name"] . '"' . $selected . '>' . $row["name"] . '</option>';
            }
            ?>
        </select>
        <br>
        <br>
            <button type="submit">Envoyer</button>        </form>
    </div>

    <div class="additional-box">
        <h2>Liste de vos serveurs</h2>
        <div class="small-box-container">
            <?php foreach ($serveurs as $serveur) { ?>
                <div class="small-box">
                    <h3><?php echo $serveur['name']; ?></h3>
                    <div class="icon-container">
                        <a href="modifier_serveur.php?id=<?php echo $serveur['id']; ?>"><i class="fas fa-pen"></i></a>
                        <a href="supprimer_serveur.php?id=<?php echo $serveur['id']; ?>"><i class="fas fa-trash"></i></a>
                        <?php if ($serveur['subscribe'] != 1) { ?>
                            <a href="subscribe_server.php?id=<?php echo $serveur['id']; ?>"><i class="fas fa-shopping-cart"></i></a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
