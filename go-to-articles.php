<?php 
$submit = isset($_POST['return']);
if ($submit) {
	session_start();

	$_SESSION["email"] = $_POST['email'];
	$_SESSION["pass"] = $_POST['pass'];
	header("Location: articles.php");
	exit; // Make sure to exit after redirecting
}
?>
