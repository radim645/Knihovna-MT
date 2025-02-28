<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knihovna</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="menu">
    <ul>
        <span><li><a href="index.php">Knihovna</a></li></span>

        <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>
            <span><li><a href="login.php">Přihlášení</a></li></span>
            <span><li><a href="reg.php">Registrace</a></li></span>
        <?php else: ?>
            <span><li><a href="borrow.php">Moje výpůjčky</a></li></span>
            <span><li><a href="profil.php">Můj profil</a></li></span>
            
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <span><li><a href="admin.php">Zápůjčky</a></li></span>
            <?php endif; ?>

            <span><li><a href="logout.php">Odhlásit se</a></li></span>
        <?php endif; ?>
    </ul>
</nav>

