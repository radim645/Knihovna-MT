<?php
session_start();
require 'db.php';

$query = "SELECT * FROM knihy";
$result = $conn->query($query);
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

<?php
require_once "layout/header.php";
?>


<h1>KNIHOVNA</h1>



<main>
    <div class="window">
        <h2>Kniha 1</h2>
    </div>

    <div class="window">
        <h2>Kniha 2</h2>
    </div>

    <div class="window">
        <h2>Kniha 3</h2>
    </div>

    <div class="window">
        <h2>Kniha 4</h2>
    </div>

    <div class="window">
        <h2>Kniha 5</h2>
    </div>



</main>


<?php
require_once "layout/footer.php";
?>


    
</body>
</html>