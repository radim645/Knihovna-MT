<?php
session_start();
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
      
<?php
require_once "layout/header.php";
?>

<main>

<h1>Registrace</h1>



<form method="POST">

    <label for="name">Jmeno:</label>
    <input type="text" name="name" id="name" required>
    </br>

    <label for="surname">Prijmeni:</label>
    <input type="text" name="surname" id="surname"  required>
    </br>

    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" required>
    </br>

    <label for="address">Adresa:</label>
    <input type="text" name="address" id="address" required>
    </br>

    <label for="username">Uzivatelske jmeno:</label>
    <input type="text" name="username" id="username" required>
    </br>

    <label for="password">Heslo:</label>
    <input type="password" name="password" id="password" required>
    </br>  

    <button type="submit">Registrovat</button>

</form>

</main>


<?php
require_once "layout/footer.php";
?>

</body>
</html>