<?php
session_start();
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prihlaseni</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
require_once "layout/header.php";
?>

<main>


<h1>Prihlaseni</h1>

<form method="POST">
    <label for="username">Prihlasovaci jmeno:</label>
    <input type="text" id="username" required>
    </br>

    <label for="password">Heslo:</label>
    <input type="password" id="password" required>
    </br>

    <button type="submit">Prihlasit se</button>

    </form>

<p>Nemate ucet?" " <a href="reg.php">Registrujte se zde</a></p>


</main>

<?php
require_once "layout/footer.php";
?>

    
</body>
</html>