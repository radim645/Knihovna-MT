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



<h1>Registrace</h1>



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

    <button type="submit" name="registrace">Registrovat</button>

</form>

<?php
$user=0;
$success=0;

if(isset($_POST['registrace'])){
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $surname=mysqli_real_escape_string($con,$_POST['surname']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);


$sql="select * from `users` where email='$email'";

$sqlstat=mysqli_query($con,$sql);
if($sqlstat) {
    $num=mysqli_num_rows($sqlstat);
    if($num>0) {
        $user=1;
    } else {
        $sql="insert into `users` (name, surname, email, password)
              values ('$name', '$surname', '$email', md5('$password'))";
        $sqlstat=mysqli_query($con,$sql);
        if($sqlstat) {
            $success=1;
            
        } else {
            die(mysqli_error($con));
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