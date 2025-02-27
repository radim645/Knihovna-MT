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

<div class="container">

<h3>Registrace</h3>



<form method="POST">

    <label for="name">Jmeno:</label>
    <input type="text" name="name"  required>
    </br>

    <label for="surname">Prijmeni:</label>
    <input type="text" name="surname"   required>
    </br>

    <label for="email">E-mail:</label>
    <input type="email" name="email"  required>
    </br>

    <label for="address">Adresa:</label>
    <input type="text" name="address"  required>
    </br>

    <label for="username">Uzivatelske jmeno:</label>
    <input type="text" name="username"  required>
    </br>

    <label for="password">Heslo:</label>
    <input type="password" name="password"  required>
    </br>  

    <input type="submit" name="registrace" value="Registrovat">

</form>

</div>

<?php
$user=0;
$success=0;

if(isset($_POST['registrace'])){
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $surname=mysqli_real_escape_string($conn,$_POST['surname']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);


$sql="select * from `users` where username='$username'";

$sqlstat=mysqli_query($conn,$sql);
if($sqlstat) {
    $num=mysqli_num_rows($sqlstat);
    if($num>0) {
        $user=1;
    } else {
        $sql="insert into `users` (username, name, surname, email, password, address)
              values ('$username', '$name', '$surname', '$email', md5('$password'),'$address')";
        $sqlstat=mysqli_query($conn,$sql);
        if($sqlstat) {
            $success=1;
            
        } else {
            die(mysqli_error($conn));
        }      
    }
}
}


if($success){
    echo '<script>alert(Účet úspěšně vytvořen)</script>';
}

?>

<?php
require_once "layout/footer.php";
?>

</body>
</html>