<?php
require_once "layout/header.php";
require "db.php";
session_start();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return_book"])) {

    $loan_id = $_POST["loan_id"];
    $book_id = $_POST["book_id"];


    $update_sql = "UPDATE knihy SET pocet_kusu = pocet_kusu + 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($stmt, "i", $book_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

 
    $delete_sql = "DELETE FROM vypujcky WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $loan_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    header("Location: admin.php");
    exit();
}


$sql = "SELECT 
            v.id AS loan_id, 
            k.id AS book_id, 
            k.nazev, 
            u.name, 
            v.datum_vypujceni, 
            v.datum_vraceni 
        FROM vypujcky v
        JOIN knihy k ON v.id_knihy = k.id
        JOIN users u ON v.id_uzivatele = u.id";

$result = mysqli_query($conn, $sql);
?>

<h1>Zápujčky</h1>

<table border="1">
    <tr>
        <th>Název knihy</th>
        <th>Uživatel</th>
        <th>Datum vypůjčení</th>
        <th>Datum vrácení</th>
        <th>Akce</th>
    </tr>

    <?php 
    
    while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= htmlspecialchars($row["nazev"]) ?></td>
        <td><?= htmlspecialchars($row["name"]) ?></td>
        <td><?= htmlspecialchars($row["datum_vypujceni"]) ?></td>
        <td><?= htmlspecialchars($row["datum_vraceni"]) ?></td>
        <td>
           
            <form method="post" action="admin.php">
                <!-- ID výpůjčky (loan_id) a ID knihy (book_id) pro update a delete --> 
                <input type="hidden" name="loan_id" value="<?= $row['loan_id'] ?>">
                <input type="hidden" name="book_id" value="<?= $row['book_id'] ?>">
                <input type="submit" name="return_book" value="Ukončit">
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php
require_once "layout/footer.php";
?>