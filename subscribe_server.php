
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
$servreponse = $serveurs->fetch(PDO::FETCH_ASSOC);

$id = $_GET['id'];


?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

        .profile-box,
        .form-box,
        .additional-box {
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

        .form-box input,
        .form-box button {
            margin-bottom: 10px;
        }

        .additional-box h2 {
            margin-top: 0;
        }

        .small-box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .small-box {
            background-color: green;
            border: 3px solid black;
            padding: 10px;
            margin-bottom: 20px;
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

        .backoffice-button {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            display: <?php echo ($permission == 1) ? 'inline-block' : 'none'; ?>;
        }
    </style>
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
    <img src="dedipass.png">
    <form action="verification_dedipass.php" method="POST">
  <input type="text" name="dedipass_code" placeholder="Code Dedipass" required>
  <input type="hidden" name="server_id" value="<?php echo $id; ?>">
  <button type="submit">Valider</button>
</form>
