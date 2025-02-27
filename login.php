<?php


require_once "layout/header.php";
include "connect.php";
?>

<h1>Přihlášení</h1>

<title>Přihlášení</title>
    
<form action="login.php" method="post">
<div class="box">
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Heslo:</label><br>
    <input type="password" name="password" required><br>    
</div>
    <input type="submit" name="login" value="Přihlásit se">
</form>

<div>
Nemáte ještě účet?
<a href="registrace.php">Zaregistrujte se</a>
</div>

<?php


$logged=0;
$invalid=0;

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($con, $_POST['email']); 
    $password = md5(mysqli_real_escape_string($con, $_POST['password'])); 

    $sql="select id, name, surname, email from `users` where email='$email' and password='$password'";

    $sqlstat=mysqli_query($con,$sql);
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

            header('location:ucet.php');

        } else {
            $invalid=1;      
        }
    }
}

?>

<?php

if($invalid){
    echo '<script>alert("Špatné heslo, zkuste to znovu")</script>';
}

if($logged){
    echo '<script>alert("Jste úspěšně přihlášeni")</script>';
}

?>

<?php
require_once "layout/footer.php";
?>