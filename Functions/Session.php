<?php
	session_start();

	include("ConnectToDatabase.php");
	$checkUsername = $_SESSION["username"];
	$query = "SELECT username FROM Users WHERE username = '$checkUsername'";
	$result = $database->query($query);
	$row = $result->fetch_assoc();
	$username = $row["username"];

	if (!isset($username)) {
		header("Location: index.php");
	}
?>