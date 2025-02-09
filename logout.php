<?php
session_start();

require_once "layout/header.php";

if(session_destroy())
{
	session_unset();
	header("location: index.php");
}
?>

<?php
require_once "layout/footer.php";
?>