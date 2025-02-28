<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
require_once "layout/header.php";
?>
<?php
require 'db.php';
?>

<div class="container">

<h3>Přihlášení</h3>

<form method="POST">
    <label for="username">Přihlašovací jméno:</label>
    <input type="text" name="username" required>
    </br>

    <label for="password">Heslo:</label>
    <input type="password" name="password" required>
    </br>

    <input type="submit" name="login" value="Přihlásit se">

    </form>

<p>Nemáte účet?<a href="reg.php">Registrujte se zde</a></p>

</div>

<?php


$logged=0;
$invalid=0;

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']); 
    $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); 

    $sql="select id, username, name, surname, email, role, address from `users` where username='$username' and password='$password'";

    $sqlstat=mysqli_query($conn,$sql);
    if($sqlstat) {
        $num=mysqli_num_rows($sqlstat);
        if($num>0) {
            $logged=1;
            session_start();
            $row = mysqli_fetch_assoc($sqlstat); 

            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username']; 
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['email'] = $row['email']; 
            $_SESSION['role'] = $row['role'];
            $_SESSION['address'] = $row['address'];  
            $_SESSION['logged_in'] = true;

            header('location:index.php');

        } else {
            $invalid=1;      
        }
    }
}

?>

<?php



if($invalid){
    echo '<script>alert("Špatné heslo nebo přihlašovací jméno")</script>';
}


?>



<?php
require_once "layout/footer.php";
?>

    
</body>
</html>