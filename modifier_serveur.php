<?php
session_start();
require_once "config.php";

$id = $_GET['id'];

$requete = $bdd->prepare('SELECT * FROM user WHERE username = :id');
$requete->bindParam(':id', $_SESSION['username']);
$requete->execute();
$reponse = $requete->fetch(PDO::FETCH_ASSOC);

$id_user = $reponse['id'];

$serveur = $bdd->prepare('SELECT t_server.*, categorie.name AS categorie_name FROM t_server
INNER JOIN categorie ON t_server.id_categorie = categorie.id  WHERE id_user = :id_user AND t_server.id = :id');
$serveur->bindParam(':id_user', $id_user);
$serveur->bindParam(':id', $id);
$serveur->execute();
$reponseserver = $serveur->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/home.css">
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

    <div class="profile-box" style="background-color: #252539; width: 50%; margin: 20px auto; padding: 20px; text-align: center;">
        <?php
        echo '<img src="' . $reponseserver["img"] . '">';
        echo '<h2>' . $reponseserver["name"] . '</h2>';
        echo '<p>Email: ' . $reponseserver["description"] . '</p>';
        echo '<p>Discord: ' . $reponseserver["discord"] . '</p>';
        echo '<p>Link: ' . $reponseserver["link"] . '</p>';
        echo '<p>IP: ' . $reponseserver["ip"] . '</p>';
        echo '<p>Catégorie: ' . $reponseserver["categorie_name"] . '</p>';

        ?>
    </div>

    <div class="form-box" style="background-color: #252539; width: 50%; margin: 20px auto; padding: 20px; text-align: center;">
        <form action="modifier_serveur_post.php?id=<?php echo $reponseserver['id']; ?>" method="POST">
        <label for="input1">Image:</label>
        <input type="text" name="input1" value="<?php echo $reponseserver["img"]; ?>" required><br>
        
        <label for="input2">Nom:</label>
        <input type="text" name="input2" value="<?php echo $reponseserver["name"]; ?>" required><br>
        
        <label for="input3">Description:</label>
        <input type="text" name="input3" value="<?php echo $reponseserver["description"]; ?>" required><br>
        
        <label for="input4">Discord:</label>
        <input type="text" name="input4" value="<?php echo $reponseserver["discord"]; ?>" required><br>
        
        <label for="input5">Lien:</label>
        <input type="text" name="input5" value="<?php echo $reponseserver["link"]; ?>" required><br>
        
        <label for="input6">IP:</label>
        <input type="text" name="input6" value="<?php echo $reponseserver["ip"]; ?>" required><br>
        
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
            <button type="submit">Envoyer</button>
        </form>
    </div>


    <style>
        .navbar {
            margin-bottom: 20px;
            background-color: black;
            padding: 10px;
            color: white;
            display: flex;
            justify-content: space-between;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin-right: 10px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
        }

        .profile-box {
            background-color: #252539;
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            text-align: center;
        }

        .profile-box img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .form-box {
            background-color: #252539;
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            text-align: center;
        }

        .form-box input,
        .form-box button {
            margin-bottom: 10px;
        }

        .additional-box {
            background-color: #252539;
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            text-align: center;
        }

        .small-box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .small-box {
            background-color: green;
            border: 3px solid black;
            padding: 10px;
            margin-bottom: 10px;
            width: calc(33.33% - 20px);
            box-sizing: border-box;
        }

        .small-box h3 {
            margin: 0;
            color: white;
        }

        .icon-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .icon-container i {
            color: white;
            font-size: 24px;
        }
    </style>
</body>
</html>
