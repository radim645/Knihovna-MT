<?php

require_once "layout/header.php";


session_destroy();

header("Location: login.php");

?>

<?php
require_once "layout/footer.php";
?>