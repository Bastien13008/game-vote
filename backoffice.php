
<?php
session_start();
require_once "config.php";

$requete = $bdd->prepare('SELECT * FROM user WHERE username = :id');
$requete->bindParam(':id', $_SESSION['username']);
$requete->execute();
$reponse = $requete->fetch(PDO::FETCH_ASSOC);

$id_user = $reponse['id'];
$permission = $reponse['permission'];


$serveurs = $bdd->prepare('SELECT t_server.*, user.username FROM t_server INNER JOIN user ON t_server.id_user = user.id');
$serveurs->execute();

$categories = $bdd->query('SELECT * FROM categorie');

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/backoffice.css">
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

    <div class="form-box">
        <form action="cree_categorie.php" method="POST">
        <label for="input1">Catégorie:</label>
        <input type="text" name="input1" value="" required><br>
        <br>
        <br>
            <button type="submit">Crée</button>        </form>
    </div>

   
    <div class="additional-box">
        <h2>Liste de vos serveurs</h2>
        <div class="small-box-container">
            <?php foreach ($serveurs as $serveur) { ?>
                <div class="small-box">
                    <h3><?php echo $serveur['name']; ?></h3>
                    <h2><?php echo $serveur['username']; ?></h2>

                    <div class="icon-container">
                        <a href="supprimer_server_admin.php?id=<?php echo $serveur['id']; ?>"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="category-box">
        <h2>Liste des catégories</h2>
        <div class="category-container">
            <?php foreach ($categories as $categorie) { ?>
                <div class="category-item">
                    <h3><?php echo $categorie['name']; ?></h3>
                    <a href="supprimer_categorie_admin.php?id=<?php echo $categorie['name']; ?>"><i class="fas fa-trash"></i></a>
                </div>
            <?php } ?>
        </div>
    </div>


</body>
</html>
