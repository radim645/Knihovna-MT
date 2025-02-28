<?php

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

<?php

$sql = "SELECT id, nazev, autor, datum_vydani, pocet_stran, nakladatelstvi, pocet_kusu FROM knihy";

$sqlstat = mysqli_query($conn, $sql);

if ($sqlstat && mysqli_num_rows($sqlstat) > 0) {
    echo "<div class='knihy_container'>";
    while ($row = mysqli_fetch_assoc($sqlstat)) {
        echo "<div class='knihy'>";          
        echo "<h2>" . $row['nazev'] . "</h2>";
        echo "<p>Autor: " . $row['autor'] . "</p>";
        echo "<p>Rok vydání: " . $row['datum_vydani'] . "</p>";
        echo "<p>Počet stran: " . $row['pocet_stran'] . "</p>";
        echo "<p>Nakladatelství: " . $row['nakladatelstvi'] . "</p>";
        echo "<p>Počet kusů skladem: " . $row['pocet_kusu'] . "</p>";
        echo "<form action='index.php' method='POST'>";
        echo "<input type='hidden' name='id_knihy' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='borrow_bk' value='Rezervovat knihu'>";
        echo "</form>";
        echo "</div>";
    }
    echo "</div>"; 
}

?>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["borrow_bk"])) {
    $book_id = $_POST["id_knihy"];
    $user_id = 1; 
    $return_date = date("Y-m-d H:i:s", strtotime("+1 month"));

    $update_sql = "UPDATE knihy SET pocet_kusu = pocet_kusu - 1 WHERE id = ? AND pocet_kusu > 0";
    $stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($stmt, "i", $book_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $insert_sql = "INSERT INTO vypujcky (id_knihy, id_uzivatele, datum_vraceni) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_sql);
    mysqli_stmt_bind_param($stmt, "iis", $book_id, $user_id, $return_date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: borrow.php");
    exit();
}
?>

<?php
require_once "layout/footer.php";
?>


    
</body>
</html>