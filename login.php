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


<div class="container">

<h3>Přihlášení</h3>

<form method="POST">
    <label for="username">Přihlašovací jméno:</label>
    <input type="text" id="username" required>
    </br>

    <label for="password">Heslo:</label>
    <input type="password" id="password" required>
    </br>

    <input type="submit" value="Přihlásit se">

    </form>

<p>Nemate ucet?" " <a href="reg.php">Registrujte se zde</a></p>

</div>

<?php


$logged=0;
$invalid=0;

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']); 
    $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); 

    $sql="select id, name, surname, email from `users` where username='$username' and password='$password'";

    $sqlstat=mysqli_query($conn,$sql);
    if($sqlstat) {
        $num=mysqli_num_rows($sqlstat);
        if($num>0) {
            $logged=1;
            session_start();
            $row = mysqli_fetch_assoc($sqlstat); 

            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['email'] = $row['email']; 
            $_SESSION['logged_id'] = true;

            header('location:index.php');

        } else {
            $invalid=1;      
        }
    }
}

?>

<?php

if($invalid){
    echo '<script>alert("Špatně zadané heslo nebo přihlašovací jméno")</script>';
}

?>


<?php
require_once "layout/footer.php";
?>

    
</body>
</html>