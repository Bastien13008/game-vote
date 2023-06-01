<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .navbar {
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

        .container {
            margin: 20px;
        }

        .container h2 {
            margin-bottom: 10px;
        }

        .container form {
            display: flex;
            flex-direction: column;
        }

        .container form input[type="text"],
        .container form input[type="password"] {
            margin-bottom: 10px;
            padding: 5px;
        }

        .container form input[type="submit"] {
            padding: 10px;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#">Register</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Login</h2>
        <form action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
