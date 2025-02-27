<?php
session_start();
require 'db.php';
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require_once "layout/header.php"; ?>

<div class="container">
    <h3>Přihlášení</h3>

    <form method="POST">
        <label for="username">Přihlašovací jméno:</label>
        <input type="text" name="username" required>
        <br>

        <label for="password">Heslo:</label>
        <input type="password" name="password" required>
        <br>

        <input type="submit" name="login" value="Přihlásit se">
    </form>

    <p>Nemáte účet? <a href="reg.php">Registrujte se zde</a></p>
</div>

<?php
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Použití připraveného dotazu
    $stmt = $conn->prepare("SELECT id, username, name, surname, email, role, address, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['logged_in'] = true;

            header('Location: index.php');
            exit();
        } else {
            echo '<script>alert("Špatně zadané heslo nebo přihlašovací jméno.")</script>';
        }
    } else {
        echo '<script>alert("Uživatel neexistuje.")</script>';
    }

    $stmt->close();
}

require_once "layout/footer.php";
?>

</body>
</html>