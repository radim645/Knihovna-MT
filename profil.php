<?php
require_once "layout/header.php";
?>

<?php

require 'db.php';
?>

<div class="container">
    <h3>Můj profil</h3>
    <p><strong>Jméno:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
    <p><strong>Příjmení:</strong> <?php echo htmlspecialchars($_SESSION['surname']); ?></p>
    <p><strong>Uživatelské jméno:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p><strong>Adresa:</strong> <?php echo htmlspecialchars($_SESSION['address']); ?></p>
    <p><strong>Role:</strong> <?php echo ($_SESSION['role'] === 'admin') ? 'Administrátor' : 'Uživatel'; ?></p>
</div>

<?php require_once "layout/footer.php"; ?>

</body>
</html>