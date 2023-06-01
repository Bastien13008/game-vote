<?php
session_start();
require_once "config.php";

$requete = $bdd->prepare('SELECT * FROM user WHERE username = :id');
$requete->bindParam(':id', $_SESSION['username']);
$requete->execute();
$reponse = $requete->fetch(PDO::FETCH_ASSOC);
// echo "The username of the logged-in session is: " . $reponse['id'];
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/home.css">
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

    <?php
    $sql = "SELECT t_server.*, categorie.name AS categorie_name
            FROM t_server
            INNER JOIN categorie ON t_server.id_categorie = categorie.id
            ORDER BY vote DESC";

    $stmt = $bdd->query($sql);

    if ($stmt->rowCount() > 0) {
        $count = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $color = "";
            if ($count == 1) {
                $color = "#FFD700"; // Couleur jaune
            } elseif ($count == 2) {
                $color = "#C0C0C0"; // Couleur argent
            } elseif ($count == 3) {
                $color = "#CD7F32"; // Couleur bronze
            }
            elseif ($count > 3) {
                $color = "#000000"; // Couleur bronze
            }
            
            $maxplayers = file_get_contents('https://minecraft-api.com/api/ping/maxplayers/'.$row["ip"].'/25565');
            $minplayers = file_get_contents('https://minecraft-api.com/api/ping/online/'.$row["ip"].'/25565');
        
            echo '<div class="rectangle" style="border: 5px solid '.$color.';">';
            echo '<img src="' . $row["img"] . '" alt="Image">';
            echo '<div class="content-container">';
            if ($row["subscribe"] == 1) {
                echo '<div class="count-box" style="border: 3px solid '.$color.';">' . "#" . $count . ' <span class="star">&#9733;</span></div>';
            } else {
                echo '<div class="count-box" style="border: 3px solid '.$color.';">' . "#" . $count . '</div>';
            }
            echo '<span class="title">' . $row["name"] . '</span>';
            echo '<span class="description">' . $row["description"] . '</span>';
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '<a class="vote-button" href="voteserver.php?id=' . $row['id'] . '">VOTER</a>';
                
            }
            echo '</div>';
            echo '<div class="play-box">'.$row["vote"].' Votes</div>';
            echo'<a  class="custom-button">IP : '.$row["ip"].'</a>';
            
            // Condition pour cacher la ligne de code si id_categorie > 1
            if ($row["id_categorie"] == 1) {
                echo '<a class="custom-button">'.$minplayers.' / '.$maxplayers.' joueurs</a>';
            }
            
            echo'<a class="custom-button">Catégorie : '.$row["categorie_name"].'</a>';
            echo'<a href="'.$row["discord"].'" class="custom-button">Discord</a>';
            echo'<a href="https://'.$row["link"].'" class="custom-button">Site Web</a>';

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $voteStatusQuery = "SELECT is_activate FROM vote WHERE id = :id AND id_user = :user_id";
                $voteStatusStatement = $bdd->prepare($voteStatusQuery);
                $voteStatusStatement->bindParam(':id', $row['id']);
                $voteStatusStatement->bindParam(':user_id', $reponse['id']);
                $voteStatusStatement->execute();
                $voteStatus = $voteStatusStatement->fetchColumn();
            
                if ($voteStatus == 0) {
                    echo '<a class="custom-button-green">Vote : Disponible</a>';
                } else {
                    echo '<a class="custom-button-red">Vote : Indisponible</a>';
                }
            }

            
            echo '</div>';
            echo '<br>';
            echo '</div>';
            $count++;
        }
    }
    ?>
</body>
</html>
