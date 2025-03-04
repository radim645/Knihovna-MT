<?php
require_once "layout/header.php";

require 'db.php';
?>

<?php


$user_id = 1; 

$sql = "SELECT k.nazev, v.datum_vypujceni, v.datum_vraceni 
        FROM vypujcky v
        JOIN knihy k ON v.id_knihy = k.id
        WHERE v.id_uzivatele = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<h1>Moje výpůjčky</h1>
<table border="1">
    <tr>
        <th>Název knihy</th>
        <th>Datum vypůjčení</th>
        <th>Termín vrácení</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($row["nazev"]) ?></td>
            <td><?= htmlspecialchars($row["datum_vypujceni"]) ?></td>
            <td><?= htmlspecialchars($row["datum_vraceni"]) ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<div style="margin-top: 20px; padding: 15px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">
    <strong>Upozornění:</strong> Knihu si vyzvedněte na nejbližší pobočce knihovny a vraťte ji nejpozději do data uvedeného v <em>Termínu vrácení</em>.
</div>

<?php
require_once "layout/footer.php";
?>